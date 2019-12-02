<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linepayments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paymentplan_id');
            $table->integer('user_id');
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->dateTime('action_date')->nullable();
            $table->string('comment');
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
        Schema::dropIfExists('linepayments');
    }
}
