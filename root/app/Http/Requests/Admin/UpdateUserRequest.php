<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // 対象ユーザーIDを取得（ルートのバインディングに依存）
        $userId = $this->input('id');

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,' . $userId,
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ];
    }

    public function attributes()
    {
        return [
            'name' => '担当者名',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}
