<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productimage extends Model
{
    // use HasFactory;
    public $table = "cosmetics_product_image";
    protected $primaryKey = 'product_image_id'; 
}
