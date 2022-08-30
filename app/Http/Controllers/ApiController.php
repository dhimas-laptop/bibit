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
        ]);
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
        return $data;
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
    public function update(Request $request, bibit $bibit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bibit  $bibit
     * @return \Illuminate\Http\Response
     */
    public function destroy(bibit $bibit)
    {
        //
    }
}
