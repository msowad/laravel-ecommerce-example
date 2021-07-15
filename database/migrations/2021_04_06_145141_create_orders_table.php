<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('company')->nullable();
            $table->string('zip');
            $table->bigInteger('total_price');
            $table->string('coupon')->nullable();
            $table->string('tax')->nullable();
            $table->bigInteger('final_price');
            $table->string('payment_status')->nullable();
            $table->string('order_status')->nullable();
            $table->string('cancel_by')->nullable();
            $table->dateTime('cancel_on')->nullable();
            $table->dateTime('delivered_on')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
