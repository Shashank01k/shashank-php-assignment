<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function down(): void
    {
        Schema::table('users_tasks', function (Blueprint $table) {
            //
            Schema::dropIfExists('users_tasks');
            Schema::dropIfExists('title');
            Schema::dropIfExists('description');
            Schema::dropIfExists('is_deleted');
            Schema::dropIfExists('user_id');
            Schema::dropIfExists('due_date');
        });
    }
    public function up(): void
    {
        Schema::table('users_tasks', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->after('id');
            $table->unsignedBigInteger('task_id')->after('user_id');
            $table->string('title')->nullable()->after('user_id');
            $table->string('description')->nullable()->after('user_id');
            $table->timestamp('due_date')->nullable()->after('user_id');
            $table->enum('status',[0,1,2])->default(0)->comment('0: Pending, 1: In-Progress, 2: Completed')->after('user_id');// 0: pending, 1: in_progress, 2: completed
            $table->boolean('is_deleted')->default(false)->after('updated_at');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('users_tasks_masters')->onDelete('cascade');
        });
        Schema::table('users_tasks', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
};
