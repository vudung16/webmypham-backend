<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{ 
	protected $fillable = ['user_id','order_time','order_total_money','profile_id','action'];
    public $table = "cosmetics_order";
    protected $primaryKey = 'order_id';
}
