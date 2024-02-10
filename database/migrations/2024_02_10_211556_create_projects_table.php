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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            // user_id column and set it as a foreign key referencing the id column of the users table.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // category_id column and set it as a foreign key referencing the id column of the categories table.
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            // title, description, link
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
