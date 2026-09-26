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
        Schema::create('bandwidth_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete();
            $table->string('link')->nullable();
            $table->decimal('total_amount', 10, 4)->default(0);
            $table->string('discount_type')->nullable();
            $table->decimal('discount_value', 10, 4)->default(0);
            $table->decimal('discount_amount', 10, 4)->default(0);
            $table->decimal('additional_amount', 10, 4)->default(0);
            $table->decimal('paid_amount', 10, 4)->default(0);
            $table->decimal('due_amount', 10, 4)->default(0);
            $table->date('purchase_date');
            $table->string('invoice')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bandwidth_purchases');
    }
};
