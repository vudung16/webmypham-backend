<?php 
  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;
class productController extends Controller
{
    public function index(){
        $categorys = db::table('cosmetics_category')->get();        
        $brands = db::table('cosmetics_brand')->get();
        $products = Product::select('cosmetics_product.*','cosmetics_category.category_name as name_cate','cosmetics_brand.brand_name as name_brand')
		->join('cosmetics_category','cosmetics_category.category_id','=','cosmetics_product.category_id')
        ->join('cosmetics_brand', 'cosmetics_brand.brand_id', '=', 'cosmetics_product.brand_id')->paginate(1); 
        return view('admin\product\listproduct', ['products' => $products,'brands' => $brands,'categorys' => $categorys]);
    }
    public function addProduct(request $request){
        $this->validate($request,[
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
            'product_image' => 'required',
        ],[
            'product_name.required' => 'Bạn chưa nhập tên sản phẩm',
            'product_description.required' => 'Bạn chưa nhập mô tả',
            'product_price.required' => 'Bạn chưa nhập giá',
            'product_image.required' => 'Bạn chưa tải ảnh lên',
        ]);
        if($request->hasFile('product_image')){
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('product_image')->move('img/product/', $fileNameToStore);
        }   
        else {
            $fileNameToStore = 'no-image.png';
        }
        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_image = $fileNameToStore;
        $product->product_price = $request->product_price;
        $product->product_discount = $request->product_discount;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->save();
        return redirect('admin/product');
    }

    public function deleteProduct($product_id){
        File::delete(public_path().'img/product/'.Product::find($product_id)->product_image);
        Product::find($product_id)->delete();
    }

    public function detailProduct($product_id){
        $product = Product::find($product_id);
        $data = [];
        $data['product'] =  $product;
        return response()->json(['error' => false, 'data' => $data], 200);
    }

    public function editProduct(Request $request){
        $this->validate($request,[
            'product_name' => 'required',
            'product_description' => 'required',
            'product_price' => 'required',
        ],[
            'product_name.required' => 'Bạn chưa nhập tên sản phẩm',
            'product_description.required' => 'Bạn chưa nhập mô tả',
            'product_price.required' => 'Bạn chưa nhập giá',
        ]);
        $product_id = $request -> product_id;
        $imageOld = Product::find($product_id)->product_image;
        if($request->hasFile('product_image')){
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('product_image')->move('img/product/', $fileNameToStore);
            File::delete(public_path().'/img/product/'.$imageOld);
        }   
        else {
            $fileNameToStore = $imageOld;
        }
        Product::where('product_id', $product_id)->update([
            'product_name' => $request ->product_name,
            'product_description' => $request ->product_description,
            'product_image' => $fileNameToStore,
            'product_price' => $request ->product_price,
            'product_discount' => $request->product_discount,
            'category_id' => $request ->category_id,
            'brand_id' => $request ->brand_id,
        ]);
        return redirect('admin/product');
    }   
}
