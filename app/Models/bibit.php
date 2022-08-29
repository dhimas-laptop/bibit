<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bibit extends Model
{
    use HasFactory;

    protected $table = 'bibit';

    protected $fillable = [
        'nama' , 'jenis' , 'jumlah'
    ];

    protected $except = [
        '/API/bibit', //This route won't have CSRF protection
    ];
}
