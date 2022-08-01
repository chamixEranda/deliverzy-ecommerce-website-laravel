<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlist_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wishlist_id')->constrained('wishlists')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('products_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('wishlist_product');
    }
}
