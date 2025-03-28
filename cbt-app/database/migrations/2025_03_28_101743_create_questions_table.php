<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
           $table->unsignedBigInteger('subject_id');
            $table->foreignId('exam_id')->constrained()->onDelete('cascade');
    $table->foreignId('question_id')->constrained()->onDelete('cascade');
        $table->integer('year');
        $table->text('question');
        $table->string('option_a');
        $table->string('option_b');
        $table->string('option_c');
        $table->string('option_d');
        $table->string('option_e');
        $table->string('correct_answer');
            $table->timestamps();

             // Foreign key for subjects
        $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};