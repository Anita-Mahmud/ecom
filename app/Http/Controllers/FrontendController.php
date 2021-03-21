<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index(){
        return view('welcome', [
            'categories' => Category::latest()->get(),
            'products' => Product::latest()->get(),
        ]);
    }
    function product_details($product_id){
        $category_id = Product::find($product_id)->category_id;
        return view('productdetails', [
            'product_info' => Product::find($product_id),
            'related_products' => Product::where('category_id', $category_id)->where('id', '!=', $product_id)->get()
        ]);
    }
    function about(){
        return view('about');
    }
    function contact(){
        return view('contact');
    }
    function portfolio(){
        return view('portfolio');
    }
    function shop(){
        return view('shop', [
            'all_products' => Product::all(),
            'categories' => Category::all()
        ]);
    }
    function shop_category($category_id){
        return view('shopcategory', [
            'category_name' => Category::find($category_id)->category_name,
            'all_products' => Product::where('category_id', $category_id)->latest()->get()
        ]);
    }
    function search(){
        $q=$_GET['q'];
        $alphaorder =$_GET['alphaorder'];
        if($alphaorder==1){
            $search_results = Product::where('product_name', 'like', '%' . $q . '%')->orderBy('product_name', 'asc')->get(); //A-Z
        }
       else{
            $search_results = Product::where('product_name', 'like', '%' . $q . '%')->orderBy('product_name', 'desc')->get();//Z-A
       }

        return view('search',[
            'search_results'=> $search_results
        ]);
    }
}
