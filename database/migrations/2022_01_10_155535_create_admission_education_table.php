<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_education', function (Blueprint $table) {
            $table->id();

            $table->foreignId('admission_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('board');
            $table->string('symbol_number');
            $table->string('passed_year');
            $table->string('percentage_cgpa');

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
        Schema::dropIfExists('admission_education');
    }
}
