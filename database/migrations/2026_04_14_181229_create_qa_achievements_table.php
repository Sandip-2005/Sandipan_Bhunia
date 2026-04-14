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
        Schema::create('qa_achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('tool_used'); // Selenium, Postman, Manual, etc.
            $table->string('achievement_type'); // bug_found, automation_created, performance_improved
            $table->integer('bugs_found')->default(0);
            $table->string('project_name')->nullable();
            $table->date('achievement_date');
            $table->text('impact')->nullable();
            $table->string('evidence_link')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qa_achievements');
    }
};
