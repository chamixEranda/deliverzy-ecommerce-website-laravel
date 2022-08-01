<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasing_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('decription')->nullable();
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
        Schema::dropIfExists('purchasing_orders');
    }
}
