<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYetkazibBerishesTable extends Migration
{
    public function up()
    {
        Schema::create('yetkazib_berishes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('delivery_type')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
