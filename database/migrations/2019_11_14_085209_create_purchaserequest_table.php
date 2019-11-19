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
            $table->tinyInteger('numOfPayments')->default(0);
            $table->string('title');
            $table->string('paymentDate', 20);
            $table->string('receiveDate', 20);
            $table->string('currency', 20);
            $table->string('purpose');
            $table->integer('supplierId');
            $table->string('termOfPayment');
            $table->string('paymentMethod');
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
        Schema::dropIfExists('purchaserequests');
    }
}
