<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productimage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
class productImageController extends Controller
{
        public function index(){
            $products = db::table('cosmetics_product')->get();    
            $productimgs = Productimage::select('cosmetics_product_image.*','cosmetics_product.product_id as id_product','cosmetics_product.product_name as name_product')
            ->join('cosmetics_product', 'cosmetics_product.product_id', '=', 'cosmetics_product_image.product_id')->get();
            return view('admin\product\imgproduct', ['productimgs' => $productimgs,'products' => $products]);
        }
        public function addProductImg(request $request)
        {
            $this->validate($request,
            [
                'product_image_name' => 'required',
            ],[ 
                'product_image_name.required' => 'Bạn chưa tải ảnh lên',
            ]);
            if($request->hasFile('product_image_name')){
                $filenameWithExt = $request->file('product_image_name')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('product_image_name')->getClientOriginalExtension();
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                $path = $request->file('product_image_name')->move('img/product_image/', $fileNameToStore);
            }   
            else {
                $fileNameToStore = 'no-image.png';
            }
            $productimg = new Productimage;
            $productimg->product_id = $request->product_id;
            $productimg->product_image_name= $fileNameToStore;
            $productimg->save();
            return redirect('admin/productimage');
        }
        public function deleteProductImg($product_image_id){
            Productimage::find($product_image_id)->delete();
        }
        public function detailProductImg($product_image_id){
            return $productimage = Productimage::find($product_image_id);
        }
        public function editProductImg(Request $request){
            $this->validate($request,
            [
                'product_image_name' => 'required',
            ],[ 
                'product_image_name.required' => 'Bạn chưa tải ảnh lên',
            ]);
            $product_image_id = $request -> product_image_id;
            $imageOld = Productimage::find($product_image_id)->product_image_name;
            if($request->hasFile('product_image_name')){
                $filenameWithExt = $request->file('product_image_name')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('product_image_name')->getClientOriginalExtension();
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                $path = $request->file('product_image_name')->move('img/product_image/', $fileNameToStore);
                File::delete(public_path().'/img/product_image/'.$imageOld);
            }   
            else {
                    $fileNameToStore = $imageOld;
            }
            Productimage::where('product_image_id', $product_image_id)->update([
                'product_image_name' => $fileNameToStore,
                'product_id' => $request -> product_id,
            ]);
            return redirect('admin/productimage');
        }   
    
}

