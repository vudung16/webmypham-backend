<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCosmeticsOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cosmetics_order_detail', function (Blueprint $table) {
            $table->bigIncrements('order_detail_id');
            $table->integer('product_id');
            $table->unsignedBigInteger('order_id');
            $table->integer('quantity');
            $table->integer('detail_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cosmetics_order_detail');
    }
}
