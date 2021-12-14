<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TagerBannersFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tager_banners_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('banner_id');
            $table->foreign('banner_id')->references('id')->on('tager_banners');
            $table->string('field');
            $table->longText('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tager_banners_fields');
    }
}
