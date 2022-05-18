<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    public $table = "warehouse";
    protected $primaryKey = 'id';
    protected $guarded = [];  
    public $timestamps = false;
}
