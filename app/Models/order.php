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
            'pemohon_id',
            'total',
            'status'
    ];

    public function pemohon()
    {
        return $this->belongsTo(pemohon::class);
    }

    public function detail()
    {
        return $this->hasMany(bibit_order::class);
    }

}
