<?php

namespace App\Http\Controllers\admin\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function App\Helpers\checkEvent;

class HomeContent extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('email') == null){
			return redirect('/admin/login');
        }

        checkEvent();
        $posSidebar = "Landing Config";
        $posSubSidebar = "Home Content";
        $data = DB::table('content_home')->get();

        foreach($data as $value){
            $status1 = $value->status_title_banner1;
            $status2 = $value->status_title_banner2;
            $status3 = $value->status_title_banner3;
            $title1 = $value->title_content_banner1;
            $title2 = $value->title_content_banner2;
            $title3 = $value->title_content_banner3;
            $subtitle1 = $value->subtitle_content_banner1;
            $subtitle2 = $value->subtitle_content_banner2;
            $subtitle3 = $value->subtitle_content_banner3;
            $content_about = $value->content_about;
        }
        $username = $request->session()->get('username');

        return view('Admin.LandingPage.home', compact('posSidebar', 'posSubSidebar', 'username','status1', 'status2', 'status3', 'title1', 'title2', 'title3', 'subtitle1', 'subtitle2', 'subtitle3', 'content_about'));
    }

    public function updateBanner($banner, Request $request){
        if($request->session()->has('email') == null){
			return redirect('/admin/login');
		}

        $validator = Validator::make($request->all(), [
            'fileName' => 'image|mimes:jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect('/admin')->with('failed upload', "Cannot upload image, check again your file image");
        }

        if($banner == "banner1"){
            $bannerSlide = "Banner 1";
            $statusBanner = "status_title_banner1";
            $titleBanner = "title_content_banner1";
            $subTitleBanner = "subtitle_content_banner1";
        }elseif($banner == "banner2"){
            $bannerSlide = "Banner 2";
            $statusBanner = "status_title_banner2";
            $titleBanner = "title_content_banner2";
            $subTitleBanner = "subtitle_content_banner2";
        }else{
            $bannerSlide = "Banner 3";
            $statusBanner = "status_title_banner3";
            $titleBanner = "title_content_banner3";
            $subTitleBanner = "subtitle_content_banner3";
        }

        $file = $request->file('fileName');
        if($file != null){
            if($banner == "banner1"){
                $imageName = 'slide_01'.'.'.$file->getClientOriginalExtension();
            }elseif($banner == "banner2"){
                $imageName = 'slide_02'.'.'.$file->getClientOriginalExtension();
            }else{
                $imageName = 'slide_03'.'.'.$file->getClientOriginalExtension();
            }
            $path = public_path().'/assets/images/banner';
            $file->move($path,$imageName);
        }

        DB::table('content_home')
            ->where('idcontent_home', 1)
            ->update([
                $statusBanner => $request->statusBanner,
                $titleBanner => $request->titleBanner,
                $subTitleBanner => $request->subTitleBanner,
            ]);

        return redirect('/admin')->with('success', "Succesfuly for update landing page $bannerSlide on Home");
    }

    public function editContent(Request $request){
        $validator = Validator::make($request->all(), [
            'fileName' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect('/admin')->with('failed upload', "Cannot upload image, check again your file image");
        }

        $file = $request->file('fileName');
        if($file != null){
            $imageName = 'logoAvo'.'.'.$file->getClientOriginalExtension();
            $path = public_path().'/assets/images';
            $file->move($path,$imageName);
            DB::table('content_home')
            ->where('idcontent_home', 1)
            ->update([
                'content_about' => $request->contentDescription,
                'img_logo' => "assets/images/$imageName",
            ]);

        }else{
            DB::table('content_home')
            ->where('idcontent_home', 1)
            ->update([
                'content_about' => $request->contentDescription,
            ]);
        }

        return redirect('/admin')->with('success', "Succesfuly for update landing page in content");

    }
}
