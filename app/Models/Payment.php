<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'gngc_staff_number_key',
        'month',
        'year',
        'amount'
    ];

    public function user()
    {
        return $this->belongsTo('App\Payment', 'gngc_staff_number', 'gngc_staff_number_key');
    }
}
