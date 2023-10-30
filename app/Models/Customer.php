<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'customerID',
        'fatherName',
        'cnic',
        'email',
        'phone',
        'dob',
        'city',
        'address',
        'accountTitle',
        'bankName',
        'branchCode',
        'accountNumber',
        'nokName',
        'nokCnic',
        'nokPhone',
        'nokEmail',
        'nokRelation',
        'status',
        'investmentAmount',
        'investmentDate',
        'user_id',
    ];

    public function investments(){
        return $this->hasMany(Investment::class);
    }

    public function totalInvestments(){
        return $this->investments()->sum('amountReceived');
    }

    public function buybackTransactions(){
        return $this->hasMany(BuybackTransaction::class);
    }

    public function rentalTransactions(){
        return $this->hasMany(RentalTransaction::class);
    }

    public function installments(){
        return $this->hasMany(Installment::class);
    }
}
