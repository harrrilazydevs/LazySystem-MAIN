<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAssessmentRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_assessment_records', function (Blueprint $table) {
            $table->id('no');
            $table->unsignedBigInteger('admission_record_no');
            $table->string('course_code');
            $table->string('day');
            $table->string('time');
            $table->string('professor_code');
            $table->foreign('admission_record_no')->references('no')->on('student_admission_records')->onDelete('cascade');
            $table->foreign('course_code')->references('course_code')->on('course_list')->onDelete('cascade');
            $table->foreign('professor_code')->references('employee_code')->on('employee_list')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_assessment_records');
    }
}
