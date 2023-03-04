<?php

namespace App\Http\Controllers\admin\SettingProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function App\Helpers\checkEvent;

class ShowProfile extends Controller
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
        $email = $request->session()->get('email');
        $phone = $request->session()->get('phone');
        $photo = $request->session()->get('photo');
        $jenisKelamin = $request->session()->get('jenisKelamin');

        return view('Admin.SettingProfile.showProfile', compact('posSidebar', 'posSubSidebar', 'username', 'email', 'phone', 'photo', 'jenisKelamin'));
    }

    public function updateProfile(Request $request)
    {
        $validatorImput = Validator::make($request->all(), [
            'username' => 'required',
            'jenisKelamin' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $validatorImage = Validator::make($request->all(), [
            'fileName' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validatorImput->fails()) {
            return redirect("/admin/profile")->with('failed', "Failed to edit profile, please check again input value");
        }

        if ($validatorImage->fails()) {
            return redirect("/admin/profile")->with('failed', "Failed to edit profile, please check type image to upload");
        }

        if(strlen($request->phone) < 10){
            return redirect('/admin/profile')->with('failed', 'Number phone minimum lenght is 10');
        }elseif(strlen($request->phone) > 12){
            return redirect('/admin/profile')->with('failed', 'Number phone maximum lenght is 12');
        }

        if($request->file('fileName') != null){
            $file = $request->file('fileName');
            $imageName = now()->timestamp.'.'.$file->getClientOriginalExtension();
            $path = public_path().'/assets/images/profile';
            $file->move($path,$imageName);
        
            DB::table('user')
                ->where('iduser', $request->session()->get('iduser'))
                ->update([
                    'username' => $request->username,
                    'jenis_kelamin' =>(int) $request->jenisKelamin,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'photo' => "/assets/images/profile/$imageName",
                    'update_at' => now()
                ]);
        }else{
            DB::table('user')
            ->where('iduser', $request->session()->get('iduser'))
            ->update([
                'username' => $request->username,
                'jenis_kelamin' => (int) $request->jenisKelamin,
                'email' => $request->email,
                'phone' => $request->phone,
                'update_at' => now()
            ]);
        }

        $value = DB::table('user')->where('iduser','=', $request->session()->get('iduser'))->get();
        $request->session()->flush();
        foreach ($value as $item) {
            $request->session()->put('iduser', $item->iduser);
            $request->session()->put('username', $item->username);
            $request->session()->put('email', $item->email);
            $request->session()->put('phone', $item->phone);
            $request->session()->put('photo', $item->photo);
            $request->session()->put('jenisKelamin', $item->jenis_kelamin);
        }

        return redirect('/admin/profile')->with('success', "Succesfuly for update profile");
    }
}
