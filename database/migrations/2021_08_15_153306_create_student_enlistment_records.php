<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEnlistmentRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_enlistment_records', function (Blueprint $table) {
            $table->id('no');
            $table->string('student_no');
            $table->string('course_code');
            $table->string('evaluated_by');
            $table->date('date');
            $table->string('evaluation_status');
            $table->text('comment');
            $table->unsignedBigInteger('enlistment_batch');
            $table->foreign('student_no')->references('student_no')->on('student_list')->onDelete('cascade');
            $table->foreign('course_code')->references('course_code')->on('course_list')->onDelete('cascade');
            $table->foreign('evaluated_by')->references('employee_code')->on('employee_list')->onDelete('cascade');
            $table->foreign('enlistment_batch')->references('no')->on('batch_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_enlistment_records');
    }
}
