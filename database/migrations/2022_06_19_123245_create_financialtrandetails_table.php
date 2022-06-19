<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financialtrandetails', function (Blueprint $table) {
            $table->id();
            $table->double('amount')->default(0);
            $table->string('crdr');
            $table->foreignId('feetype_id')->references('id')->on('feetypes');
            $table->foreignId('module_id')->references('id')->on('modules');
            $table->foreignId('financialtran_id')->references('id')->on('financialtrans');
            $table->foreignId('branch_id')->references('id')->on('branches');
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
        Schema::dropIfExists('financialtrandetails');
    }
};
