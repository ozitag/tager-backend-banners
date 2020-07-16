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
        Schema::create('tager_banner_areas', function (Blueprint $table) {
            $table->id();

            $table->string('alias');
            $table->string('label');

            $table->unique('alias');

            $table->softDeletes();
        });

        Schema::create('tager_banners', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('banner_area_id');
            $table->unsignedInteger('priority');

            $table->text('title')->nullable();
            $table->text('text')->nullable();
            $table->unsignedBigInteger('image_id')->nullable();
            $table->text('button_label')->nullable();
            $table->text('button_link')->nullable();
            $table->boolean('button_is_new_tab')->default(false);

            $table->foreign('banner_area_id')->references('id')->on('tager_banner_areas');

            if (Schema::hasTable('files')) {
                $table->foreign('image_id')->references('id')->on('files');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tager_menu_items');
        Schema::dropIfExists('tager_menus');
    }
}
