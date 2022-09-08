<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
            'luas',
            'alamat_lahan',
            'latitude',
            'longitude',
    ];

    public function bibit()
    {
        return $this->belongsToMany(bibit::class);
    }

    public function pemohon()
    {
        return $this->hasMany(pemohon::class);
    }
}
