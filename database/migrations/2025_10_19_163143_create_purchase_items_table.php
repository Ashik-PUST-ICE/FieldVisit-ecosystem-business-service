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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->nullable();
            $table->string('mac_address')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('cascade')->index();
            $table->foreignId('purchase_id')->nullable()->constrained('purchases')->onDelete('cascade');
            $table->string('warranty')->nullable();
            $table->date('purchased_date')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 = available, 2 = used, 3 = damaged, 4 = lost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
