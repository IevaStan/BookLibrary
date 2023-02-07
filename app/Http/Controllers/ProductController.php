<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    // public function displayProduct() 
    // {
    //     return view("products", [
    //         "name" => "Batai",
    //         "price" => number_format(12,2)
    //     ]);
    // }
    public function create()
    {
        $product = new Product();
        $product->name = 'apple';
        $product->price = 34;
        $product->created_at = "2022-12-31";
        $product->save();
        dd($product);
    }
}
