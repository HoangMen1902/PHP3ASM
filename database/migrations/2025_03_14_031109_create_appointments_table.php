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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name',255);
            $table->string('customer_phone', 10);
            $table->date('date');
            $table->time('time');
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('chair_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('chair_id')->references('id')->on('chairs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
