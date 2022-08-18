<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
      $validate = $request->validate([
        'nik' => 'required',
        'tgl_lahir' => 'required'
      ]);
      
      if (Auth::attempt($validate))
      {
          $request->session()->regenerate();
          return redirect()->intended('/dashboard');
      }

      Alert::error('Error Title', 'Error Message');

      return back();
      ;
    }
}
