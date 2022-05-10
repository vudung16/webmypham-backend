<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\File;
use App\Http\Requests\BrandRequest;
use Carbon\Carbon;


class BrandController extends Controller
{
    public function getBrand(Request $request) {
        $search = $request->search;
        $brand = Brand::where('brand_name', 'like', "%$search%")->orderBy('brand_id', 'DESC')->paginate(10);
        if ($brand) {
            $brand->getCollection()->transform(function ($value) {

                return $params = [
                    'id' => $value->brand_id,
                    'name' => $value->brand_name,
                    'image' => env('APP_URL') . '/img/brand/' . $value->image,
                ];
            });
        }
        return $this->responseSuccess($brand);
    }
    public function deleteBrand(Request $request) {
        File::delete(public_path().'/img/brand/'.Brand::find($request->id)->image);
        Brand::find($request->id)->delete();
        return $this->responseSuccess();
    }
    public function createBrand(BrandRequest $request) {
        $validated = $request->validated();
        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->move('img/brand/', $fileNameToStore);

            $brand = new Brand;
            $brand->image = $fileNameToStore;
            $brand->brand_name = $request->name;
            $brand->save();
            $this->responseSuccess();
        }  else {
            $this->responseError('Có lỗi xảy ra');
        }
    }
    public function updateBrand(BrandRequest $request) {
        $validated = $request->validated();

        $brand_id = $request->id;
        $imageOld = Brand::find($brand_id)->image;

        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->move('img/brand/', $fileNameToStore);
            File::delete(public_path().'/img/brand/'.$imageOld);

            Brand::where('brand_id',$brand_id)->update([
                'image'=> $fileNameToStore,
                'brand_name'=>$request->name,
            ]);
            $this->responseSuccess();

        }   
        else {
            Brand::where('brand_id',$brand_id)->update([
                'brand_name'=>$request->name,
            ]);
            $this->responseSuccess();
        }
    }
}
