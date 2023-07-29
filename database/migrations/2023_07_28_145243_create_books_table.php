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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('slug');
            $table->text('tags')->nullable();
            $table->string('image')->nullable();
            $table->enum('type', ['Popular', 'Latest', 'Upcomming', 'Normal','Top Item'])->default('Normal');
            $table->integer('stock')->default(0)->nullable();
            $table->text('short_details')->nullable();
            $table->text('long_details')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('view_count')->default(0);
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
