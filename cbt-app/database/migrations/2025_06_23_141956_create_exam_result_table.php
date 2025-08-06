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
        Schema::create('exam_result', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('name');
            $table->string('subject');
            $table->integer('year');
            $table->string('exam_type');
            $table->integer('score');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_result');
    }
};
