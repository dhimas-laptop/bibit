<?php

namespace App\Http\Controllers;

use App\Models\bibit;
use App\Models\order;
use App\Models\pemohon;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function list()
    {
        $list = bibit::get();

        return view('daftar-bibit',['bibit' => $list]);
    }

    public function order()
    {
        $select = bibit::get();
        return view('checkout', ['bibit' => $select]);
    }

    public function post_order(Request $request)
    {
       $pemohon = $request->validate([
                'satuan' => 'required',
                'nama' => 'required',
                'kelompok' => 'nullable',
                'alamat' => 'required',
                'no_telp' => 'required',
                'kegiatan' => 'nullable',
               ]);

        $order = $request->validate([
                 'luas' => 'required',
                 'alamat_lahan' => 'required',
                 'latitude' => 'required',
                 'longitude' => 'required',
                 'bibit' => 'required'
                ]);
    
        pemohon::create($pemohon);
        $id_pemohon = pemohon::max('id');
        
        $order['pemohon_id'] = $id_pemohon;
        order::create($order);

        $id_order = order::max('id');
        $total = count($order['bibit']);

        for ($i=0; $i < $total; $i++) { 
            $transaksi = $request->bibit[$i];
            transaksi::create([
                'bibit_id' => $transaksi,
                'order_id' => $id_order
            ]);
        }

        return redirect()->back()->with('success', 'bibit berhasil di pesan');
    }
}
