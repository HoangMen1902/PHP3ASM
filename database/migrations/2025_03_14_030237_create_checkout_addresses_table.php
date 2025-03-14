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
        Schema::create('checkout_addresses', function (Blueprint $table) {
            $table->id();
            $table->text('address');
            $table->string('username_address', 125);
            $table->string('province_name', 255);
            $table->string('district_name', 255);
            $table->string('ward_name', 255);
            $table->string('phone', 10);
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('ward_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_addresses');
    }
};
