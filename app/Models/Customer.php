<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact', 'email', 'address', 'investment_amount', 'investment_date', 'buyback', 'buyback_amount', 'buyback_date', 'status', 'user_id'];
}
