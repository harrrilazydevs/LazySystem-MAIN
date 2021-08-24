<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFamilyInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_family_information', function (Blueprint $table) {
            $table->id('no');
            $table->string('student_no');
            $table->string('name');
            $table->string('occupation');
            $table->double('income');
            $table->string('relationship');
            $table->string('contact_no');
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
        Schema::dropIfExists('student_family_information');
    }
}
