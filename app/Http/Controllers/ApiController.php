<?php

namespace App\Http\Controllers;

use App\Models\bibit;
use App\Models\order;
use App\Models\pemohon;
use App\Models\bibit_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = bibit::get();
        
        return response([
            'title' => 'Daftar Bibit Tersedia',
            'data'  => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'file' => $request->file
        ];
       
        if(bibit::create($data)){
            return response([
                'status' => true,
                'message' => "Data Berhasil Di Input"
            ], 200);
        }else{
            return response([
                'status' => false,
                'message' => 'Data gagal di input'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bibit  $bibit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = bibit::findOrFail($id);
        if($data !== 0){
            return response([
                'title' => 'Daftar Bibit Tersedia',
                'data'  => $data
            ], 200);
        }else{
            return response([
                'status' => false,
                'message' => 'Data gagal di input'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bibit  $bibit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'file' => $request->file
        ];
        $id = $request->id;

        if(bibit::select('*')->where('id', $id)->update($data) > 0) {
            return response([
                'status' => true,
                'message' => "Data Berhasil Di Update"
            ], 200);
        }else{
            return response([
                'status' => false,
                'message' => 'Data gagal di Update'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bibit  $bibit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        bibit_order::where('bibit_id', $id)->delete();
        if(bibit::select('*')->where('id', $id)->delete() > 0) {
            return response([
                'status' => true,
                'message' => "Data Berhasil Di Hapus"
            ], 200);
        }else{
            return response([
                'status' => false,
                'message' => 'Data gagal di Hapus'
            ], 400);
        }
    }

    public function order()
    {
        
        $pemohon = pemohon::get();
        $order = order::get();
        $detail = bibit_order::get();
        $bibit = bibit::get();
        
        
        return response([
            'status' => true,
            'data' => [
                'pemohon' => $pemohon,
                'order' => $order,
                'detail' => $detail,
                'bibit' => $bibit
            ]
        ]);
    }

    public function update_order(Request $request)
    {
    
        if(order::where('id', $request->id)->update(['status' => $request->status]) > 0) {
            return response([
                'status' => true,
                'message' => "Data Berhasil Di Update"
            ], 200);
        }else{
            return response([
                'status' => false,
                'message' => 'Data gagal di Update'
            ], 400);
        }
    }

    public function hapus_order(Request $request)
    {

        if (bibit_order::where('order_id', $request->id)->delete() > 0) {
            if(order::where('id', $request->id)->delete() > 0) {
                return response([
                    'status' => true,
                    'message' => "Data Berhasil Di Update"
                ], 200);
            }else{
                return response([
                    'status' => false,
                    'message' => 'Data gagal di Update'
                ], 400);
            }
        }else{
            return response([
                'status' => false,
                'message' => 'Data gagal di Update'
            ], 400);
        }

    }

    public function order_filter(Request $request)
    {
        $data = DB::table('pemohon')
                ->select(
                    'order.id as order_id',
                    'pemohon.id as pemohon_id',
                    'bibit_order.id as bibit_order_id',
                    'bibit.id as bibit.id',
                    'luas',
                    'alamat_lahan',
                    'latitude',
                    'longitude',
                    'total',
                    'status',
                    'satuan',
                    'nama_pemohon',
                    'kelompok',
                    'alamat',
                    'no_telp',
                    'kegiatan',
                    'bibit.jumlah as jumlah_bibit',
                    'bibit_order.jumlah as jumlah_bibit_order',
                    'nama',
                    'jenis',
                    'file'
                    )
                ->where('order_id', $request->id) 
                ->join('order','pemohon.id','=','order.pemohon_id')
                ->join('bibit_order', 'order.id', '=' , 'bibit_order.order_id')
                ->join('bibit', 'bibit.id', '=' , 'bibit_order.bibit_id')
                ->get();
        
        return response([
            'status' => true,
            'data' => $data
        ]);
    }
}
