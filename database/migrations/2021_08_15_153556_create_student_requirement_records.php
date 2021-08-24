<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRequirementRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_requirement_records', function (Blueprint $table) {
            $table->id('no');
            $table->string('student_no');
            $table->unsignedBigInteger('requirement_no');
            $table->string('file_name');
            $table->string('file_directory');
            $table->date('date_submitted');
            $table->string('requirement_status')->default('PENDING');
            $table->text('comment');
            $table->foreign('student_no')->references('student_no')->on('student_list')->onDelete('cascade');
            $table->foreign('requirement_no')->references('no')->on('applicant_requirement_information')->onDelete('cascade');
     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_requirement_records');
    }
}
