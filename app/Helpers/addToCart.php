<?php
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\view;

if (! function_exists('showCartNumber')) {
    function showCartNumber()
    {
        $currentUserId = auth()->id();
        $cartNumber = 0;
        $cartNumber1 = Wishlist::where('user_id', $currentUserId)
                ->sum('quantity');
       

        if ($cartNumber1) {
            $cartNumber = Wishlist::where('user_id', $currentUserId)
                ->sum('quantity');
        }

        return $cartNumber; 
    }
} 

if(! function_exists('showWishlist')) {
    function showWishlist() {
        $currentUserId = auth()->id();
        $wishlist = 0;
        $wishlist1 = Product::select('cosmetics_product.*','cosmetics_wishlist.wishlist_id as wishlistid', 'cosmetics_wishlist.quantity as wishlistquantity')
            ->join('cosmetics_wishlist','cosmetics_wishlist.product_id','=','cosmetics_product.product_id')
            ->where('cosmetics_wishlist.user_id', $currentUserId)->get();

        if($wishlist1) {
            $wishlist = Product::select('cosmetics_product.*','cosmetics_wishlist.wishlist_id as wishlistid', 'cosmetics_wishlist.quantity as wishlistquantity')
            ->join('cosmetics_wishlist','cosmetics_wishlist.product_id','=','cosmetics_product.product_id')
            ->where('cosmetics_wishlist.user_id', $currentUserId)->get();
        }
        return view('wishlist', ['wishlist'=>$wishlist]);
    }
}