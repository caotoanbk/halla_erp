<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaserequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaserequests', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('purchaseType')->default(0);
            $table->integer('cashgroupId');
            $table->string('docNumber')->nullable();
            $table->tinyInteger('numOfPayments')->default(0);
            $table->string('title');
            $table->string('paymentDate', 20);
            $table->string('receiveDate', 20);
            $table->string('currency', 20);
            $table->string('purpose');
            $table->integer('supplierId');
            $table->integer('userId');
            $table->string('termOfPayment');
            $table->string('paymentMethod');
            $table->tinyInteger('isSubmitted')->default('0');
            $table->timestamps();
            
            // relationships
            $table->foreign('userId')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchaserequests');
    }
}
