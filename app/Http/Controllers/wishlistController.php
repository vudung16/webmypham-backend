<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Order_Detail;
use App\Models\Order;
class wishlistController extends Controller
{
    public function deletewishlist($product_id){
        $currentUserId = auth()->id();
        $order = Order::where('user_id', $currentUserId)->whereNull('action')->first();
        $wishlist = Wishlist::where('product_id', $product_id)->where('user_id', $currentUserId)->first();
        $orderDetail = Order_Detail::where('product_id', $product_id)->where('order_id', $order->order_id)->first();
        // \Log::info($wishlist);
        try {
            $wishlist->delete();
            $orderDetail->delete();

            $currentOrder = Order::where('user_id', $currentUserId)->whereNull('action')->first();
            $totalMoney = Order_detail::where('order_id', $currentOrder->order_id)->sum('detail_amount');
            
            $cartNumber = Wishlist::where('user_id', $currentUserId)->sum('quantity');
            $result =[
                'status' => true,
                'msg' => 'Xóa thành công!',
                'totalMoney' => $totalMoney,
                'quantity' => $cartNumber,
            ];
        } catch (\Throwable $th) {
            \Log::error($th);

            $result = [
                'status' => false,
                'msg' => 'Lỗi!',
            ];
        }

        return json_encode($result);
    }
}
