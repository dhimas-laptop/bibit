<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rincian extends Model
{
    use HasFactory;
    protected $table = 'rincian';
    protected $fillable = [
        'order_id',
        'bibit_id',
        'jumlah',
    ];
    
}
