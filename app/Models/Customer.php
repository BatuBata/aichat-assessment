<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guard        = [];

    // relation
    public function purchaseTransaction()
    {
        return $this->hasMany(PurchaseTransaction::class);
    }

    public function voucher()
    {
        return $this->hasMany(Voucher::class);
    }
    //
    
    // accessors
    public function getDateOfBirthFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->date_of_birth)->format('d-m-Y');
    }
    // 

    // methods
    public function transactionInMonth()
    {
        return $this->purchaseTransaction->where('transaction_at','>=', \Carbon\Carbon::today()->subDays(30));
    }

    public function lockedVoucher()
    {
        return $this->voucher->where('status', 1)->first();
    }

    public function mapItem()
    {
        return [
            'id'                => $this->id,
            'first_name'        => $this->first_name,
            'last_name'         => $this->last_name,
            'gender'            => $this->gender,
            'date_of_birth'     => $this->date_of_birth_formatted,
            'contact_number'    => $this->contact_number,
            'email'             => $this->email,
        ];
    }
    // 
}
