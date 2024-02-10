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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            // project_id column and set it as a foreign key referencing the id column of the projects table.
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            // url column to store the url of the image (path).
            $table->string('url');
            // alt (caption) column to store the caption of the image.
            $table->string('alt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
