<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_subject', function (Blueprint $table) {
            $table->foreignId('examination_id')
                ->constrained('examination')
                ->onDelete('cascade');

            $table->foreignId('subject_id')
                ->constrained()
                ->onDelete('cascade');

            $table->integer('full_mark')->nullable();
            $table->integer('pass_mark')->nullable();

            $table->foreignId('teacher_id')
                ->constrained()
                ->onDelete('cascade');

            $table->boolean('is_checked')->default(0);

            $table->primary(['examination_id','subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examination_subject');
    }
}
