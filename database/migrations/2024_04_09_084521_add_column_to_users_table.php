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
        //add more columns according to the Assignment
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_deleted')->default(false)->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('title');
            $table->dropColumn('description');
            $table->dropColumn('due_date');
            $table->dropColumn('status');
            $table->dropColumn('is_deleted');
        });
    }
};
