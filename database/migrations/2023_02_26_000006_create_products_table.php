<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_title');
            $table->longText('product_description')->nullable();
            $table->integer('price');
            $table->integer('stock');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
