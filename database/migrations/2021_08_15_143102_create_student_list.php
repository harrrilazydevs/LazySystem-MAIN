<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_list', function (Blueprint $table) {
            $table->string('student_no')->primary();
            $table->string('student_type');
            $table->string('school_code');
            $table->string('program_code');
            $table->foreign('school_code')->references('school_code')->on('school_list')->onDelete('cascade');
            $table->foreign('program_code')->references('program_code')->on('program_list')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_list');
    }
}
