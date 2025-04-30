<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('focus_areas', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('progress')->default(0);
            $table->enum('visibility', ['private', 'public', 'shared'])->default('private');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('is_template')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('focus_areas', function (Blueprint $table) {
            $table->dropColumn([
                'latitude',
                'longitude',
                'progress',
                'visibility',
                'start_date',
                'end_date',
                'is_template',
            ]);
        });
    }
}; 