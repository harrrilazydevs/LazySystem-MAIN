<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEvaluationRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_evaluation_records', function (Blueprint $table) {
            $table->id('no');
            $table->string('student_no');
            $table->string('course_code');
            $table->unsignedBigInteger('started_by');
            $table->date('date');
            $table->string('evaluation_status');
            $table->text('comment');
            $table->foreign('started_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('student_no')->references('student_no')->on('student_list')->onDelete('cascade');
            $table->foreign('course_code')->references('course_code')->on('course_list')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_evaluation_records');
    }
}
