<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Login extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('email')){
			return redirect('/admin');
		}
        return view('Admin.login');
    }

    public function doLogin(Request $request)
    {
        $value = DB::table('user')->where('email','=', $request->email)->get();

        if(count($value) == 0){
            return redirect('/admin/login')->with('failed', 'Email not found');
        }

        if(password_verify($request->password, $value[0]->password)){
            foreach ($value as $item) {
                $request->session()->put('iduser', $item->iduser);
                $request->session()->put('username', $item->username);
                $request->session()->put('email', $item->email);
                $request->session()->put('phone', $item->phone);
                $request->session()->put('photo', $item->photo);
                $request->session()->put('jenisKelamin', $item->jenis_kelamin);
            }

            return redirect('/admin');
        }else{
            return redirect('/admin/login')->with('failed', 'Incorrect password');
        }
    }

    public function logOut(Request $request)
    {
        $request->session()->flush();
        return redirect('/admin');
    }
}
