<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Termwind\Components\Raw;

class ProductController extends Controller
{
    public function add()
    {
        $categories = Category::all();

        return view("add_product", compact("categories"));
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $price = $request->price;
        $stock = $request->stock;
        $photo = $request->photo;
        $desc = $request->description;
        $category_id = $request->category_id;
        $stand = $request->stand;

        // $datetime = date("Y-m-d H:i:s");
        // $namafile = 'public/' .$name. $datetime;

        // move_uploaded_file($request->photo->pathname, "$namafile");

        Product::create([
            "name"=> $name,
            "price"=> $price,
            "stock"=> $stock,
            "photo"=> $photo,
            "description"=> $desc,
            "category_id"=> $category_id,
            "stand"=> $stand
        ]);

        return redirect()->back()->with("status", "Berhasil menambah produk");
    }

    public function deleteProduct()
    {
        // Product::find($id)->delete();
        $products = Product::all();

        $product = "";

        return view('delete_product', compact('products', 'product'));

        // return redirect()->back()->with("status","Berhasil menghapus produk");
    }

    public function deleteProductCard(Request $request)
    {
        $products = Product::all();

        $product_id = $request->product_id;
        // dd($product_id);

        $product = Product::find($product_id);

        return view('delete_product', compact('product', 'products'));
    }

    public function destroy(Request $request)
    {
        $product_id = $request->product_id;

        $delete = Product::find($product_id)->delete();

        if ($delete)
        {
            return redirect('/home')->with('status', 'Berhasil menghapus produk');
        }
        else
        {
            return redirect('/home')->with('status','Gagal menghapus produk');
        }
    }
}
