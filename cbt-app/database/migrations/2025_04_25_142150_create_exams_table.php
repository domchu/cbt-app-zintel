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
       Schema::create('exams', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('user_id');    // FK to users
    $table->unsignedBigInteger('subject_id'); // FK to subjects
    $table->integer('year');
    $table->integer('score')->nullable();
    $table->enum('status', ['ongoing', 'completed'])->default('ongoing');
    $table->json('user_answers')->nullable();

    $table->timestamps();

    // Foreign keys
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};