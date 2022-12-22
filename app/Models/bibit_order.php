<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bibit_order extends Model
{
    use HasFactory;
    protected $table = 'bibit_order';
    protected $fillable = [
        'order_id',
        'bibit_id',
        'jumlah',
    ];

   
}
