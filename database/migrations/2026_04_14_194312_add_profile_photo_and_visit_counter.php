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
        // Add profile photo to settings
        Schema::table('settings', function (Blueprint $table) {
            // Profile photo will be stored as a setting
        });

        // Create visits table for tracking website visits
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->string('page')->default('/');
            $table->timestamp('visited_at');
            $table->timestamps();
            
            $table->index(['ip_address', 'visited_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
