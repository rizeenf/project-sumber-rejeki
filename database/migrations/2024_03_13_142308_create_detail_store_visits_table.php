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
        Schema::create('detail_store_visits', function (Blueprint $table) {
            $table->id();
            $table->integer('header_visit_id')->nullable();
            $table->integer('category_product_id')->nullable();
            $table->integer('display_product_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_store_visits');
    }
};
