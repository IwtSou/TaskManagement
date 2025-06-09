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
            $table->id()
                ->comment('主キー');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('tasksの作成者 users.id への外部キー');
            $table->string('title')
                ->comment('タスクのタイトル');
            $table->text('description')
                ->nullable()
                ->comment('タスクの詳細説明');
            $table->enum('status', ['pending', 'in_progress', 'done'])
                ->default('pending')
                ->comment('タスクの状態 (pending:未対応, in_progress:進行中, done:完了)');
            // 優先度：low:低・medium:中・high高
            $table->enum('priority', ['low', 'medium', 'high'])
                ->default('medium')
                ->comment('タスクの優先度 (low:低, medium:中, high:高)');
            $table->date('due_date')
                ->nullable()
                ->comment('タスクの締切日');
            $table->timestamps();
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
