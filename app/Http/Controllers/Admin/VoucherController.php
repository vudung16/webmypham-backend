<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Facades\File;
use App\Http\Requests\VoucherRequest;
use Carbon\Carbon;

class VoucherController extends Controller
{
    public function getVoucher(Request $request) {
        \Log::info($request->all());
        $search = $request->search;
        $start = $request->starts_at ? CarBon::parse($request->starts_at)->format('Y-m-d')." 00:00:00" : '';
        $end = $request->expires_at ? CarBon::parse($request->expires_at)->format('Y-m-d')." 23:59:59" : '';
        $voucher = Voucher::where('code', 'like', "%$search%")
        ->where('starts_at', 'like', "%$start%")
        ->where('expires_at', 'like', "%$end%")
        ->orderBy('id', 'DESC')->paginate(10);
        if ($voucher) {
            $voucher->getCollection()->transform(function ($value) {
                $value->image = env('APP_URL') . '/img/voucher/' . $value->image;
                return $value;
            });
        }
        return $this->responseSuccess($voucher);
    }
    public function deleteVoucher(Request $request) {
        File::delete(public_path().'/img/voucher/'.Voucher::find($request->id)->image);
        Voucher::find($request->id)->delete();
        return $this->responseSuccess();
    }
}
