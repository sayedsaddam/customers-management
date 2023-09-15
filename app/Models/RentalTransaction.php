<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'rentalAmount', 'rentalDate'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
