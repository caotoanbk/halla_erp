<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('EmployeeName', 20);
            $table->string('EmployeeFirstName', 255);
            $table->string('EmployeeLastName', 255);
            $table->string('EmployeeInformation', 255);
            $table->integer('section_id')->unsigned();
            $table->string('EmployeeStatus', 50);
            $table->string('EmployeeEmail', 255);
            $table->string('EmployeeImage', 255);
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('employees');
    }
}
