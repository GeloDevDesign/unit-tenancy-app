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
            $table->foreignId('occupant_id')->cascadeOnDelete()->nullable();
            $table->string('unit_number', 255)->unique();
            $table->unsignedInteger('floor');
            $table->integer('capacity_count');
            $table->decimal('sqm_size', 8, 2)->unsigned()->nullable()->comment('Size in square meters');
            $table->enum('occupant_type', ['tenant', 'owner', 'no occupant'])->default('no occupant');
            $table->enum('status', ['available', 'occupied'])->default('available');
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
