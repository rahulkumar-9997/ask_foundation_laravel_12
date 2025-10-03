<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donations';
    protected $fillable = [
        'token',
        'amount',
        'currency',
        'salutation',
        'name',
        'pan_number',
        'pan_image',
        'email',
        'mobile',
        'payment_date',
        'payment_status',
        'razorpay_payment_id',
        'razorpay_order_id',
        'razorpay_signature',
    ];
    protected $casts = [
        'amount'       => 'decimal:2',
        'payment_date' => 'datetime',
    ];

    /**
     * Set payment status as success
     */
    public function markSuccess()
    {
        $this->update([
            'payment_status' => 'success',
            'payment_date' => now()
        ]);
    }

    /**
     * Set payment status as failed
     */
    public function markFailed()
    {
        $this->update([
            'payment_status' => 'failed',
            'payment_date' => now()
        ]);
    }

    /**
     * Get full donor name with salutation
     */
    public function getFullNameAttribute()
    {
        return ($this->salutation ? $this->salutation.' ' : '').$this->name;
    }
}
