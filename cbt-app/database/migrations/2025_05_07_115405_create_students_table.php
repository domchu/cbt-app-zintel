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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
              $table->string('surname');
            $table->string('first_name');
            $table->string('other_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');  
            $table->integer('phone')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('registration_number')->unique();
            $table->mediumText('address')->nullable();
            $table->date('dob')->nullable();
            $table->string('image');
            $table->tinyInteger('role')->default(2);//0=>Super Admin, 1=>Admin/Vendor, 2=>User
            $table->tinyInteger('status')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};