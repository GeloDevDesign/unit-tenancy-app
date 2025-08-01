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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->foreignId('inspected_by')->constrained('users')->onDelete('cascade');
            $table->enum('inspection_type', ['move_in', 'move_out', 'routine', 'complaint']);


            $table->string('report_title', 255);
            $table->boolean('damage_found')->default(false);
            $table->text('notes')->nullable();
            $table->dateTime('report_date_time');
            $table->enum('review_status', ['pending', 'reviewed', 'resolved'])->default('pending');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('inspection_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uploaded_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_images');
        Schema::dropIfExists('inspections');
    }
};
