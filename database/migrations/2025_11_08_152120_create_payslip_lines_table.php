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
        Schema::create('payslip_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payslip_id')->nullable()->constrained('payslips')->nullOnDelete();
            $table->foreignId('pay_element_id')->nullable()->constrained('pay_elements')->nullOnDelete();
            $table->string('label')->nullable();
            $table->decimal('amount', 10, 4)->default(0);
            $table->boolean('is_earning')->default(false);
            $table->boolean('taxable')->default(true);
            $table->decimal('quantity', 10, 4)->default(0);
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslip_lines');
    }
};
