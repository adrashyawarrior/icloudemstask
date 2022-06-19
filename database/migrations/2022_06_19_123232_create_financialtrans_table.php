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
        Schema::create('financialtrans', function (Blueprint $table) {
            $table->id();
            $table->double('amount')->default(0);
            $table->string('txid');
            $table->string('admno');
            $table->foreignId('module_id')->references('id')->on('modules');
            $table->string('crdr');
            $table->date('txdate');
            $table->string('academicyear');
            $table->unsignedInteger('entrymodeno');
            $table->string('voucherno');
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
        Schema::dropIfExists('financialtrans');
    }
};
