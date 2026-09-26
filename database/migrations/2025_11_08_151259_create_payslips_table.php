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
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_run_id')->nullable()->constrained('payroll_runs')->nullOnDelete();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('employment_id')->nullable();
            $table->decimal('gross_pay', 10, 4)->default(0);
            $table->decimal('total_deductions', 10, 4)->default(0);
            $table->decimal('net_pay', 10, 4)->default(0);
            $table->char('currency_code')->default('BDT');
            $table->tinyInteger('status')->default(1)->comment('1=calculated, 2=approved, 3=paid, 4=adjusted');
            $table->date('issued_at')->nullable();
            $table->timestamps();

            $table->unique(['payroll_run_id', 'employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};
