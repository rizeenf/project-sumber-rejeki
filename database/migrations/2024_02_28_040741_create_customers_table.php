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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->text('photo')->nullable();
            $table->text('address')->nullable();
            $table->text('LA')->nullable();
            $table->text('LO')->nullable();
            $table->string('area')->nullable();
            $table->string('subarea')->nullable();
            $table->enum('status_registration', ['Y', 'M', 'N'])->default('N');
            $table->enum('type',['S', 'O'])->default('S');
            $table->boolean('banner')->default(0);
            $table->integer('branch_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
