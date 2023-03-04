<?php

namespace App\Http\Controllers\admin\SettingProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function App\Helpers\checkEvent;

class ChangePassword extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('email') == null){
			return redirect('/admin/login');
        }

        checkEvent();
        $posSidebar = "";
        $posSubSidebar = "";
        $username = $request->session()->get('username');

        return view('Admin.SettingProfile.changePassword', compact('posSidebar', 'posSubSidebar', 'username'));
    }

    public function updatePassword(Request $request)
    {
        $validatorImput = Validator::make($request->all(), [
            'passwordOld' => 'required',
            'passwordNew' => 'required',
            'rePassword' => 'required',
        ]);

        if ($validatorImput->fails()) {
            return redirect("/admin/profile/changePassword")->with('failed', "Failed to update password, please check again input value");
        }

        if(strlen($request->passwordNew) < 8){
            return redirect('/admin/register')->with('failed', 'Password minimum lenght  is 8');
        }

        $value = DB::table('user')->where('iduser','=', $request->session()->get('iduser'))->get();
        if(password_verify($request->passwordOld, $value[0]->password)){
            if($request->passwordNew == $request->rePassword){
                DB::table('user')
                ->where('iduser', $request->session()->get('iduser'))
                ->update([
                    'password' => password_hash($request->passwordNew, PASSWORD_DEFAULT),
                    'update_at' => now()
                ]);
                return redirect('/admin/profile/changePassword')->with('success', 'Success to change password');
            }else{
                return redirect('/admin/profile/changePassword')->with('failed', 'A new password is not the same as a repeat password');;
            }
        }else{
            return redirect('/admin/profile/changePassword')->with('failed', 'Incorrect old password');
        }
    }
}
