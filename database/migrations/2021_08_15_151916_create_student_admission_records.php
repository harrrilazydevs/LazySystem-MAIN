<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAdmissionRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_admission_records', function (Blueprint $table) {
            $table->id('no');
            $table->string('student_no');
            $table->string('enrollment_type');
            $table->date('enrollment_date');
            $table->string('sy_start');
            $table->string('sy_end');
            $table->string('semester');
            $table->string('student_year');
            $table->unsignedBigInteger('admission_batch');
            $table->foreign('student_no')->references('student_no')->on('student_list')->onDelete('cascade');
            $table->foreign('admission_batch')->references('no')->on('batch_records')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_admission_records');
    }
}
