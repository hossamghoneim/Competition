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
        Schema::create('spare_question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spare_question_id');
            $table->boolean('is_correct');
            $table->string('description');

            $table->foreign('spare_question_id')->references('id')->on('spare_questions')->onDelete('cascade');
            $table->unique(["description","spare_question_id"],"description_spare_question");
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
        Schema::dropIfExists('spare_question_answers');
    }
};
