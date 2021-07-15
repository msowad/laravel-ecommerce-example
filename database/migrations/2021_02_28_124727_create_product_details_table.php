<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->bigInteger('mrp')->nullable();
            $table->bigInteger('price');
            $table->bigInteger('qty')->default(0);
            $table->bigInteger('size_id');
            $table->bigInteger('color_id');
            $table->bigInteger('product_id');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('order_id')->default(1);
            $table->tinyInteger('alert')->default(0);
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('product_details');
    }
}
