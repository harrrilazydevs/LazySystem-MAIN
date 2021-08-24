<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentScholasticInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_scholastic_information', function (Blueprint $table) {
            $table->id('no');
            $table->string('student_no');
            $table->string('scholastic_level');
            $table->text('address');
            $table->string('year_attended');
            $table->text('course')->default('N/A');
            $table->text('major')->default('N/A');
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
        Schema::dropIfExists('student_scholastic_information');
    }
}
