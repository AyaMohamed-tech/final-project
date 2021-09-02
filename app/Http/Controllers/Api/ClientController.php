<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\HomeResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SliderResource;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class ClientController extends Controller
{
    public function home()
    {
        $sliders = Slider::where('status', '1')->get();
        $products = Product::where('status', '1')->paginate(8);
        $categories = Category::get();
        return [
            'sliders' => SliderResource::collection($sliders),
            'products' => ProductResource::collection($products),
            'categories' => CategoryResource::collection($categories),
        ];
    }
    public function shop()
    {
        $categories = Category::get();
        $products = Product::where('status', '1')->get();
        return [
            'products' => ProductResource::collection($products),
            'categories' => CategoryResource::collection($categories),
        ];
    }
}
