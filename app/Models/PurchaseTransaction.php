<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseTransaction extends Model
{
    use HasFactory;

    protected $guard    = [];
    public $timestamps  = false;

    // relation
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    // 
}
