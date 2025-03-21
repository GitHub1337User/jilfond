<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function index(){
        $products = Product::all();
        return view('pages.index',compact('products'));
    }

    public function productById($id) {

        $product = Product::findOrFail($id);


        return view('pages.product',compact('product'));
    }
    public function cart(){

        return view('pages.cart');
    }
}
