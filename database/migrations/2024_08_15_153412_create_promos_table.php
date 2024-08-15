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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product1_id');
            $table->unsignedBigInteger('product2_id');
            $table->unsignedBigInteger('product3_id')->nullable();
            $table->unsignedBigInteger('product4_id')->nullable();
            $table->unsignedBigInteger('product5_id')->nullable();
            $table->string('type');
            $table->float('value');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
