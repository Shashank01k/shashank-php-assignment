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
        Schema::create('users_tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->string('task_name');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->enum('status',[0,1,2])->default(0)->comment('0: Pending, 1: In-Progress, 2: Completed')->after('updated_at');// 0: pending, 1: in_progress, 2: completed
            $table->boolean('is_deleted')->default(false)->after('updated_at');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('users_tasks', function (Blueprint $table) {
            $table->softDeletes()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_tasks');
    }
};
