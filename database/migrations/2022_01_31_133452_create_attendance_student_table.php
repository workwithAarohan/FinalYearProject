<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_student', function (Blueprint $table) {
            $table->foreignId('attendance_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('student_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('status')->nullable();

            $table->primary(['student_id','attendance_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_student');
    }
}
