<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
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
use App\Models\UserVoucher;
use App\Models\Profile;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ProductComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use JWTAuth;


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

    public function brand() {
        $brand = Brand::all();

        return $this->responseSuccess($brand);
    }

    public function productDetail(Request $request) {
        $product = Product::findOrFail($request->id);
        $product->product_image = env('APP_URL'). '/img/product/' . $product->product_image;

        $brand = Brand::where('brand_id', $product->brand_id)->first();
        $image = Productimage::where('product_id', $request->id)->get();
        $category = Category::where('category_id', $product->category_id)->first();
        $rate = Rate::where('product_id', $product->product_id)->avg('rate_scores');

        $arr_img = [];
        array_push($arr_img, $product->product_image);
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
            $getCart = $this->getCartOrder($request->user_id);
            return $this->responseSuccess(['carts' => $getCart['wishlists'], 'sum_quantity' => $getCart['sum_quantity'], 'sum_price' => $getCart['sum_price']]);
        } else {
            if ($request->type === 'delete') {
                $order = Order::where('user_id', $request->user_id)->whereNull('action')->first();
                $wishlist = Wishlist::where('product_id', $request->product_id)->where('user_id', $request->user_id)->first();
                $orderDetail = Order_Detail::where('product_id', $request->product_id)->where('order_id', $order->order_id)->first();

                $wishlist->delete();
                $orderDetail->delete();


                $getCart = $this->getCartOrder($request->user_id);
                return $this->responseSuccess(['carts' => $getCart['wishlists'], 'sum_quantity' => $getCart['sum_quantity'], 'sum_price' => $getCart['sum_price']]);

            } else {
                $product = Product::find($request->product_id);

                if (!$product) {
                    return json_encode([
                        'status' => false,
                        'msg' => 'Sản phẩm không tồn tại.',
                    ]);
                }

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
                            if ($request->type === 'update') {
                                $currentWishlistOrder->quantity = $request->quantity;
                                $currentWishlistOrder->save();
                            } else {
                                $currentWishlistOrder->quantity += $request->quantity;
                                $currentWishlistOrder->save();
                            }
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
                            if ($request->type === 'update') {
                                $orderDetail->quantity = $request->quantity;
                            } else {
                                $orderDetail->quantity += $request->quantity;
                            }
                            $orderDetail->detail_amount = !is_null($product->product_discount) ? ($product->product_price - (($product->product_discount /100) * $product->product_price)) * $wishlist->quantity : $product->product_price * $wishlist->quantity;
                            $orderDetail->save();
                        }
                    } catch(\Throwable $th) {
                        \Log::info('lỗi');
                        \Log::info($th);
                    }
                }


                $getCart = $this->getCartOrder($request->user_id);
                return $this->responseSuccess(['carts' => $getCart['wishlists'], 'sum_quantity' => $getCart['sum_quantity'], 'sum_price' => $getCart['sum_price']]);
            }
        }
    }

    public function payment(OrderRequest $request) {
        $validated = $request->validated();

        if ($request->type === 'vnpay') {
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

        if ($request->type === 'shipcode') {
            $this->saveOrder($request->all());

            return $this->responseSuccess(['success' => 'Đặt hàng thành công']);
        }
    }

    public function returnVnpay(Request $request)
    {
        $url = 'https://webmypham-dev.vn:2222/checkout';
        if($request->vnp_ResponseCode == "00") {
            return redirect($url);
        }
        // session()->forget('url_prev');
        // return redirect($url)->with('errors' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
    }

    public function listVoucher() {
        $voucher = Voucher::all();
        $params = [];
        $status = true;
        foreach($voucher as $vc) {
            if(Carbon::now() <= $vc->expires_at) {
                $status = true;
            } else {
                $status = false;
            }
            $newData = [
                "id" => $vc->id,
                "code" => $vc->code,
                "name" => $vc->name,
                "image" => env('APP_URL'). '/img/voucher/' . $vc->image,
                "start_date" => $vc->starts_at,
                "end_date" => $vc->expires_at,
                "minimum_order" => $vc->minimum_order,
                "description" => $vc->description,
                "quantity" => $vc->max_uses_user,
                "discount_amount" => $vc->discount_amount,
                "status" => $status
            ];
            array_push($params, $newData);
        }
        return $this->responseSuccess($params);
    }

    public function checkVoucher(Request $request) {
        if ($request->code_voucher == '') {
            $params = 'Bạn chưa chọn voucher';
            return $this->responseError($params);
        } else {
            $voucher = Voucher::where('code', $request->code_voucher)->first();
            $userVoucher = UserVoucher::where('user_id', $request->user_id)->where('voucher_id', $voucher->id)->get();
            if (!$voucher) {
                $params = 'Voucher bạn nhập không tồn tại';
                return $this->responseError($params);
            } else {
                if (count($userVoucher) >= $voucher->max_uses_user) {
                    $params = 'Voucher bạn nhập đã sử dụng quá lần sử dụng';
                    return $this->responseError($params);
                } else {
                    if(Carbon::now() >= $voucher->expires_at) {
                        $params = 'Voucher bạn nhập quá hạn sử dụng';
                        return $this->responseError($params);
                    } else {
                        if(Carbon::now() <= $voucher->starts_at) {
                            $params = 'Voucher bạn nhập chưa đến ngày sử dụng';
                            return $this->responseError($params);
                        } else {
                            if ($voucher->uses === 0) {
                                $params = 'Voucher đã hết lượt sử dụng';
                                return $this->responseError($params);
                            }
                            else {
                                if ($request->price < $voucher->minimum_order) {
                                    $params = 'Đơn hàng của bạn chưa đạt giá trị tối thiểu';
                                    return $this->responseError($params);
                                } else {
                                    $totalDiscount = $request->price * ($voucher->percentage * 0.01);
                                    if ($totalDiscount > $voucher->discount_amount) {
                                        $params = [
                                            'discount_price' => $voucher->discount_amount,
                                            'voucher_id' => $voucher->id
                                        ];
                                        return $this->responseSuccess($params);
                                    } else {
                                        $params = [
                                            'discount_price' => $totalDiscount,
                                            'voucher_id' => $voucher->id
                                        ];
                                        return $this->responseSuccess($params);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        // $params = 'test';
        // return $this->responseError($params);
    }

    public function categoryproduct(Request $request) {
        $orderby = '';
        $valueOrder = '';
        if($request->arrange[0] === 'az') {
            $orderby = 'product_name';
            $valueOrder = 'asc';
        } else if ($request->arrange[0] === 'za') {
            $orderby = 'product_name';
            $valueOrder = 'desc';
        } else if ($request->arrange[0] === 'plus') {
            $orderby = 'product_price';
            $valueOrder = 'asc';
        }else if ($request->arrange[0] === 'reduction') {
            $orderby = 'product_price';
            $valueOrder = 'desc';
        }
        $search = $request->search;
        $category = $request->category_id;

        $product = DB::table('cosmetics_product')
                    ->when(isset($search), function ($query) use ($search) {
                        return $query->where('product_name', 'like', "%$search%");
                    })
                    ->when(isset($category), function ($query) use ($category) {
                        return $query->where('category_id', 'like', "%$category%");
                    })
                    ->whereBetween('product_price', [$request->total[0],$request->total[1]])
                    ->whereIn('brand_id', $request->brand)
                    ->orderBy($orderby, $valueOrder)
                    ->limit(10)
                    ->get();
        foreach($product as $pr) {
            $pr->product_image = env('APP_URL'). '/img/product/' . $pr->product_image;
        }
        $dataCategory='';
        if($category) {
            $dataCategory = Category::where('category_id', $request->category_id)->first();
        }

        return $this->responseSuccess(['product' => $product, 'category' => $dataCategory]);
    }

    public function saveOrder($request) {
        // \Log::info($request);
        $order = Order::where('user_id', $request['user_id'])->where('action', null)->first();
        // lưu order
        $paramsOrder = [
            'order_time' => Carbon::now('Asia/Ho_Chi_Minh'),
            'order_total_money' => $request['total'],
            'pay_ship' => $request['pay_ship'],
            'action' => 1,
            'voucher_id' => $request['voucher_id'],
            'is_payment' => 1,
            'code' => time() . '_' . Str::random(4)
        ];
        $updateOrder = Order::where('user_id', $order->user_id)->where('action', null)->update($paramsOrder);

        //lưu thông tin vận chuyển
        $paramsInfo = [
            'order_id' => $order->order_id,
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'province_id' => $request['province'],
            'district_id' => $request['district'],
            'ward_id' => $request['ward'],
            'note' => isset($request['note']) ? $request['note'] : ''
        ];
        $info = Profile::create($paramsInfo);

        if ($request['voucher_id']) {

            //lưu người sử dụng voucher
            $paramsUserVoucher = [
                'user_id' => $request['user_id'],
                'voucher_id' => $request['voucher_id']
            ];
            $userVoucher = UserVoucher::create($paramsUserVoucher);

            //cập nhật lại số lượt sử dụng voucher

            $voucher = Voucher::find($request['voucher_id']);
            $voucher->uses = $voucher->uses - 1;
            $voucher->save();
        }

        // xóa wishlist
        $wishlist = Wishlist::where('user_id', $request['user_id'])->delete();
    }

    public function getCart(Request $request) {
        $status = $request->status;
        $order = Order::where('user_id', $request->user_id)
                        ->when(isset($status), function ($query) use ($status) {
                            return $query->where('action', 'like', "%$status%");
                        })
                        ->get();
        $array = [
            "order" => '',
            "detail_order" => ''
        ];
        $arrayTotal = [];
        if ($order) {
            $voucherData;
            foreach ($order as $key => $or) {
                $voucherData = Voucher::where('id', $or->voucher_id)->first();
                $arr = [];
                $sum = 0;
                $detail = Order_detail::where('order_id', $or->order_id)->get();
                foreach($detail as $dt) {
                    $product = Product::where('product_id',$dt->product_id)->first();
                    $sum = $sum + $dt->detail_amount;
                    $params = [
                        'order_detail_id' => $dt->order_detail_id,
                        'quantity' => $dt->quantity,
                        'detail_amount' => $dt->detail_amount,
                        'product_id' => $product->product_id,
                        'product_name' => $product->product_name,
                        'product_image' => env('APP_URL'). '/img/product/' . $product->product_image,
                    ];
                    array_push($arr, $params);
                }

                $voucher = 0;
                if ($voucherData) {
                    if ($sum > $voucherData->discount_amount) {
                        $voucher = $voucherData->discount_amount;
                    } else {
                        $voucher = $totalDiscount;
                    }
                }

                $dataOrder = [
                    'code' => $or->code,
                    'pay_ship' => $or->pay_ship,
                    'order_total_money' => $or->order_total_money,
                    'order_time' => $or->order_time,
                    'voucher' => $voucher
                ];

                array_push($arrayTotal, [$array['order'] = $dataOrder, $array['detail_order'] = $arr]);
            }
            return $this->responseSuccess( $arrayTotal);
        }
    }

    public function getCartOrder($request) {
        $wishlists = Product::select('cosmetics_product.*', 'cosmetics_wishlist.quantity as quantity')
            ->join('cosmetics_wishlist','cosmetics_wishlist.product_id','=','cosmetics_product.product_id')
            ->where('cosmetics_wishlist.user_id', $request)->orderBy('cosmetics_wishlist.wishlist_id','asc')->get();

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

        $params = [
            'wishlists' => $wishlists,
            'sum_quantity' => $sum_quantity,
            'sum_price' => $sum_price
        ];

        return $params;
    }

    public function rating(Request $request) {
         $user = $request->header('user_id');
         $rate = DB::table('cosmetics_rate')
             ->where('cosmetics_rate.product_id', $request->product_id)
             ->orderByRaw("CASE WHEN cosmetics_rate.user_id = '$user' then 1 END DESC")
             ->paginate(5);
        if ($rate['data']) {
            $rate->getCollection()->transform(function ($value) {
                $user = User::where('id', $value->user_id)->first();

                return $params = [
                    'rate_id' => $value->rate_id,
                    'user_id' => $value->user_id,
                    'rate_scores' => $value->rate_scores,
                    'rate_comment' => $value->rate_comment,
                    'date' => $value->created_at,
                    'name' => $user->name,
                    'image' => env('APP_URL') . '/img/user/' . $user->image
                ];
            });
        }
        return $this->responseSuccess($rate);
    }

    public function  comment(Request $request) {
        $user = $request->header('user_id');
        if ($request->value && $user) {
            $params = [
                "parent_id" => 0,
                "user_id" => $user,
                "product_id" => $request->product_id,
                "content" => $request->value,
            ];

            $createComment = ProductComment::create($params);
        }
        $comment = ProductComment::where('product_id', $request->product_id)->orderBy('id', 'DESC')->paginate(2);
        $comment->getCollection()->transform(function ($value) {
            $user = User::where('id', $value->user_id)->first();

            return $params = [
                "author" => $user->name,
                "avatar" => env('APP_URL'). '/img/user/' . $user->image,
                "content" => $value->content,
                "datetime" => $value->created_at
            ];
        });
        return $this->responseSuccess($comment);
    }
}
