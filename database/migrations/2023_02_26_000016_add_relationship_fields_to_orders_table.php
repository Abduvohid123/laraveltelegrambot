<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7996571')->references('id')->on('users');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_7996572')->references('id')->on('products');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id', 'location_fk_7996588')->references('id')->on('locations');
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->foreign('payment_type_id', 'payment_type_fk_7996589')->references('id')->on('payments');
            $table->unsignedBigInteger('yetkazish_id')->nullable();
            $table->foreign('yetkazish_id', 'yetkazish_fk_7996803')->references('id')->on('yetkazib_berishes');
        });
    }
}
