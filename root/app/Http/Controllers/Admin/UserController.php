<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisteredUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     *  全担当者表示
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email')
                    ->withCount([
                        'tasks', // 全タスク数
                        'tasks as pending_tasks_count' => function ($query) {
                            $query->where('status', 'pending');
                        },
                        'tasks as in_progress_tasks_count' => function ($query) {
                            $query->where('status', 'in_progress');
                        },
                        'tasks as done_tasks_count' => function ($query) {
                            $query->where('status', 'done');
                        },
                    ])->get();

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
        ]);
    }

    /**
     * 担当者新規作成画面
     */
    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    /**
     * 担当者新規作成処理
     */
    public function store(RegisteredUserRequest $request)
    {
        $user = $request->validated();

        User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
        ]);

        return to_route('admin.users.index')->with('success', '新規登録完了');
    }

    /**
     * タスク作成処理.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user_validated = $request->validated();
        
        $user->update([
            'name' => $user_validated['name'],
            'email' => $user_validated['email'],
            'password' => Hash::make($user_validated['password']),
        ]);

        return to_route('admin.users.index')->with('success', 'タスクを更新しました。');
    }

    /**
     * タスク削除処理
     */
    public function destroy(User $user)
    {
        $user->delete();

        return to_route('admin.users.index')->with('success', 'タスクを削除しました。');
    }

}
