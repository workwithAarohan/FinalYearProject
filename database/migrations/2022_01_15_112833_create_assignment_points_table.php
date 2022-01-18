<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_points', function (Blueprint $table) {
            $table->id();

            $table->foreignId('classroom_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('assignment_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('student_id')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('pointsObtained')->nullable();
            $table->boolean('is_returned')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_points');
    }
}
