<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;

class WebviewController extends Controller
{
    public function homeSlide() {
        $slide = Slide::where(['slide_status'=> 1])->orderBy('slide_id', 'DESC')->limit(3)->get();
        $banner = Slide::where(['slide_status'=> 0])->orderBy('slide_id', 'DESC')->limit(4)->get();
        
        $array = [];
        $img = '';
        foreach($slide as $sl) {
            $img = env('APP_URL'). '/img/slide/' . $sl->slide_image;
            array_push($array, $img);
        }
        return $this->responseSuccess(['slide' => $array, 'bannner' => $banner]);
    }

    public function homeProduct() {
        $product = Product::orderBy('product_id', 'DESC')->limit(10)->get();
        foreach($product as $pr) {
            $pr->product_image = env('APP_URL'). '/img/product/' . $pr->product_image;
        }

        return $this->responseSuccess(['product' => $product]);
    }

    public function productDiscount() {
        $productDiscount = Product::whereNotNull('product_discount')->orderBy('product_id', 'DESC')->limit(10)->get();
        foreach($productDiscount as $pr) {
            $pr->product_image = env('APP_URL'). '/img/product/' . $pr->product_image;
        }

        return $this->responseSuccess(['productDiscount' => $productDiscount]);
    }

    public function productSelling() {
        $productSelling = Product::orderBy('product_selling', 'DESC')->limit(10)->get();
        foreach($productSelling as $pr) {
            $pr->product_image = env('APP_URL'). '/img/product/' . $pr->product_image;
        }

        return $this->responseSuccess(['productSelling' => $productSelling]);
    }
}
