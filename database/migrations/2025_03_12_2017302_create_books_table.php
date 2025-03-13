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
            $table->id('id');
            $table->string('title');
            $table->foreignId('author_id')->constrained('authors')->onDelete('cascade');
            $table->foreignId('editorial_id')->constrained('editorials')->onDelete('cascade');
            $table->date('publication_date');
            $table->string('ISBN')->unique();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->boolean('availability')->default(true);
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
