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
        Schema::table('stocks', function (Blueprint $table) {
            $table->decimal('quantity', 5, 2)->default(0)->change();
            $table->foreignId('stock_category_id')->nullable()->after('id')->constrained('stock_categories')->nullOnDelete();
            $table->foreignId('stock_product_id')->nullable()->after('stock_category_id')->constrained('products')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeign(['stock_category_id']);
            $table->dropForeign(['stock_product_id']);
            $table->dropColumn(['stock_category_id', 'stock_product_id']);
            $table->integer('quantity')->change();
        });
    }
};
