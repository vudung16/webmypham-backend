<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ImportController extends Controller
{
    public function getProductImport(Request $request) {
        $product = Product::where('name', 'like', "%$request->search%")->get();
        foreach ($product as $pr) {
            $pr->image = env('APP_URL'). '/img/product/' . $pr->image;
        }
        return $this->responseSuccess($product);
    }
}
