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
        Schema::create('history_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_manager_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('occupant_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->date('move_in')->nullable();
            $table->date('move_out')->nullable();
            $table->enum('status', ['move_in', 'move_out']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_units');
    }
};
