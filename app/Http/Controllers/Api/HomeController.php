<?php
namespace App\Http\Controllers\Api;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slide;
class HomeController extends Controller
{
    public function homeSlide() {
        \Log::info('ok');
        $slide = Slide::where(['slide_status'=> 1])->orderBy('slide_id', 'DESC')->limit(3)->get();
        foreach($slide as $sl) {
            \Log::info($sl->slide_image);
        }
    }
    // public function test() { 
    //     $rating = Rate::select('rate.*')->avg('rate.rate_scores');
    //     $home = [];
    //     $home['slides'] = Slide::where(['slide_status'=> 1])->orderBy('slide_id', 'DESC')->limit(3)->get();
    //     $home['productimgs'] = db::table('product_image')->limit(4)->get();
    //     $home['productfl'] = Product::where('product_discount','<>' ,'null')->limit(4)->get();

    //     $home['products'] = Product::select('product.*')
    //     ->join('rate', 'rate.product_id', '=', 'product.product_id')
    //     ->whereNull('product_discount')->where('rate.rate_scores','>', $rating)->limit(4)->get();
    //     $home['category'] = db::table('category')->get();

    //     if(Auth::check()){
    //         $home['name'] = profile::select('profile.customer_name as proname')
    //         ->join('users','users.id','=','profile.user_id')
    //         ->where(['profile.user_id' => Auth::user()->id])->get();
    //         $wishlists = Product::select('product.*', 'wishlist.wishlist_id as wishid')
    //         ->join('wishlist','wishlist.product_id','=','product.product_id')
    //         ->where(['wishlist.user_id' => Auth::user()->id])->get();
    //         $home['wishlists'] = $wishlists;
    //         $id = Auth::user()->id;
    //         $cart = Wishlist::where(['wishlist.user_id' => $id ])->count();
    //         $home['cart'] = $cart;
    //     } 
    //     return $home;

    // }
    // public function addToCart(Request $request, $product_id){
        
    //     session()->push('cart',$product_id);
    //     $id = Auth::user()->id;
    //     $wishlist = new Wishlist;
    //     $wishlist->user_id = $id;
    //     $wishlist->product_id = $product_id; 
    //     $wishlist->save();
    // }

    // public function lsslide(){  
    //     return view('home', ['home' => $this->test()]);
    // }


    // public function showListProduct_byIdCate($category_id){
    //     $productcate['category'] = db::table('category')->get();
    //     $productcate['name'] = Category::where('category_id','like',"%$category_id%")->first();
    //     // dd($productcate['name']);
    //     $productcate['product'] = Product::select('product.*')
    //     ->join('category','category.category_id','=','product.category_id')
    //     ->where(['product.category_id' => $category_id])->get();

    //     return view('danhsachsp', ['productcate' => $productcate, 'home'=>$this->test()]);
    // }


    // public function showListProduct_byIdBrand($brand_id){
    //     $productbrand['category'] = db::table('category')->get();
    //     $productbrand['name'] = Brand::wherebrand_id($brand_id)->first();
    //     // dd($productbrand['name']);
    //     $productbrand['sl'] = Product::select('product.*')
    //     ->join('brand','brand.brand_id','=','product.brand_id')
    //     ->where(['product.brand_id' => $brand_id])
    //     ->get();
    //     return view('danhsachbr', ['productbrand' => $productbrand, 'home'=>$this->test()]);
    // }
    // public function showListProduct(){
    //     $productall = [];
    //     $productall['category'] = db::table('category')->get();
    //     $productall['products'] =db::table('product')->get();
    //     return view('danhsachall', ['productall' => $productall, 'home'=>$this->test()]);
    // }

    // public function showProduct($product_id){
    //     $product['category'] = db::table('category')->get();
    //     $product['productshow'] = Product::select('product.*','brand.brand_name as brandname')
    //     ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
    //     ->where(['product.product_id' => $product_id])->get();
    //     $product['rate'] = Rate::where('product_id', $product_id)->get();
    //     // dd($product['rate']);
    //     $test = Product::where('product_id', $product_id)->first();
    //     return view('sanpham', ['product' => $product, 'test'=>$test, 'home'=>$this->test()]);
    // }


    // public function showCart($product_id){
    //     $product = [];
    //     $product['category'] = db::table('category')->get();
    //     $product['productshow'] = Product::select('product.*','brand.brand_name as brandname')
    //     ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
    //     ->where(['product.product_id' => $product_id])->get();
    //     return view('cart', ['product' => $product, 'home'=>$this->test()]);
    // }


    // public function search(Request $request) {
    //     $key = $request->search;
    //     $product = Product::orderBy('product_id','DESC')->where('product_name', 'like', "%$key%")->paginate(1);
        
    //     return view('search', ['product' => $product, 'key' => $key, 'home'=>$this->test()]);
    // }
} 
