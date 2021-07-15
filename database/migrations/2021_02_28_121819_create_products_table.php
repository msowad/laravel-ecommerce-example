<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->bigInteger('brand_id');
            $table->string('name');
            $table->string('slug');
            $table->string('model')->nullable();
            $table->longText('short_description');
            $table->longText('description');
            $table->longText('keywords');
            $table->longText('technical_specification')->nullable();
            $table->longText('usage')->nullable();
            $table->longText('warrenty')->nullable();
            $table->string('lead_time');
            $table->bigInteger('tax_id');
            $table->tinyInteger('promo');
            $table->tinyInteger('featured');
            $table->tinyInteger('discounted');
            $table->tinyInteger('trending');
            $table->tinyInteger('best_seller');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('products');
    }
}
