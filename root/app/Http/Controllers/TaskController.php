<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     *  ユーザー１人のタスク表示
     */
    public function myTask()
    {
        return Inertia::render('User/Tasks/MyTask', [
            'user' => User::select('id', 'name')->where('id', Auth::id())->with('tasks')->get(),
        ]);
    }

    /**
     *  全ユーザータスク表示
     */
    public function index()
    {
        $users = User::select('id', 'name')
            ->with(['tasks' => function($task) {
                $task->select('id', 'user_id', 'description', 'title', 'priority', 'status', 'due_date');
            }])->get();

        return Inertia::render('User/Tasks/Index', [
            'users' => $users,
            'authUserId' => Auth::id(),
        ]);
    }

    /**
     * タスク作成画面
     */
    public function create()
    {
        return Inertia::render('User/Tasks/Create');
    }

    /**
     * タスク作成処理
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $request->validated();
        $task['user_id'] = Auth::id();

        Task::create($task);

        return to_route('user.mytask')->with('success', 'タスクを作成しました。');
    }

    /**
     * タスク更新処理.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return to_route('user.mytask')->with('success', 'タスクを更新しました。');
    }

    /**
     * タスク削除処理
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return to_route('user.mytask')->with('success', 'タスクを削除しました。');
    }
}
