<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_settings', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
			$table->string('start_time');
			$table->string('title');
			$table->integer('offer_duration');
			$table->integer('offer_daily_order');
			$table->string('product_name');
			$table->string('product_price');
			$table->string('product_brand');
			$table->string('product_brand');
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
        Schema::dropIfExists('offer_settings');
    }
}
