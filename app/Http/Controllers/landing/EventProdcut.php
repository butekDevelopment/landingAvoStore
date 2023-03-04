<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use function App\Helpers\checkEvent;

class EventProdcut extends Controller
{
    public function index()
    {
        $haveEvent = checkEvent();
        $posNavbar = "event";

        $content_promotion = DB::table('content_promotion')->get();
        foreach ($content_promotion as $item) {
            $status = $item->status_title_banner;
            $title = $item->title_content_banner;
            $subtitle = $item->subtitle_content_banner;
            $img_banner = $item->img_banner;
        }

        $product = DB::table('product_discount')
                    ->join('product', 'product_discount.product_idproduct', '=', 'product.idproduct')
                    ->join('event', 'product_discount.discount_event_idevent', '=', 'event.idevent')
                    ->join('discount', 'product_discount.discount_iddiscount', '=', 'discount.iddiscount')
                    ->select('product_discount.idproduct_discount', 'product.*', 'event.name_event', 'discount.discount')
                    ->get();


        return view('LandingPage.EventSale', compact('posNavbar', 'img_banner', 'title', 'subtitle', 'haveEvent', 'status', 'product'));
    }

    public function getDetailProductEvent($id)
    {
        $haveEvent = checkEvent();
        $posNavbar = "";

        $product = DB::table('product_discount')
                    ->where('idproduct_discount', $id)
                    ->join('product', 'product_discount.product_idproduct', '=', 'product.idproduct')
                    ->join('event', 'product_discount.discount_event_idevent', '=', 'event.idevent')
                    ->join('discount', 'product_discount.discount_iddiscount', '=', 'discount.iddiscount')
                    ->join('product_category', 'product_discount.product_category', '=', 'product_category.idcategory')
                    ->select('product.*', 'product_category.name_category', 'event.name_event', 'discount.discount')
                    ->get();
                    
        return view('LandingPage.detailProductEvent', compact('posNavbar', 'haveEvent', 'product'));
    }
}
