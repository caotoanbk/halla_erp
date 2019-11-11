<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashgroups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('CashgroupCode', 10)->nullable();
            $table->string('CashgroupName', 100);
            $table->string('CashgroupSecondname', 100)->nullable();
            $table->string('CashgroupUnit', 50)->nullable();
            $table->integer('CashgroupFrequency')->default('1')->nullable();
            $table->string('CashgroupBudget', 50)->nullable();
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
        Schema::dropIfExists('cashgroups');
    }
}
