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
        Schema::create('question_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('question_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            $table->boolean('team_is_selected')->nullable();
            $table->boolean('team_is_finished')->default(FALSE);
            $table->boolean('question_is_selected')->nullable();
            $table->enum('answer_status', ['correct', 'incorrect'])->nullable();

            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('question_results');
    }
};
