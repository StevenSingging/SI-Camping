<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function simpanregistrasi(Request $request)
    {
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return redirect('/register')->with('fail','Data email yang diinput sudah ada');
        } else {
            // Data no_induk belum ada, buat entri baru
            User::create([
                'name' => $request->nama,
                'role' => 'Customer',
                'email' => $request->email,
                'nowa' => $request->nowa,
                'password' => bcrypt($request->password),
                'remember_token' => Str::random(60) 
            ]);

            return redirect('/login')->with('regis','Berhasil registrasi');
        }
    }

    public function postlogin (Request $request){
        //dd($request->all());
        $input=$request->all();
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))){
            if(auth()->user()->role=='Admin'){
                return redirect('dashboard/admin');
            }else if(auth()->user()->role=='Customer' || auth()->user()->role=='Customer_member'){
                return redirect('dashboard/customer');
            }
        }
        return redirect('/login')->with('postlogin','Username atau Password Anda Salah, Silakan lakukan proses login kembali');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login')->with('logout','Anda berhasil logout');
    }
}
