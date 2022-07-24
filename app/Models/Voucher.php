<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model
{
    use HasFactory;

    protected $guard        = [];
    protected $fillable     = [
        'customer_id',
        'status',
        'expired_at',
    ];

    public $timestamps      = false;

    // relations
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    //
    
    // accessors
    public function getStatusStringAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'Available';
                break;
            case 1:
                return 'Locked';
                break;
            default:
                return 'Redeemed';
                break;
        }
    }

    public function getExpiredAtFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->expired_at)->format('d-m-Y H:i:s');
    }
    // 

    // methods
    public function mapItem()
    {
        return [
            'id'            => $this->id,
            'code'          => $this->code,
            'status'        => $this->status_string,
            'expired_at'    => $this->expired_at_formatted,
        ];
    }
    // 

    // scope
    public function scopeLockedVoucher($query)
    {
        return $query->where('status', 1)
                     ->where('expired_at','<',Carbon::now()->format('Y-m-d H:i:s'));
    }
    // 
}
