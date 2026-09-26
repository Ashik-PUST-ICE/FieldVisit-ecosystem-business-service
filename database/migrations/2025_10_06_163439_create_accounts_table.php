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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operational_branch_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('title');
            $table->string('account_holder_name');
            $table->string('account_no')->unique();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('routing_no')->nullable();
            $table->decimal('opening_balance', 15, 2)->default(0.00);
            $table->foreignId('account_type_id')->constrained('account_types')->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
