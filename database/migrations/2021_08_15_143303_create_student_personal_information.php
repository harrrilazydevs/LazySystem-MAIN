<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPersonalInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_personal_information', function (Blueprint $table) {
            $table->id('no');
            $table->string('student_no');
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('suffix');
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
            $table->integer('no_sibling');
            $table->string('passport_no');
            $table->string('acr_no');
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
        Schema::dropIfExists('student_personal_information');
    }
}
