<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_topics', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->foreignId('topic_id')
                ->constrained()
                ->onDelete('cascade');
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
        Schema::dropIfExists('sub_topics');
    }
}
