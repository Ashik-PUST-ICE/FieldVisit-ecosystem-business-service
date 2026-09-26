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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requisition_id')->nullable()->constrained('requisitions')->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->string('warranty')->nullable();
            $table->decimal('quantity', 10, 4)->default(0);
            $table->decimal('unit_price', 10, 4)->default(0);
            $table->decimal('total_price', 10, 4)->default(0);
            $table->string('discount_type', 255)->nullable();
            $table->decimal('discount_value', 10, 4)->default(0);
            $table->decimal('discount_amount', 10, 4)->default(0);
            $table->decimal('tax_amount', 10, 4)->default(0);
            $table->decimal('additional_charge', 10, 4)->default(0);
            $table->string('additional_charge_type', 255)->nullable();
            $table->decimal('total_amount', 10, 4)->default(0);
            $table->decimal('paid_amount', 10, 4)->default(0);
            $table->decimal('due_amount', 10, 4)->default(0);
            $table->date('purchase_date')->nullable();
            $table->unsignedBigInteger('purchase_by')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('invoice_document')->nullable();
            $table->string('product_code')->nullable();
            $table->text('note')->nullable();
            $table->text('terms')->nullable();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete();
            $table->timestamps();

            $table->index('requisition_id');
            $table->index('product_id');
            $table->index('vendor_id');
            $table->index('brand_id');
            $table->index('unit_id');
            $table->index('purchase_by');
            $table->index('account_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
