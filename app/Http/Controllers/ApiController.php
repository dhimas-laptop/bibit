<?php

namespace App\Http\Controllers;

use App\Models\bibit;
use Illuminate\Http\Request;
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
            'jumlah' => $request->jumlah
        ];

        if(bibit::insert($data)>0){
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
    public function show(bibit $bibit)
    {
        //
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
            'jumlah' => $request->jumlah
        ];
        $id = $request->id;

        if(bibit::table('bibit')->where('id', $id)->update($data) > 0) {
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

        if(bibit::table('bibit')->where('id', $id)->delete() > 0) {
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
}
