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
            'total' => $request->total,
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
            'total' => $request->total,
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
        
        $pemohon = pemohon::orderBy('id', 'desc')->get();
        foreach ($pemohon as $a) {
            $order = $a->order;
            foreach ($order as $b) {
                $detail = $b->detail;
                foreach ($detail as $c) {
                    $c->bibit;
                }
            }
        }
        
        
        return response([
            'status' => true,
            'data' => $pemohon
        ]);
    }

    public function update_order(Request $request)
    {
    
        if(order::where('pemohon_id', $request->id)->update(['status' => $request->status]) > 0) {
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
        $idorder = order::where('pemohon_id', $request->id)->get();
        
        if (bibit_order::where('order_id', $idorder->id)->delete() > 0) {
            if(order::where('pemohon_id', $request->id)->delete() > 0) {
               if (pemohon::where('id', $request->id)->delete() > 0) {
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
        }else{
            return response([
                'status' => false,
                'message' => 'Data gagal di Update'
            ], 400);
        }

    }

    public function order_filter(Request $request)
    {
        $pemohon = pemohon::where('id', $request->id)->get();
        $order = order::where('pemohon_id', $request->id)->get();
        foreach ($order as $key) {
            $detail = $key->detail;
            foreach ($detail as $q) {
                $q->bibit;
            }
        }
        return response([
            'status' => true,
            'data' => [
                'pemohon' => $pemohon,
                'order' => $order,
            ]
        ]);
    }
}