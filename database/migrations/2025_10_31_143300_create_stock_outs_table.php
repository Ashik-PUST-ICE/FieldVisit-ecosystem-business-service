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
        Schema::create('stock_outs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_category_id')->nullable()->constrained('stock_categories')->nullOnDelete();
            $table->foreignId('stock_product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->foreignId('stock_history_id')->nullable()->constrained('stock_histories')->nullOnDelete();
            $table->unsignedBigInteger('network_id')->nullable();
            $table->decimal('s_mtr', 10, 2)->nullable();
            $table->decimal('e_mtr', 10, 2)->nullable();
            $table->decimal('quantity', 10, 2)->default(0);
            $table->string('color')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->string('serial_no')->nullable();
            $table->string('mac_address')->nullable();
            $table->string('product_code')->nullable();
            $table->date('stock_out_date')->nullable();
            $table->string('assignable_type')->nullable();
            $table->unsignedBigInteger('assignable_id')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('is_returned')->default(false);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_outs');
    }
};
