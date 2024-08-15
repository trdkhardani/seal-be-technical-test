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
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('task_id')->primary();
            $table->uuid('user_id');
            $table->uuid('project_id');
            $table->string('task_title');
            $table->string('task_description');
            $table->dateTime('task_due_date');
            $table->enum('task_status', ['finished', 'in progress', 'assigned']);
            $table->string('task_note');
            $table->timestamps();

            // Define FK
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('project_id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
