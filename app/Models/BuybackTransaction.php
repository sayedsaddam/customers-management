<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuybackTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'buybackAmount', 'buybackDate'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
