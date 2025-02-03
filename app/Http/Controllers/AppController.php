<?php

namespace App\Http\Controllers;

use App\Models\bibit;
use App\Models\order;
use App\Models\pemohon;
use App\Models\bibit_order;
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
                'alamat' => 'required',
                'no_telp' => 'required',
                'kegiatan' => 'nullable',
               ]);
        if ($request->satuan === "kelompok") {
            $pemohon['nama_pemohon'] = $request->nama_ketua;
            $pemohon['kelompok'] = $request->kelompok;
        }else{
            $pemohon['nama_pemohon'] = $request->nama_pemohon;
        }        
        $order = $request->validate([
                 'luas' => 'required',
                 'alamat_lahan' => 'required',
                 'latitude' => 'required',
                 'longitude' => 'required',
                ]);
        $request->validate([
            'bibit' => 'required',
            'jumlah' => 'required'
        ]);
        $order['total'] = array_sum($request->jumlah);
        
        pemohon::create($pemohon);
        $id_pemohon = pemohon::max('id');
        
        $order['pemohon_id'] = $id_pemohon;
        
        $order['total'] = array_sum($request->jumlah);
        $order['status'] = "pending";
        order::create($order);
        
        $id_order = order::max('id');
        $total = count($request->bibit) - 1;
        
        for ($i=0; $i < $total; $i++) { 
            $transaksi = $request->bibit[$i];
            $jumlah = $request->jumlah[$i];

            bibit_order::create([
                'bibit_id' => $transaksi,
                'order_id' => $id_order,
                'jumlah' => $jumlah,
            ]);
        }
        
        $pesan = 'Ada Pesanan Bibit atas nama: '.$pemohon['nama_pemohon'].' Nomor: '.$pemohon['no_telp'].' Buka Sipuda di link www.bpdas-sjd.id';

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
        'target' => '082284099338,082381071014',
        'message' => $pesan,
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: 3m35wHQVK2WambZAmzQM'
        ),
        ));
        
        curl_exec($curl);

        return redirect()->back()->with('success', 'bibit berhasil di pesan');
    }

    function test()
    {
       
        
    }
}
