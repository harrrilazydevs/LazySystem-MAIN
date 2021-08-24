<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPaymentRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_payment_records', function (Blueprint $table) {
            $table->id('no');
            $table->string('student_no');
            $table->string('purpose');
            $table->double('amount_payed');
            $table->date('payment_date');
            $table->string('received_by');
            $table->foreign('student_no')->references('student_no')->on('student_list')->onDelete('cascade');
            $table->foreign('received_by')->references('employee_code')->on('employee_list')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_payment_records');
    }
}
