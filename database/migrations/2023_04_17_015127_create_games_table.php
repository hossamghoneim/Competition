<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('question_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('spare_question_id')->nullable();

            $table->boolean('your_turn')->default(FALSE);

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('spare_question_id')->references('id')->on('spare_questions');
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
        Schema::dropIfExists('games');
    }
};
