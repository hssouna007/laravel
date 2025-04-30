<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('focus_area_shares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('focus_area_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('permission', ['view', 'edit'])->default('view');
            $table->timestamps();

            $table->unique(['focus_area_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('focus_area_shares');
    }
}; 