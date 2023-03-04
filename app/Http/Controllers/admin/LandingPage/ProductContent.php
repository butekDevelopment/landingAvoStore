<?php

namespace App\Http\Controllers\admin\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function App\Helpers\checkEvent;

class ProductContent extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('email') == null){
			return redirect('/admin/login');
		}

        checkEvent();
        $posSidebar = "Landing Config";
        $posSubSidebar = "Product Content";
        $data = DB::table('content_product')->get();
        foreach ($data as $item) {
            $status = $item->status_title_banner;
            $title = $item->title_content_banner;
            $subTitle = $item->subtitle_content_banner;
        }

        $username = $request->session()->get('username');

        return view('Admin.LandingPage.product', compact('posSidebar', 'posSubSidebar', 'username','status', 'title', 'subTitle'));
    }

    public function updateBanner(Request $request)
    {
        if($request->session()->has('email') == null){
			return redirect('/admin/login');
		}

        $validator = Validator::make($request->all(), [
            'fileName' => 'image|mimes:jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect('/admin/productContent')->with('failed upload', "Cannot upload image, check again your file image");
        }

        if($request->file('fileName') != null){
            $file = $request->file('fileName');
            $imageName = 'products-heading'.'.'.$file->getClientOriginalExtension();
            $path = public_path().'/assets/images/banner';
            $file->move($path,$imageName);
        }

        DB::table('content_product')
        ->where('idcontent_product', 1)
        ->update([
            'status_title_banner' => $request->statusBanner,
            'title_content_banner' => $request->titleBanner,
            'subtitle_content_banner' => $request->subTitleBanner,
        ]);

        return redirect('/admin/productContent')->with('success', "Succesfuly for update landing page on Product");

    }
}
