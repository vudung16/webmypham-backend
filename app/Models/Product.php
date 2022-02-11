<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "cosmetics_product";
    protected $primaryKey = 'product_id';

    public function cosmetics_rate() {
    	return $this->hasMany('App\Models\Rate','product_id','product_id');
    }
}
