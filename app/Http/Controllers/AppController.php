<?php

namespace App\Http\Controllers;

use App\Models\bibit;
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
}
