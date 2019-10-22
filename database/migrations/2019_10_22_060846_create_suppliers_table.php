<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('SupplierName', 255);
            $table->string('SupplierAddress', 255)->nullable();
            $table->string('SupplierShortName', 255)->nullable();
            $table->string('SupplierPhone', 50)->nullable();
            $table->string('SupplierBankAccount', 255)->nullable();
            $table->string('SupplierBankName', 255)->nullable();
            $table->string('SupplierBankBranch', 255)->nullable();
            $table->string('SupplierInformation', 255)->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
