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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->nullable(false)->unique();
            $table->string('description', 512)->nullable(true);
            $table->string('imgUrl', 512)->nullable(false)->unique();
            $table->float('price', 10, 2)->nullable(false);
            $table->float('discountPercent', 5, 2)->nullable(true);
            $table->dateTime('discountStart_at')->nullable(true);
            $table->dateTime('discountEnd_at')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
