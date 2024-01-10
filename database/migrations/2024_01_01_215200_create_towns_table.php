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
        Schema::create('towns', function (Blueprint $table) {
            $table->id();
            $table->uuid('identifier');
            $table->string('name', 50);
            $table->foreignId('county_id')->references('id')->on('counties')->restrictOnDelete();
            $table->string('shortcode', 4);
            $table->boolean('active')->default(false);
            $table->foreignId('added_by')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('activated_by')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->timestamp('activated_at')->nullable();
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('towns');
    }
};
