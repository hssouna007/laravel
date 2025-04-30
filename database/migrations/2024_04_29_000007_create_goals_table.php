<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('category', ['running', 'english_b2', 'trading']);
            $table->text('description')->nullable();
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->integer('progress')->default(0);
            $table->date('deadline')->nullable();
            $table->enum('visibility', ['private', 'friends', 'public'])->default('private');
            $table->enum('status', ['not_started', 'in_progress', 'completed', 'paused'])->default('not_started');
            $table->string('current_level')->nullable();
            $table->string('target_level')->nullable();
            $table->date('start_date')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
}; 