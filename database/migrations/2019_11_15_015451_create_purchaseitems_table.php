<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchaserequest_id');
            $table->string('MaterialName');
            $table->string('unit');
            $table->integer('quantity');
            $table->integer('unp');
            $table->bigInteger('amount');
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
        Schema::dropIfExists('purchaseitems');
    }
}
