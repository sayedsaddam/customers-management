<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'investment_id',
        'paymentMode',
        'referenceNo',
        'bankName',
        'branchCode',
        'amount',
        'receivedAt'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
