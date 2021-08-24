<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTranscriptRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_transcript_records', function (Blueprint $table) {
            $table->id('no');
            $table->string('student_no');
            $table->string('course_code');
            $table->string('final_grade');
            $table->string('course_status');
            $table->string('school_year');
            $table->string('term');
            $table->string('professor_code');
            $table->foreign('student_no')->references('student_no')->on('student_list')->onDelete('cascade');
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
        Schema::dropIfExists('student_transcript_records');
    }
}
