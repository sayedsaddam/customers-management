<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fatherName',
        'cnic',
        'email',
        'phone',
        'dob',
        'city',
        'address',
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

    public function buybackTransactions(){
        return $this->hasMany(BuybackTransaction::class);
    }

    public function rentalTransactions(){
        return $this->hasMany(RentalTransaction::class);
    }
}
