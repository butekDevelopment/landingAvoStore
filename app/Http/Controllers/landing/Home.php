<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use function App\Helpers\checkEvent;

class Home extends Controller
{
    public function index()
    {
        $haveEvent = checkEvent();
        $posNavbar = "home";
        $data = DB::table('content_home')->get();
        foreach ($data as $value) {
            $status1 = $value->status_title_banner1;
            $status2 = $value->status_title_banner2;
            $status3 = $value->status_title_banner3;
            $title1 = $value->title_content_banner1;
            $title2 = $value->title_content_banner2;
            $title3 = $value->title_content_banner3;
            $subtitle1 = $value->subtitle_content_banner1;
            $subtitle2 = $value->subtitle_content_banner2;
            $subtitle3 = $value->subtitle_content_banner3;
            $img_logo = $value->img_logo;
            $content_about = $value->content_about;
            $img_content1 = $value->img_banner1;
            $img_content2 = $value->img_banner2;
            $img_content3 = $value->img_banner3;
        }

        $newItem = DB::table('product')
            ->join('product_category', 'product.product_category', '=', 'product_category.idcategory')
            ->select('product.*', 'product_category.name_category')
            ->orderBy('create_at', 'desc')
            ->limit(3)
            ->get();

        $productEvent = DB::table('product_discount')
            ->join('product', 'product_discount.product_idproduct', '=', 'product.idproduct')
            ->join('event', 'product_discount.discount_event_idevent', '=', 'event.idevent')
            ->join('discount', 'product_discount.discount_iddiscount', '=', 'discount.iddiscount')
            ->select('product_discount.idproduct_discount', 'product.*', 'event.name_event', 'discount.discount')
            ->orderBy('create_at', 'desc')
            ->limit(3)
            ->get();


        return view('LandingPage.home', compact('posNavbar', 'img_content1', 'img_content2', 'img_content3', 'status1', 'status2', 'status3', 'title1', 'title2', 'title3', 'subtitle1', 'subtitle2', 'subtitle3', 'img_logo', 'content_about', 'newItem', 'haveEvent', 'productEvent'));
    }
}
