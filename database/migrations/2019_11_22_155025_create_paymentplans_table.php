<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentplans', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_payment');
            $table->integer('user_id');
            $table->string('docno');
            $table->timestamps();

            // // relationships
            // $table->foreign('user_id')
            // ->references('id')->on('users')
            // ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paymentplans');
    }
}
