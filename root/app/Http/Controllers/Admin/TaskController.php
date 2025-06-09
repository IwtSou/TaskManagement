<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTaskRequest;
use App\Http\Requests\Admin\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     *  全ユーザータスク表示
     */
    public function index()
    {
        $users = User::select('id', 'name')
            ->with(['tasks' => function($task) {
                $task->select('id', 'user_id', 'description', 'title', 'priority', 'status', 'due_date');
            }])->get();

        return Inertia::render('Admin/Tasks/Index', [
            'users' => $users,
        ]);
    }

    /**
     * タスク作成画面
     */
    public function create()
    {
        return Inertia::render('Admin/Tasks/Create');
    }

    /**
     * タスク作成処理
     */
    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());

        return to_route('admin.tasks.index')->with('success', 'タスクを作成しました。');
    }

    /**
     * タスク作成処理.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return to_route('admin.tasks.index')->with('success', 'タスクを更新しました。');
    }

    /**
     * タスク削除処理
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return to_route('admin.tasks.index')->with('success', 'タスクを削除しました。');
    }
}
