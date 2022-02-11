<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;
    protected $table = "cosmetics_product_comment";

    public function product() {
    	return $this->belongsTo('App\Models\Product','product_id','product_id');
    }

    public function User() {
    	return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function parent() {
    	return $this->belongsTo('App\Models\ProductComment','parent_id','id');
    }
}
