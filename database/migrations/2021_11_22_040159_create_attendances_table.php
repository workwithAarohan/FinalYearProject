<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('classroom_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('teacher_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('topic_covered');

            $table->date('attendance_date');

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
        Schema::dropIfExists('attendances');
    }
}
