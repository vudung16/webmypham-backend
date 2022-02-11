<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Rate;
use Illuminate\Http\Request;

class rateController extends Controller
{
    public function postRate(Request $request, $id) {
		if(Auth::user()) {
			$product_id = $id;

			$product = Product::find($id);
			$rate = new Rate;
			$rate->product_id = $product_id;
			$rate->user_id = Auth::user()->id;
			$rate->rate_scores = $request->rate;
			$rate->rate_comment = $request->Comment;
			$rate->save();

			return redirect('/product/'.$product->product_id)->with('thongbao','Viết bình luận thành công');
		} else {
			return redirect('login');
		}

	}
}
