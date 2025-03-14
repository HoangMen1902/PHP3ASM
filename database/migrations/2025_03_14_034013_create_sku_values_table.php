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
        Schema::create('sku_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sku_id');
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('value_id');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('sku_id')->references('id')->on('product_skus')->onDelete('cascade');
            $table->foreign('value_id')->references('id')->on('option_values')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sku_values');
    }
};
