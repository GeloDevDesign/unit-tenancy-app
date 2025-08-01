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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
            $table->foreignId('tenant_manager_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('occupant_id')->constrained('users')->cascadeOnDelete()->nullable();
            $table->string('unit_number', 100);
            $table->integer('floor');
            $table->integer('capacity_count');
            $table->enum('occupant_type', ['tenant', 'owner']);
            $table->enum('status', ['available', 'occupied']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
