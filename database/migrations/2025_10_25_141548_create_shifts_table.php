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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_schedule_id')->nullable()->constrained('work_schedules')->nullOnDelete();
            $table->string('title');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('break_minutes')->default(0)->nullable();
            $table->boolean('is_night_shift')->default(false);
            $table->string('color')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=active,0=inactive');
            $table->date('effective_at')->nullable();
            $table->boolean('flexible_time')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
