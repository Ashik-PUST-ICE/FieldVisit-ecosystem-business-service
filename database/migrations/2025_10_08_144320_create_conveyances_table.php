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
        Schema::create('conveyances', function (Blueprint $table) {
            $table->id();
            $table->string('purpose');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('voucher')->nullable();
            $table->foreignId('account_id')->nullable()->constrained('accounts')->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->date('biling_date');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreignId('finance_category_id')->nullable()->constrained('finance_categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conveyances');
    }
};
