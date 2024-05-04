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
        Schema::create('detail_outlet_visits', function (Blueprint $table) {
            $table->id();
            $table->integer('header_visit_id')->nullable();
            $table->double('sales_amount')->nullable(); //Qty penjualan perhari
            $table->integer('customer_id')->nullable(); //Nama Toko apabila sudah register
            $table->string('store_name')->nullable(); //Nama Toko
            $table->string('market_name')->nullable(); //Nama Pasar
            $table->string('mark')->nullable(); //Patokan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_outlet_visits');
    }
};
