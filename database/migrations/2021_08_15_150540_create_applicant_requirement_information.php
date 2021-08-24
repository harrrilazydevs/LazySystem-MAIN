<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantRequirementInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_requirement_information', function (Blueprint $table) {
            $table->id('no');
            $table->string('program_code');
            $table->string('applicant_type');
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
        Schema::dropIfExists('applicant_requirement_information');
    }
}
