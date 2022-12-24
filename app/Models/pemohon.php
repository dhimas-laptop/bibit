<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemohon extends Model
{
    use HasFactory;

    protected $table = 'pemohon';

    protected $fillable = [
       'satuan',
        'nama_pemohon',
        'kelompok',
        'alamat',
        'no_telp',
        'kegiatan',
    ];

    public function bibit()
    {
        return $this->hasManyThrough(bibit::class, order::class);
    }
}
