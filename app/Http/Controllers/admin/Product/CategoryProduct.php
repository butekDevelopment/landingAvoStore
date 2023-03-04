<?php

namespace App\Http\Controllers\admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function App\Helpers\checkEvent;

class CategoryProduct extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        checkEvent();
        $posSidebar = "Product";
        $posSubSidebar = "Category Product";
        $category = DB::table('product_category')->paginate(8);

        $username = $request->session()->get('username');

        return view('Admin.Product.categoryProduct', compact('posSidebar', 'posSubSidebar', 'username', 'category'));
    }

    public function updateCategory(Request $request)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        DB::table('product_category')
            ->where('idcategory', $request->id)
            ->update([
                'name_category' => $request->name,
                'update_at' => now(),
            ]);

        return redirect('/admin/category')->with('success', "Succesfuly for update category product");
    }

    public function createCategory(Request $request)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        DB::table('product_category')->insert([
            'name_category' => $request->name,
            'create_at' => now(),
            'update_at' => now()
        ]);

        return redirect('/admin/category')->with('success', "Succesfuly for create category product");
    }

    public function deleteCategory(Request $request, $id)
    {
        if ($request->session()->has('email') == null) {
            return redirect('/admin/login');
        }

        $productDiscountCurrent = DB::table('product_discount')->where('product_category', '=', $id)->get();
        if (count($productDiscountCurrent) != 0) {
            DB::table('product_discount')->where('product_category', '=', $id)->delete();
        }

        $discountCurrent = DB::table('product')->where('product_category', '=', $id)->get();
        if (count($discountCurrent) != 0) {
            DB::table('product')->where('product_category', '=', $id)->delete();
        }

        DB::table('product_category')->where('idcategory', '=', $id)->delete();

        return redirect('/admin/category')->with('success', "Succesfuly for Delete category product");

    }
}
