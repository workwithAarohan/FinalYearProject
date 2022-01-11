<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('temporaryAddress');
            $table->string('permanentAddress');
            $table->string('phone');
            $table->date('dob');
            $table->string('gender');
            $table->string('nationality');
            $table->string('blood_group');
            $table->string('pp_photo');

            $table->string('father_name');
            $table->string('mother_name');

            $table->foreignId('admission_window_id')
                ->constrained('admission_windows')
                ->onDelete('cascade');

            $table->boolean('is_admitted')->default(0);

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
        Schema::dropIfExists('admissions');
    }
}
