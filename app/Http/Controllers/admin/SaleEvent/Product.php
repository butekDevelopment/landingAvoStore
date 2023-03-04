<?php

namespace App\Http\Controllers\admin\SaleEvent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function App\Helpers\checkEvent;

class Product extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        checkEvent();
        $productEvent = DB::table('product_discount')
            ->join('product', 'product_discount.product_idproduct', '=', 'product.idproduct')
            ->join('event', 'product_discount.discount_event_idevent', '=', 'event.idevent')
            ->join('discount', 'product_discount.discount_iddiscount', '=', 'discount.iddiscount')
            ->select('product_discount.idproduct_discount', 'product.name_product', 'product.price', 'event.name_event', 'discount.discount')
            ->paginate(8);

        $product = DB::table('product')->get();
        $category = DB::table('product_category')->get();
        $event = DB::table('event')->get();
        $username = $request->session()->get('username');
        $posSidebar = "Event";
        $posSubSidebar = "List Product Sale";


        return view('Admin.SaleEvent.productSale', compact('username', 'posSidebar', 'posSubSidebar', 'product', 'category', 'event', 'productEvent'));
    }

    public function getProduct($id)
    {
        $product = DB::table('product')
            ->where('idproduct', '=', $id)
            ->get();

        return $product;
    }

    public function getDiscount($id)
    {
        $discount = DB::table('discount')
            ->where('event_idevent', '=', $id)
            ->get();

        return $discount;
    }

    public function addProductForSale(Request $request)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        DB::table('product_discount')->insert([
            'product_idproduct' => $request->product,
            'product_category' => $request->id_categoryProduct,
            'discount_iddiscount' => $request->discount,
            'discount_event_idevent' => $request->eventDiscount,
            'create_at' => now(),
            'update_at' => now()
        ]);

        return redirect("/admin/productSale")->with('success', "Succesfuly add product for sale");
    }

    public function viewProductForSale(Request $request, $id)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        $productEvent = DB::table('product_discount')
            ->where('idproduct_discount', '=', $id)
            ->join('product', 'product_discount.product_idproduct', '=', 'product.idproduct')
            ->join('event', 'product_discount.discount_event_idevent', '=', 'event.idevent')
            ->join('discount', 'product_discount.discount_iddiscount', '=', 'discount.iddiscount')
            ->select('event.name_event', 'discount.discount', 'product.name_product', 'product.price', 'product.merek', 'product.kegunaan', 'product.stock', 'product.kadaluarsa', 'product.bentuk_product')
            ->get();

        return $productEvent;
    }

    public function deleteProductForSale(Request $request, $id)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        DB::table('product_discount')->where('idproduct_discount', '=', $id)->delete();
        return redirect("/admin/productSale")->with('success', "Succesfuly for Delete product for sale");
    }

    public function editViewProductForSale(Request $request, $id)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        $productEvent = DB::table('product_discount')
            ->where('idproduct_discount', '=', $id)
            ->join('product', 'product_discount.product_idproduct', '=', 'product.idproduct')
            ->join('event', 'product_discount.discount_event_idevent', '=', 'event.idevent')
            ->join('discount', 'product_discount.discount_iddiscount', '=', 'discount.iddiscount')
            ->select('event.idevent', 'event.name_event', 'discount.iddiscount', 'discount.discount', 'product.idproduct', 'product.name_product', 'product.price', 'product.merek', 'product.kegunaan', 'product.stock', 'product.kadaluarsa', 'product.bentuk_product')
            ->get();

        return $productEvent;
    }

    public function saveEditProductForSale(Request $request)
    {
        DB::table('product_discount')
            ->where('idproduct_discount', $request->idproduct_discount)
            ->update([
                'discount_event_idevent' => $request->eventDiscountEdit,
                'discount_iddiscount' => $request->discountEdit,
                'update_at' => now()
            ]);

        return redirect("/admin/productSale")->with('success', "Succesfuly for Edit product for sale");
    }
}
