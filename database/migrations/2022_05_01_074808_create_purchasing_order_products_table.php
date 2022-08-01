<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasingOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasing_order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchasing_order_id')->constrained('purchasing_orders')->onUpdate('cascade')->onDelete('cascade');
            $table->string('product_name');
            $table->integer('order_qty');
            $table->integer('recieved_qty');
            $table->integer('return_qty');
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
        Schema::dropIfExists('purchasing_order_products');
    }
}
