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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreignId('leave_type_id')->nullable()->constrained('leave_types')->nullOnDelete();
            $table->foreignId('fiscal_year_id')->nullable()->constrained('fiscal_years')->nullOnDelete();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('days', 5, 2)->default(0);
            $table->decimal('hours', 5, 2)->nullable();
            $table->text('reason')->nullable();
            $table->string('address')->nullable();
            $table->timestamp('applied_at')->nullable();
            $table->unsignedBigInteger('applied_to')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->text('responsible_person_note')->nullable();
            $table->unsignedBigInteger('responsible_admin_id')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=pending, 1=approved, 2=rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
