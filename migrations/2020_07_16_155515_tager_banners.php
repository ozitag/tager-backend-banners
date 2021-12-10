<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TagerBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tager_banners', function (Blueprint $table) {
            $table->id();

            $table->string('banner_zone')->index();
            $table->unsignedInteger('priority')->default(1);

            $table->unsignedBigInteger('image_id');
            $table->string('link');
            $table->boolean('open_new_tab')->default(false);

            $table->string('status');
            $table->boolean('disabled')->default(false);
            $table->dateTime('start_at')->nullable();
            $table->dateTime('finish_at')->nullable();

            $table->text('comment')->nullable();

            if (Schema::hasTable('files')) {
                $table->foreign('image_id')->references('id')->on('files');
            }

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tager_banners');
    }
}
