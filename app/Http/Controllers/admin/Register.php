<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Register extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('email')) {
            return redirect('/admin');
        }
        return view('Admin.register');
    }

    public function doRegister(Request $request)
    {
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $repassword = $request->repassword;

        if (strlen($password) < 8) {
            return redirect('/admin/register')->with('failed', 'Password minimum lenght  is 8');
        }

        if ($password != $repassword) {
            return redirect('/admin/register')->with('failed', 'Incorrect password');
        }

        $checkEmail = DB::table('user')->where('email', '=', $email)->get();
        if (sizeof($checkEmail) != 0) {
            return redirect('admin/register')->with('failed', 'Email already exists');
        } else {
            DB::table('user')->insert([
                'username' => $username,
                'email' => $email,
                'phone' => null,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'photo' => "/assets/images/profile.png",
                'create_at' => now(),
                'update_at' => now()
            ]);

            return redirect('/admin/register')->with('success', 'Success to create new account');
        }
    }
}
