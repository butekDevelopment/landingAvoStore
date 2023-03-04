<?php

namespace App\Http\Controllers\admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function App\Helpers\checkEvent;

class Product extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('email') == null){
			return redirect('/admin/login');
        }

        checkEvent();
        $posSidebar = "Product";
        $posSubSidebar = "List Product" ;
        $product = DB::table('product')
                    ->join('product_category', 'product.product_category', '=', 'product_category.idcategory')
                    ->select('product.*', 'product_category.name_category')
                    ->paginate(8);
        $category = DB::table('product_category')->get();
        $username = $request->session()->get('username');
        return view('Admin.Product.product', compact('posSidebar', 'posSubSidebar', 'username', 'product', 'category'));
    }

    public function createProduct(Request $request)
    {
        if($request->session()->has('email') == null){
			return redirect('/admin/login');
        }

        $validatorImage = Validator::make($request->all(), [
            'fileName' => 'required|image|mimes:jpeg,jpg|max:2048'
        ]);

        $validatorImput = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'merek' => 'required',
            'bentukProduct' => 'required',
            'kegunaan' => 'required',
            'jenisKulit' => 'required',
            'kadaluarsa' => 'required',
            'umurSimpan' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'dikirim' => 'required',
            'contentDescription' => 'required'
        ]);

        if ($validatorImage->fails()) {
            return redirect('/admin/product')->with('failed', "Cannot upload image, check again your file image");
        }

        if ($validatorImput->fails()) {
            return redirect('/admin/product')->with('failed', "Failed to create new product, please check again input value");
        }

        $file = $request->file('fileName');
        $imageName = now()->timestamp.'.'.$file->getClientOriginalExtension();
        $path = public_path().'/assets/images/product';
        $file->move($path,$imageName);
    
        DB::table('product')->insert([
            'product_category' => $request->category,
            'name_product' => $request->name,
            'price' => $request->harga,
            'merek' => $request->merek,
            'bentuk_product' => $request->bentukProduct,
            'jenis_kulit' => $request->jenisKulit,
            'kegunaan' => $request->kegunaan,
            'kadaluarsa' => $request->kadaluarsa,
            'umur_simpan' => $request->umurSimpan,
            'stock' => $request->stok,
            'dikirim_dari' => $request->dikirim,
            'img_product' => "/assets/images/product/". $imageName,
            'description' => $request->contentDescription,
            'create_at' => now(),
            'update_at' => now()
        ]);
        return redirect('/admin/product')->with('success', "Succesfuly for create new product");
    }

    public function viewProduct($id, Request $request)
    {
        if($request->session()->has('email') == null){
			return redirect('/admin/login');
        }

        $product = DB::table('product')
                    ->join('product_category', 'product.product_category', '=', 'product_category.idcategory')
                    ->select('product.*', 'product_category.name_category')
                    ->where('idproduct', '=', $id)
                    ->get();
                    
        return $product;
    }


    public function editProduct($id, Request $request)
    {
        if($request->session()->has('email') == null){
			return redirect('/admin/login');
        }
        
        $idView = $id;
        $posSidebar = "Product";
        $posSubSidebar = "List Product" ;
        $product = DB::table('product')
                    ->join('product_category', 'product.product_category', '=', 'product_category.idcategory')
                    ->select('product.*', 'product_category.name_category')
                    ->where('idproduct', '=', $id)
                    ->get();
        $category = DB::table('product_category')->get();
        $username = $request->session()->get('username');
                    
        return view('Admin.Product.editProduct', compact('product', 'posSidebar', 'username', 'posSubSidebar', 'category', 'idView'));
    }

    public function saveEdit($id ,Request $request)
    {
        $validatorImput = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'merek' => 'required',
            'bentukProduct' => 'required',
            'kegunaan' => 'required',
            'jenisKulit' => 'required',
            'kadaluarsa' => 'required',
            'umurSimpan' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'dikirim' => 'required',
            'contentDescription' => 'required'
        ]);

        if ($validatorImput->fails()) {
            return redirect("/admin/product/edit/$id")->with('failed', "Failed to edit product, please check again input value");
        }

        $file = $request->file('fileName');
        if($file == null){
            DB::table('product')
            ->where('idproduct', $id)
            ->update([
                'name_product' => $request->name,
                'product_category' => $request->category,
                'merek' => $request->merek,
                'bentuk_product' => $request->bentukProduct,
                'kegunaan' => $request->kegunaan,
                'jenis_kulit' => $request->jenisKulit,
                'kadaluarsa' => $request->kadaluarsa,
                'umur_simpan' => $request->umurSimpan,
                'price' => $request->harga,
                'stock' => $request->stok,
                'dikirim_dari' => $request->dikirim,
                'description' => $request->contentDescription,
                'update_at' => now()
            ]);
        }else{
            $validatorImage = Validator::make($request->all(), [
                'fileName' => 'image|mimes:jpeg,jpg|max:2048'
            ]);

            if ($validatorImage->fails()) {
                return redirect("/admin/product/edit/$id")->with('failed', "Cannot upload image, check again your file image");
            }

            $imageName = now()->timestamp.'.'.$file->getClientOriginalExtension();
            $path = public_path().'/assets/images/product';
            $file->move($path,$imageName);

            DB::table('product')
            ->where('idproduct', $id)
            ->update([
                'name_product' => $request->name,
                'product_category' => $request->category,
                'merek' => $request->merek,
                'bentuk_product' => $request->bentukProduct,
                'kegunaan' => $request->kegunaan,
                'jenis_kulit' => $request->jenisKulit,
                'kadaluarsa' => $request->kadaluarsa,
                'umur_simpan' => $request->umurSimpan,
                'price' => $request->harga,
                'stock' => $request->stok,
                'dikirim_dari' => $request->dikirim,
                'img_product' => "/assets/images/product/". $imageName,
                'description' => $request->contentDescription,
                'update_at' => now()
            ]);
        }
       
        return redirect("/admin/product")->with('success', "Succesfuly for Edit product");
    }

    public function deleteProduct($id, Request $request)
    {
        if($request->session()->has('email') == null){
			return redirect('/admin/login');
        }

        DB::table('product')->where('idproduct', '=', $id)->delete();
        return redirect("/admin/product")->with('success', "Succesfuly for Delete product");
    }

}
