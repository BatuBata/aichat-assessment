<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use App\Models\PurchaseTransaction;

class PurchaseTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Customer::all() as $key => $customer) {
            foreach (PurchaseTransaction::factory()->count(rand(1, 4))->make() as $key => $item) {
                $item->customer_id      = $customer->id;
                $item->save();
            }
        }
    }
}
