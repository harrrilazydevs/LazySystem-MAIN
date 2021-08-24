<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_records', function (Blueprint $table) {
            $table->id('no');
            $table->string('name');
            $table->date('period_start');
            $table->date('period_end');
            $table->date('date_started');
            $table->date('date_ended');
            $table->unsignedBigInteger('started_by');
            $table->foreign('started_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch_records');
    }
}
