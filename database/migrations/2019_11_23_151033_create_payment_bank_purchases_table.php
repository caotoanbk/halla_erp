<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentBankPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_bank_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paymentplan_id');
            $table->integer('purchaserequest_id');
            $table->integer('bank_id');
            $table->timestamps();

            //relationships
            $table->foreign('paymentplan_id')->references('id')->on('paymentplans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('purchaserequest_id')->references('id')->on('purchaserequests')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_bank_purchases');
    }
}
