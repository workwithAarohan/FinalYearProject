<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_student', function (Blueprint $table) {
            $table->foreignId('assignment_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('student_id')
                ->constrained()
                ->onDelete('cascade');

            $table->integer('points_obtained')->nullable();

            $table->boolean('is_checked')->default(0);

            $table->string('file')->nullable();

            $table->primary(['assignment_id','student_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_student');
    }
}
