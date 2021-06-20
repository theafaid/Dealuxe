<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name')->default('SkyendScope');
            $table->string('site_slogan')->nullable();
            $table->string('site_keywords')->nullable();
            $table->string('site_description')->nullable();
            $table->string('site_icon')->nullable();
            $table->string('site_logo')->nullable();
            $table->boolean('open')->default(true);
            $table->text('social_links')->nullable();
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
        Schema::dropIfExists('site_settings');
    }
}
