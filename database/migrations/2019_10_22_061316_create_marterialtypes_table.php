<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarterialtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materialtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MaterialtypeName', 255);
            $table->string('MaterialtypeInformation', 255)->nullable();
            $table->string('MaterialtypeRemark', 255)->nullable();
            $table->string('MaterialtypeStatus', 50)->nullable();
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
        Schema::dropIfExists('materialtypes');
    }
}
