<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Voucher;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerRepository {

    protected $model;

    public function __construct(Customer $model, Voucher $voucher)
    {
        $this->model            = $model;
        $this->voucher          = $voucher;
    }

    public function eligibleCheck($customer_id)
    {
        $customer           = $this->model->with(['purchaseTransaction','voucher'])->find($customer_id);
        
        // check if customer doesnt exists
        if (empty($customer)) {
            return makeResponse(false, 'Customer doesnt exists', [], 404);
        }

        // check if customer has 3 or more purchases within the last 30 days
        if ($customer->transactionInMonth()->count() < 3) {
            return makeResponse(false, 'Customer transaction is less than 3 transaction', [], 400);
        }
        
        // check if customer transaction is less than 100$
        if ($customer->transactionInMonth()->sum('total_spent') < 100) {
            return makeResponse(false, 'Customer transaction is less than 100$', [], 400);
        }        

        // check if customer already has voucher
        if ($customer->voucher->isNotEmpty()) {
            return makeResponse(false, 'Customer already has voucher', [] , 400);
        }
        
        // get available voucher
        $available_voucher  = $this->voucher->where('status', 0)->first();

        // lock voucher for customer
        if (!empty($available_voucher)) {
            try {
            
                DB::beginTransaction();
    
                $available_voucher->update([
                    'customer_id'       => $customer->id,
                    'status'            => 1,
                    'expired_at'        => Carbon::now()->addMinutes(10)->toDateTimeString(),
                ]);

                $customer                   = $customer->mapItem();
                $customer['voucher']        = $available_voucher->mapItem();

                DB::commit();

                return makeResponse(true, 'Successfuly locked a voucher for customer', $customer, 200);

            } catch (\Throwable $th) {
                
                DB::rollback();
    
                return makeResponse(false, $th->getMessage(), [] , 500);
            }   
        }

        // return voucher not available
        return makeResponse(false, 'Voucher not available', [], 400);
    }

    public function validateSubmission($customer_id)
    {
        $customer               = $this->model->with(['voucher'])->find($customer_id);

        // check if customer doesnt exists
        if (empty($customer)) {
            return makeResponse(false, 'Customer doesnt exists', [], 404);
        }       

        // get customer locked voucher
        $locked_voucher         = $customer->lockedVoucher();

        // check if customer doesnt have locked voucher
        if (empty($locked_voucher)) {
            return makeResponse(false, 'Customer doesnt have locked voucher', [], 400);   
        }

        // check if locked voucher expired and unlock the voucher
        if ($locked_voucher->expired_at < Carbon::now()) {
            $this->unlockVoucher($locked_voucher);
            return makeResponse(false, 'Voucher expired', [], 400);
        }

        // image recognition validation
        if (!$this->imageRecognitionValidation()) {
            $this->unlockVoucher($locked_voucher);
            return makeResponse(false, 'Image recognition validation failed', [], 400);   
        }

        // redeem voucher for customer
        try {
            
            DB::beginTransaction();

            $locked_voucher->update([
                'status'        => 2,
            ]);

            $customer                       = $customer->mapItem();
            $customer['voucher']            = $locked_voucher->mapItem();

            DB::commit();

            return makeResponse(true, 'Successfuly redeemed a voucher for customer', $customer, 200);

        } catch (\Throwable $th) {
            
            DB::rollback();

            return makeResponse(false, $th->getMessage(), [] , 500);
        }
    }

    public function unlockVoucher($voucher)
    {
        try {
            
            DB::beginTransaction();

            $voucher->update([
                'customer_id'       => null,
                'expired_at'        => null,
                'status'            => 0,
            ]);

            DB::commit();

            return true;

        } catch (\Throwable $th) {
         
            DB::rollBack();

            return makeResponse(false, $th->getMessage(), [] , 500);

        }
    }

    public function imageRecognitionValidation()
    {
        return true;
    }
}