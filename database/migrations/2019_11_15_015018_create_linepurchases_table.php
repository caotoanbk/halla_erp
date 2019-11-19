<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinepurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linepurchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchaserequest_id');
            $table->integer('user_id');
            $table->tinyInteger('type');
            $table->tinyInteger('status');
            $table->string('comment');
            $table->timestamps();

            //foreign key
            $table->foreign('purchaserequest_id')->references('id')->on('purchaserequests')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linepurchases');
    }
}
