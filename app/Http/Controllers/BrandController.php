<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\models\Brand;
class BrandController extends Controller
{
    public function index(){
        $brands = db::table('cosmetics_brand')->get();
        return view('admin\brand\listbrand', ['brands' => $brands]);
    }
    public function addBrand(Request $request){
        $this->validate($request,
            [
                'brand_name' => 'required|min:3|max:100',
            ],[
                'brand_name.required' => 'Bạn chưa nhập tên',
                'brand_name.min' => 'Độ dài tối thiểu là 3 kí tự',
                'brand_name.max' => 'Độ dài tối đa là 100 kí tự',
            ]);
        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->save();
        return redirect('admin/brand');
    }
    public function detailBrand($brand_id){
        return $brand = Brand::find($brand_id);    
    }
    public function deleteBrand($brand_id){
        Brand::find($brand_id)->delete();
    }
    public function editbrand(Request $request){
        $this->validate($request,
            [
                'brand_name' => 'required|min:3|max:100',
            ],[
                'brand_name.required' => 'Bạn chưa nhập tên',
                'brand_name.min' => 'Độ dài tối thiểu là 3 kí tự',
                'brand_name.max' => 'Độ dài tối đa là 100 kí tự',
            ]);
        $brand_id = $request->brand_id;
        Brand::where('brand_id',$brand_id)
        ->update([
            'brand_name'=> $request->brand_name,
        ]);
        return redirect('admin/brand');
    }
}
    