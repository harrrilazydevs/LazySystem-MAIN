<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_information', function (Blueprint $table) {
            $table->id('no');
            $table->string('program_code');
            $table->string('course_code');
            $table->string('school_year');
            $table->string('term');
            $table->double('price');
            $table->foreign('program_code')->references('program_code')->on('program_list')->onDelete('cascade');
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
        Schema::dropIfExists('curriculum_information');
    }
}
