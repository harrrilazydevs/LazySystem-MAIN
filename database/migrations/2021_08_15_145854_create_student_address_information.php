<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAddressInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_address_information', function (Blueprint $table) {
            $table->id('no');
            $table->string('student_no');
            $table->integer('house_no');
            $table->string('street');
            $table->string('subdivision');
            $table->string('brgy');
            $table->string('city');
            $table->string('zipcode');
            $table->date('address_type');
            $table->foreign('student_no')->references('student_no')->on('student_list')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_address_information');
    }
}
