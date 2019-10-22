<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcesstextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('accesstexts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('AccesstextName', 255);
            $table->string('AccesstextInformation', 255);
            $table->string('AccesstextStatus', 50)->nullable();
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
        Schema::dropIfExists('accesstexts');
    }
}
