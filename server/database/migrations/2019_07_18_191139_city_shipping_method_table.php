<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CityShippingMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_shipping_method', function (Blueprint $table) {
            $table->unsignedInteger('city_id')->index();
            $table->unsignedSmallInteger('shipping_method_id')->index();

            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade');

            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_shipping_method');
    }
}
