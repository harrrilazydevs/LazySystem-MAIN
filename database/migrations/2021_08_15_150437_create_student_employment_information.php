<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEmploymentInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_employment_information', function (Blueprint $table) {
            $table->id('no');
            $table->string('student_no');
            $table->string('employment_status');
            $table->text('company')->default('N/A');
            $table->text('address')->default('N/A');
            $table->text('position')->default('N/A');
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
        Schema::dropIfExists('student_employment_information');
    }
}
