<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
            'customer_id',
            'investmentAmount',
            'investmentDate',
            'project',
            'rentalStatus',
            'rentalPercentage',
            'floorName',
            'sqft',
            'rate',
            'saleValue',
            'amountReceived'
        ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function installment(){
        return $this->hasMany(Installment::class);
    }
}
