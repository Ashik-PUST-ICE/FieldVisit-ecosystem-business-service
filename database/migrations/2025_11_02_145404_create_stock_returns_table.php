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
        Schema::create('stock_returns', function (Blueprint $table) {

            $table->id();
            $table->foreignId('stock_category_id')->nullable()->constrained('stock_categories')->nullOnDelete();
            $table->foreignId('stock_product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->foreignId('return_product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->string('s_mtr')->nullable();
            $table->string('e_mtr')->nullable();
            $table->decimal('quantity', 5, 2)->default(1);
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->string('product_code')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('mac_address')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('returnable_type')->nullable();
            $table->unsignedBigInteger('returnable_id')->nullable();
            $table->string('return_type')->nullable();
            $table->text('reason')->nullable();
            $table->date('return_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_returns');
    }
};
