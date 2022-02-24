<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Productimage;
use App\Models\Rate;
use App\Models\Wishlist;
use Carbon\Carbon;
use App\Models\Order_detail;
use App\Models\Order;
use App\Models\Voucher;

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

    public function category() {
        $category = Category::all();
        
        return $this->responseSuccess($category);
    }

    public function productDetail(Request $request) {
        $product = Product::findOrFail($request->id);
        $product->product_image = env('APP_URL'). '/img/product/' . $product->product_image;
        
        $brand = Brand::where('brand_id', $product->brand_id)->first();
        $image = Productimage::where('product_id', $request->id)->get();
        $category = Category::where('category_id', $product->category_id)->first();
        $rate = Rate::where('product_id', $product->product_id)->avg('rate_scores');

        $arr_img = [];
        foreach($image as $img) {
            $img->product_image_name = env('APP_URL'). '/img/product_image/'.$img->product_image_name;
            array_push($arr_img, $img->product_image_name);
        }

        // \Log::info($rate);

        $params = [
            'brand' => $brand->brand_name,
            'product' => $product,
            'product_image' => $arr_img,
            'category' => ['name' => $category->category_name, 'id' => $category->category_id],
            'rate' => $rate
        ];

        return $this->responseSuccess($params);
    }


    // thêm vào giỏ hàng
    public function addToCart(Request $request) {
        if ($request->product_id === null && $request->quantity === null) {
            $wishlists = Product::select('cosmetics_product.*', 'cosmetics_wishlist.quantity as quantity')
            ->join('cosmetics_wishlist','cosmetics_wishlist.product_id','=','cosmetics_product.product_id')
            ->where('cosmetics_wishlist.user_id', $request->user_id)->get();

            foreach($wishlists as $pr) {
                $pr->product_image = env('APP_URL'). '/img/product/' . $pr->product_image;
            }

            $sum_quantity = 0;
            foreach($wishlists as $key=>$value){
                if(isset($value->quantity)) {
                    $sum_quantity += $value->quantity;
                }
            }
            $sum_price = 0;
            foreach($wishlists as $key=>$value){
                if(isset($value->product_discount)) {
                    $sum_price += ($value->product_price - (($value->product_discount /100) * $value->product_price)) * $value->quantity;
                } else {
                    $sum_price += $value->product_discount;
                }
            }
            return $this->responseSuccess(['carts' => $wishlists, 'sum_quantity' => $sum_quantity, 'sum_price' => $sum_price]);
        } else {
            $product = Product::find($request->product_id);

            if (!$product) {
                return json_encode([
                    'status' => false,
                    'msg' => 'Sản phẩm không tồn tại.',
                ]);
            }
    
            // $currentUserId = auth()->id();
            // $orderData = [
            //     'user_id' => $currentUserId,
            // ];
    
    
            $currentWishlist = Wishlist::where('user_id', $request->user_id)->first();
            if(!$currentWishlist) {
                //Trường hợp chưa có wishlist thì tạo wishlist mới
                try{
                    $wishlistOrder = [
                        'user_id' => $request->user_id,
                        'product_id' => $request->product_id,
                        'quantity' => $request->quantity,
                    ];
                    $wishlistOrder = Wishlist::create($wishlistOrder);
                } catch(\Throwable $th) {
                    \Log::info('thêm thất bại');
                    \Log::info($th);
                }
            } else {
                //Trường hợp wishlist đã tồn tại
                $currentWishlistOrder = Wishlist::where('product_id', $request->product_id)->where('user_id', $request->user_id)->first();
                
                try{
                    if(!$currentWishlistOrder) {
                        //trường hợp wishlist đã tồn tại nhưng product chưa tồn tại
                        $wishlist = Wishlist::where('user_id', $request->user_id)->first();
                        $order_detail = [
                            'user_id' => $request->user_id,
                            'product_id' => $request->product_id,
                            'quantity' => $request->quantity,
                        ];
                
                        $wishlistOrder = Wishlist::create($order_detail);
            
                    } else {
                        // trường hợp wishlist và product đã tồn tại
                        $currentWishlistOrder->quantity += $request->quantity;
                        $currentWishlistOrder->save();
                    }
                } catch(\Throwable $th) {
                    \Log::info('lỗi');
                    \Log::info($th);
                }
            }
    
            // tạo order và order_deltail mới
            $orderData1 = [
                'user_id' => $request->user_id,
            ];
    
            
            $order = Order::where('user_id', $request->user_id)->whereNull('action')->first();
            $wishlist = Wishlist::where('product_id', $request->product_id)->first();
            if(!$order) {
                try {
                    $order1 = Order::create($orderData1);
                    $productOrderDetail = [
                        'order_id' => $order1->order_id,
                        'product_id' => $request->product_id,
                        'quantity' => $wishlist->quantity,
                        'detail_amount' => !is_null($product->product_discount) ? ($product->product_price - (($product->product_discount /100) * $product->product_price)) * $wishlist->quantity : $product->product_price * $wishlist->quantity
                    ];
                    $orderDetail = Order_detail::create($productOrderDetail);
                } catch (\Throwable $th) {
                    \Log::info('lỗi');
                    \Log::info($th);
                }    
            } else {
                //trường hợp tồn tại order và product
                $order1 = Order::where('user_id', $request->user_id)->whereNull('action')->first();
                $orderDetail = Order_detail::where('product_id', $request->product_id)->where('order_id', $order1->order_id)->first();
                $wishlist = Wishlist::where('product_id', $request->product_id)->first();
                
                try{
                    if(!$orderDetail) { 
                        $productOrderDetail = [
                            'order_id' => $order->order_id,
                            'product_id' => $product->product_id,
                            'quantity' => $wishlist->quantity,
                            'detail_amount' => !is_null($product->product_discount) ? $product->product_price - (($product->product_discount /100) * $product->product_price) * $wishlist->quantity : $product->product_price * $wishlist->quantity,
                        ];
                        $orderDetail = Order_detail::create($productOrderDetail);
                    } else {
                        $orderDetail->quantity += $request->quantity;
                        $orderDetail->detail_amount = !is_null($product->product_discount) ? ($product->product_price - (($product->product_discount /100) * $product->product_price)) * $wishlist->quantity : $product->product_price * $wishlist->quantity;
                        $orderDetail->save();
                    }
                } catch(\Throwable $th) {
                    \Log::info('lỗi');
                    \Log::info($th);
                }
            }


            $wishlists = Product::select('cosmetics_product.*', 'cosmetics_wishlist.quantity as quantity')
                ->join('cosmetics_wishlist','cosmetics_wishlist.product_id','=','cosmetics_product.product_id')
                ->where('cosmetics_wishlist.user_id', $request->user_id)->get();
            
            foreach($wishlists as $pr) {
                $pr->product_image = env('APP_URL'). '/img/product/' . $pr->product_image;
            }

            $sum_quantity = 0;
            foreach($wishlists as $key=>$value){
                if(isset($value->quantity)) {
                    $sum_quantity += $value->quantity;
                }
            }
            $sum_price = 0;
            foreach($wishlists as $key=>$value){
                if(isset($value->product_discount)) {
                    $sum_price += ($value->product_price - (($value->product_discount /100) * $value->product_price)) * $value->quantity;
                } else {
                    $sum_price += $value->product_discount;
                }
            }
            return $this->responseSuccess(['carts' => $wishlists, 'sum_quantity' => $sum_quantity, 'sum_price' => $sum_price]);
            
        }
    }

    public function payment(Request $request) {
        session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "2W0TX27O"; //Mã website tại VNPAY 
        $vnp_HashSecret = "OVCTODOGEIHQBJVOYXXDCZIVPPEWBVSG"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:2223/api/return-vnpay";
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->total * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return $this->responseSuccess($vnp_Url);
    }

    public function returnVnpay(Request $request)
    {
        $url = 'https://webmypham-dev.vn:2222/checkout';
        \Log::info($request->all());
        if($request->vnp_ResponseCode == "00") {
            return redirect($url);
        }
        // session()->forget('url_prev');
        // return redirect($url)->with('errors' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
    }

    public function listVoucher() {
        $voucher = Voucher::all();
        foreach($voucher as $vc) {
            $vc->image = env('APP_URL'). '/img/voucher/' . $vc->image;
        }
        return $this->responseSuccess($voucher);
    }
}