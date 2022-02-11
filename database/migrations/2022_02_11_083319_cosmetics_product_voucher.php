<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CosmeticsProductVoucher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'cosmetics_product_voucher', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->integer( 'product_id' )->unsigned( );
            $table->bigInteger( 'voucher_id' )->unsigned( );
        
            $table->unique( [ 'product_id', 'voucher_id' ] );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cosmetics_product_voucher');
    }
}
