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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
                $table->integer('year');
            $table->integer('score')->default(0); // Score obtained
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->string('title');
            $table->integer('duration'); // in minutes
             $table->json('user_answers')->nullable();
            $table->timestamps();

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