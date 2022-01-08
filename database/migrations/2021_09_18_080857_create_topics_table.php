<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();

            $table->string('topic_title');
            $table->foreignId('classroom_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('credit_hrs');
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');

            $table->boolean('is_completed')->default(0);

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
        Schema::dropIfExists('topics');
    }
}
