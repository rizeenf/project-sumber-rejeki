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
        Schema::create('header_visits', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('serial')->nullable();
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->text('LA')->nullable();
            $table->text('LO')->nullable();
            $table->boolean('banner')->default(0);
            $table->enum('status_registration', ['Y', 'M', 'N'])->default('N');
            $table->string('activity')->nullable();
            $table->text('note')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_visits');
    }
};
