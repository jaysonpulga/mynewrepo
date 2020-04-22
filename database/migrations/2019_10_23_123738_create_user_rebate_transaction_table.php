<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRebateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rebate_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('campaign_id');
            $table->string('product_id');
            $table->string('pay_method');
            $table->string('status');
            $table->string('sender_batch_id')->nullable();
            $table->string('sender_item_id')->nullable();            
            $table->string('payout_item_id')->nullable();
            $table->string('payout_batch_id')->nullable();
            $table->string('process_date');
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
        Schema::dropIfExists('user_rebate_transaction');
    }
}
