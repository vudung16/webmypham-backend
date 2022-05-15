<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class OrderController extends Controller
{
    public function getOrder(Request $request) {
        $start_date = $request->date_start;
        $end_date = $request->date_end;
        $key_search = $request->key_search;
        $province_id = $request->province_id;
        $district_id = $request->district_id;
        $ward_id = $request->wards_id;
        $status = '';
        if ($request->status === 'order_create') {
            $status = 1;
        } else if ($request->status === 'order_receive') {
            $status = 2;
        } else if ($request->status === 'order_delivery') {
            $status = 3;
        } else if ($request->status === 'order_finish') {
            $status = 4;
        } else if ($request->status === 'order_cancel') {
            $status = 5;
        }
        $order = DB::table('cosmetics_order')
        ->join('cosmetics_profile', 'cosmetics_profile.id', '=', 'cosmetics_order.order_id')
        ->whereBetween('cosmetics_order.order_time', [$start_date, $end_date])
        ->where('cosmetics_order.code', 'like' , "%$key_search%")
        ->where('cosmetics_profile.province_id', 'like', "%$province_id%")
        ->where('cosmetics_profile.district_id', 'like', "%$district_id%")
        ->where('cosmetics_profile.ward_id', 'like', "%$ward_id%")
        ->select(DB::raw('COUNT(*) as `count`'))
        ->where('cosmetics_order.action', 'like', $status)
        ->paginate(10);
        
    }
}
