<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use function App\Helpers\checkEvent;

class Product extends Controller
{
    public function index()
    {
        $haveEvent = checkEvent();
        $position = 'all';
        $posNavbar = "product";
        $content_product = DB::table('content_product')->get();
        foreach ($content_product as $item) {
            $status = $item->status_title_banner;
            $title = $item->title_content_banner;
            $subtitle = $item->subtitle_content_banner;
            $img_banner = $item->img_banner;
        }
        $category = DB::table('product_category')->get();
        $product = DB::table('product')->paginate(9);
        return view('LandingPage.product', compact('posNavbar', 'img_banner', 'category', 'product', 'position', 'status', 'title', 'subtitle', 'haveEvent'));
    }

    public function atCategory($idcategory)
    {
        $haveEvent = checkEvent();
        if ($idcategory == "all") {
            $product = DB::table('product')->paginate(9);
        } else {
            $product = DB::table('product')
                ->where('product_category', '=', $idcategory)
                ->paginate(9);
        }
        $category = DB::table('product_category')->get();
        $position = $idcategory;
        $posNavbar = "product";

        $content_product = DB::table('content_product')->get();
        foreach ($content_product as $item) {
            $status = $item->status_title_banner;
            $title = $item->title_content_banner;
            $subtitle = $item->subtitle_content_banner;
            $img_banner = $item->img_banner;
        }

        return view('LandingPage.product', compact('category', 'img_banner' ,'product', 'position', 'posNavbar', 'status', 'title', 'subtitle', 'haveEvent'));
    }

    public function getDetail($id)
    {
        $haveEvent = checkEvent();
        $posNavbar = "";
        $product = DB::table('product')
                ->join('product_category', 'product.product_category', '=', 'product_category.idcategory')
                ->select('product.*', 'product_category.name_category')
                ->where('idproduct', '=', $id)
                ->get();

        return view('LandingPage.detailProduct',compact('posNavbar', 'haveEvent', 'product'));
    }
}
