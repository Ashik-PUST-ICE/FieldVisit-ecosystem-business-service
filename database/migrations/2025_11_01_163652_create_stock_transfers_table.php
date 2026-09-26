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
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_category_id')->nullable()->constrained('stock_categories')->nullOnDelete();
            $table->foreignId('stock_product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->foreignId('transfer_product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->decimal('s_mtr', 10, 2)->nullable();
            $table->decimal('e_mtr', 10, 2)->nullable();
            $table->decimal('quantity', 5, 2)->default(0);
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->string('product_code')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('mac_address')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transfers');
    }
};
