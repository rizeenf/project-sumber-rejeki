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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('status')->default(1)->after('position_id');
            $table->integer('created_by')->nullable()->after('status');
            $table->integer('updated_by')->nullable()->after('created_by');
            $table->integer('deleted_by')->nullable()->after('updated_by');
            $table->SoftDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if(Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
                $table->dropColumn('created_by');
                $table->dropColumn('updated_by');
                $table->dropColumn('deleted_by');
                $table->dropColumn('deleted_at');
            }
        });
    }
};
