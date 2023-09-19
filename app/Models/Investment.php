<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'investmentAmount', 'investmentDate', 'project', 'rentalPercentage'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
