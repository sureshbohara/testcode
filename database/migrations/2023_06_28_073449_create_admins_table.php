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
            Schema::create('admins', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('address')->nullable();
                $table->string('contact')->nullable();
                $table->enum('gender', ['Male', 'Female', 'Other']);
                $table->string('facebook')->nullable();
                $table->string('instagram')->nullable();
                $table->string('twitter')->nullable();
                $table->string('profiles')->nullable();
                $table->longText('bio')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
            });
        }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
