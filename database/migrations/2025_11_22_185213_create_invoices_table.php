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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('invoice_date');
            $table->string('invoice_type');
            $table->unsignedBigInteger('network_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->date('recurring_date')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->decimal('subtotal', 10, 4);
            $table->string('discount_type')->nullable();
            $table->decimal('discount_value', 10, 4)->default(0);
            $table->decimal('discount_amount', 10, 4)->default(0);
            $table->decimal('additional_amount', 10, 4)->default(0);
            $table->boolean('is_enabled_vat')->default(false);
            $table->decimal('vat_percentage', 10, 4)->default(0);
            $table->decimal('vat_amount', 10, 4)->default(0);
            $table->decimal('total_amount', 10, 4);
            $table->text('note')->nullable();
            $table->text('terms_condition')->nullable();
            $table->text('bank_details')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=Unpaid, 1=Paid, 2=Partially Paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
