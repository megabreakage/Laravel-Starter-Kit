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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->uuid('identifier');
            $table->string('name');
            $table->foreignId('contact_type_id')->references('id')->on('contact_types')->restrictOnDelete();
            $table->string('value')->unique();
            $table->foreignId('added_by')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->boolean('active')->default(true);
            $table->foreignId('activated_by')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->timestamp('activated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
