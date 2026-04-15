<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->string('label');           // Display name e.g. "Full Stack Developer CV"
            $table->string('filename');        // Stored filename
            $table->string('original_name');   // Original uploaded file name
            $table->string('extension', 10);   // pdf, doc, docx
            $table->unsignedBigInteger('file_size')->default(0); // bytes
            $table->boolean('is_public')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
