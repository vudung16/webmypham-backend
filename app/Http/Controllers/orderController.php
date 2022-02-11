<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Category;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Order_detail;
use Carbon\Carbon;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public function construct() { 
        $home = [];
        $home['slides'] = Slide::where(['slide_status'=> 1])->orderBy('slide_id', 'DESC')->limit(3)->get();
        $home['productimgs'] = db::table('cosmetics_product_image')->limit(4)->get();
        $home['productfl'] = Product::where('product_discount','<>' ,'null')->limit(4)->get();
        $home['products'] = Product::whereNull('product_discount')->limit(4)->get();
        $home['category'] = db::table('cosmetics_category')->get();

        if(Auth::check()){
            $home['name'] = profile::select('cosmetics_profile.customer_name as proname')
            ->join('users','users.id','=','cosmetics_profile.user_id')
            ->where(['cosmetics_profile.user_id' => Auth::user()->id])->get();
            $wishlists = Product::select('cosmetics_product.*', 'cosmetics_wishlist.wishlist_id as wishid')
            ->join('cosmetics_wishlist','cosmetics_wishlist.product_id','=','cosmetics_product.product_id')
            ->where(['cosmetics_wishlist.user_id' => Auth::user()->id])->get();
            $home['wishlists'] = $wishlists;
            $id = Auth::user()->id;
            $cart = Wishlist::where(['cosmetics_wishlist.user_id' => $id ])->count();
            $home['cart'] = $cart;
        } 

        return $home;

    }
    public function getlistcart() {

        $currentUserId = auth()->id();
        $order = Order::where('user_id', $currentUserId)->whereNull('action')->first();
        $productOrders = null;

        if ($order) {
            $productOrders = Product::select('cosmetics_product.*','cosmetics_brand.brand_name as brandname', 'cosmetics_category.category_name as catename','cosmetics_brand.brand_id as brandid', 'cosmetics_category.category_id as cateid', 'cosmetics_wishlist.wishlist_id as wishlistid', 'cosmetics_wishlist.quantity as wishlistquantity', 'cosmetics_order_detail.detail_amount as detailamount')
            ->join('cosmetics_brand', 'cosmetics_brand.brand_id', '=', 'cosmetics_product.brand_id')
            ->join('cosmetics_category','cosmetics_category.category_id','=','cosmetics_product.category_id')
            ->join('cosmetics_wishlist','cosmetics_wishlist.product_id','=','cosmetics_product.product_id')
            ->join('cosmetics_order','cosmetics_order.user_id','=','cosmetics_wishlist.user_id')
            ->join('cosmetics_order_detail', 'cosmetics_order_detail.product_id', '=', 'cosmetics_product.product_id')
            ->where('cosmetics_wishlist.user_id', $currentUserId)
            ->where('cosmetics_order_detail.order_id', $order->order_id)
            ->whereNull('cosmetics_order.action')->get();
            // dd($productOrders);
        }
        $data = [
            'home'=>$this->construct(),
            'user' => auth()->user(),
            'productOrders' => $productOrders,
            'order'=>$order,
        ];

        return view('cart', $data);
    }

    public function postlistcart(Request $request){
        $inputData = $request->only([
            'product_id',
        ]);
        $productId = $inputData['product_id'];
        $product = Product::find($productId);
        if (!$product) {
            return json_encode([
                'status' => false,
                'msg' => 'Sản phẩm không tồn tại.',
            ]);
        }

        $currentUserId = auth()->id();
        $orderData = [
            'user_id' => $currentUserId,
        ];


        $currentWishlist = Wishlist::where('user_id', $currentUserId)->first();
        if(!$currentWishlist) {
            //Trường hợp chưa có wishlist thì tạo wishlist mới
            try{
                $wishlistOrder = [
                    'user_id' => $currentUserId,
                    'product_id' => $productId,
                    'quantity' => 1,
                ];
                $wishlistOrder = Wishlist::create($wishlistOrder);
            } catch(\Throwable $th) {
                \Log::info('thêm thất bại');
                \Log::info($th);
            }
        } else {
            //Trường hợp wishlist đã tồn tại
            $currentWishlistOrder = Wishlist::where('product_id', $productId)->where('user_id', $currentUserId)->first();
            
            try{
                if(!$currentWishlistOrder) {
                    //trường hợp wishlist đã tồn tại nhưng product chưa tồn tại
                    $wishlist = Wishlist::where('user_id',$orderData)->first();
                    $order_detail = [
                        'user_id' => $currentUserId,
                        'product_id' => $productId,
                        'quantity' => 1,
                    ];
                    $wishlistOrder = Wishlist::create($order_detail);
        
                } else {
                    // trường hợp wishlist và product đã tồn tại
                    $currentWishlistOrder->quantity += 1;
                    $currentWishlistOrder->save();
                }
            } catch(\Throwable $th) {
                \Log::info('lỗi');
                \Log::info($th);
            }
        }

        // tạo order và order_deltail mới

        $profile = Profile::where('user_id', $currentUserId)->first();
        $orderData1 = [
            'user_id' => $currentUserId,
            'profile_id' => $profile->profile_id,
        ];

        
        $order = Order::where('user_id', $currentUserId)->whereNull('action')->first();
        $wishlist = Wishlist::where('product_id', $productId)->first();
        if(!$order) {
            try {
                $order1 = Order::create($orderData1);
                $productOrderDetail = [
                    'order_id' => $order1->order_id,
                    'product_id' => $product->product_id,
                    'quantity' => $wishlist->quantity,
                    'detail_amount' => !is_null($product->product_discount) ? $product->product_discount * $wishlist->quantity : $product->product_price * $wishlist->quantity
                ];
                $orderDetail = Order_detail::create($productOrderDetail);
            } catch (\Throwable $th) {
                \Log::info('lỗi');
                \Log::info($th);
            }

            $cartNumber = Wishlist::where('user_id', $currentUserId)->sum('quantity');
            $test = Product::select('cosmetics_product.*','cosmetics_wishlist.wishlist_id as wishlistid', 'cosmetics_wishlist.quantity as wishlistquantity')
            ->join('cosmetics_wishlist','cosmetics_wishlist.product_id','=','cosmetics_product.product_id')
            ->where('cosmetics_wishlist.user_id', $currentUserId)->get();
            $print ='';
            if($test) {
                foreach ($test as $key => $values) {
                    $print .= '<div class="row">
                            <div class="col-xl-3">'.'<img src="img/product/'.$values->product_image.'" style="width: 40px; height:40px;">'.'</div>
                            <div class="col-xl-7">'.'<a href="/product/'.$values->product_id.'" style="font-size:11px;">'.$values->product_name.'</a>'.'<br>'.(($values->product_discount)!=null ? '<span class="value-sale" style="font-size:11px;">'.number_format($values->product_discount).'₫ x '.$values->wishlistquantity.'</span>' : '<span class="value-sale" style="font-size:11px;">'.number_format($values->product_price).'₫ x '.$values->wishlistquantity.'</span>').'</div>
                            <div class="col-xl-2 col-btn-wishlist">'.'<button type="button" class="btn-delete-wishlist btn-wishlist" data-product_id="'.$values->product_id.'">'.'<i class="fas fa-times"></i>'.'</button>'.'</div>
                           </div>';
                }
            }
            return json_encode([
                'status' => true,
                'msg' => 'Thêm sản phẩm vào giỏ hàng thành công.',
                'quantity' => $cartNumber,
                'wishlist' => $print,
            ]);
        }


        //trường hợp tồn tại order và product
        $orderDetail = Order_detail::where('product_id',$productId)->where('order_id', $order->order_id)->first();
        $wishlist = Wishlist::where('product_id', $wishlist->product_id)->first();
        
        try{
            if(!$orderDetail) { 
                $productOrderDetail = [
                    'order_id' => $order->order_id,
                    'product_id' => $product->product_id,
                    'quantity' => $wishlist->quantity,
                    'detail_amount' => !is_null($product->product_discount) ? $product->product_discount * $wishlist->quantity : $product->product_price * $wishlist->quantity,
                ];
                $orderDetail = Order_detail::create($productOrderDetail);
    
            } else {
                $orderDetail->quantity += 1;
                $orderDetail->detail_amount = !is_null($product->product_discount) ? $product->product_discount * $wishlist->quantity : $product->product_price * $wishlist->quantity;
                $orderDetail->save();
            }
        } catch(\Throwable $th) {
            \Log::info('lỗi');
            \Log::info($th);
        }

        $cartNumber = Wishlist::where('user_id', $currentUserId)->sum('quantity');
        $test = Product::select('cosmetics_product.*','cosmetics_wishlist.wishlist_id as wishlistid', 'cosmetics_wishlist.quantity as wishlistquantity')
            ->join('cosmetics_wishlist','cosmetics_wishlist.product_id','=','cosmetics_product.product_id')
            ->where('cosmetics_wishlist.user_id', $currentUserId)->get();
        $print ='';
        if($test) {
            foreach ($test as $key => $values) {
                $print .= '<div class="row">
                            <div class="col-xl-3">'.'<img src="img/product/'.$values->product_image.'" style="width: 40px; height:40px;">'.'</div>
                            <div class="col-xl-7">'.'<a href="/product/'.$values->product_id.'" style="font-size:11px;">'.$values->product_name.'</a>'.'<br>'.(($values->product_discount)!=null ? '<span class="value-sale" style="font-size:11px;">'.number_format($values->product_discount).'₫ x '.$values->wishlistquantity.'</span>' : '<span class="value-sale" style="font-size:11px;">'.number_format($values->product_price).'₫ x '.$values->wishlistquantity.'</span>').'</div>
                            <div class="col-xl-2 col-btn-wishlist">'.'<button type="button" class="btn-delete-wishlist btn-wishlist" data-product_id="'.$values->product_id.'">'.'<i class="fas fa-times"></i>'.'</button>'.'</div>
                           </div>';
            }
        }
        return json_encode([
            'status' => true,
            'msg' => 'Thêm sản phẩm vào giỏ hàng thành công.',
            'quantity' => $cartNumber,
            'wishlist' => $print,
        ]);
    }



    public function listorder(){
        $listcart['category'] = db::table('cosmetics_category')->get();
        $listcart['order'] = Order::select('cosmetics_order.*','cosmetics_profile.*')
        ->join('cosmetics_profile', 'cosmetics_profile.user_id','=', 'cosmetics_order.user_id')
        ->where(['cosmetics_order.user_id' => Auth::user()->id])->where('action', 2)->get();
        return view('listorder', ['listcart' => $listcart, 'home'=>$this->construct()]);
    }
    public function showdetail($order_id){
        $listcart['category'] = db::table('cosmetics_category')->get();
        $listcart['orderdetail'] = Order_detail::select('cosmetics_order_detail.*','cosmetics_product.*')
        ->join('cosmetics_product','cosmetics_product.product_id','=','cosmetics_order_detail.product_id')
        ->where(['cosmetics_order_detail.order_id'=> $order_id])->get();
        return view('detailorder', ['listcart' => $listcart, 'home'=>$this->construct()]);
    }
    public function getaddprofile($id){
        $user = User::find($id);
        return view('/profile/addprofile', ['user' => $user]);
    }
    public function profile(Request $request, $id){
        $profile = new Profile;
        $profile->user_id = $request->customer_email;
        $profile->customer_name = $request->customer_name;
        $profile->customer_address = $request->customer_address;
        $profile->customer_phone = $request->customer_phone;
        $profile->save();
        return redirect('/home');
    }

    public function getprofile(){
        $id = Auth::user()->id;
        $profiles = Profile::select('cosmetics_profile.*')->where(['cosmetics_profile.user_id' => $id])->get();
        return view('/profile/profile', ['profiles' => $profiles]);
    }
    public function editprofile(Request $request){
        $profile_id = $request->profile_id;
        Profile::where('profile_id',$profile_id)
        ->update([
            'customer_name'=> $request->customer_name,
            'customer_address'=> $request->customer_address,
            'customer_phone'=> $request->customer_phone
        ]);
        return redirect('profile');
    }


    public function addorder(Request $request, $order_id){
        $currentUserId = auth()->id();
        $currentOrder = Order::where('user_id', $currentUserId)->whereNull('action')->first();
        $totalMoney = Order_detail::where('order_id', $currentOrder->order_id)->sum('detail_amount');
        
        $order = Order::find($order_id);
        $order->order_time = Carbon::now();
        $order->order_total_money = $totalMoney; 
        $order->action = 1;
        $order->save();

        $wishid = wishlist::select('cosmetics_wishlist.wishlist_id')->where(['cosmetics_wishlist.user_id'=>$currentUserId])->delete();

        
        
    }


    public function index(){
        $listcart['category'] = db::table('cosmetics_category')->get();
        $listcart['order'] = Order::select('cosmetics_order.*','cosmetics_profile.*')
        ->join('cosmetics_profile', 'cosmetics_profile.user_id','=', 'cosmetics_order.user_id')->get();
        return view('admin/order/listorder', ['listcart' => $listcart]);
    }

    public function getProductOrder($order_id) {
        $currentUserId = auth()->id();
        $order = Order::where('user_id', $currentUserId)->where('action', 1)->first();
        $productOrders = Order_detail::select('cosmetics_order_detail.*','cosmetics_product.product_id as productid','cosmetics_product.product_name as productname','cosmetics_product.product_image as productimage','cosmetics_product.product_price as productprice','cosmetics_product.product_discount as productdiscount','cosmetics_order.order_total_money as totalmoney')
            ->join('cosmetics_product', 'cosmetics_product.product_id', '=', 'cosmetics_order_detail.product_id')
            ->join('cosmetics_order','cosmetics_order.order_id','=','cosmetics_order_detail.order_id')
            ->where('cosmetics_order.action', 1)->where('cosmetics_order.order_id', $order_id)->get();
        \Log::info($productOrders);
        $data = [
            'home'=>$this->construct(),
            'user' => auth()->user(),
            'productOrders' => $productOrders,
            'order'=>$order,
        ];
        return view('admin/order/productorders', $data);
    }
    public function postProductOrder($order_id){
        \Log::info('ok');
        Order::where('order_id',$order_id)
        ->update([
            'action'=> 2,
        ]);
        
    }
}
