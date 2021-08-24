<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_information', function (Blueprint $table) {
            $table->id('no');
            $table->string('employee_code');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('suffix')->nullable();
            $table->string('nationality');
            $table->string('religion');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->integer('age');
            $table->string('civil_status');
            $table->string('gender');
            $table->string('signature');
            $table->string('picture');
            $table->string('email_address');
            $table->string('mobile_no');
            $table->foreign('employee_code')->references('employee_code')->on('employee_list')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_information');
    }
}
