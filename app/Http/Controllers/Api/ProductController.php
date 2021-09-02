<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\ProductResource;


class ProductController extends Controller
{
    public function products(){
        $products = Product::get();

        return ProductResource::collection($products);
    }
}
