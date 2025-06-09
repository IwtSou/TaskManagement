<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'description' => 'nullable|string|max:1000',
            'status' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タスク名',
            'priority' => '優先度',
            'due_date' => 'タスク期限',
            'description' => 'タスク説明',
            'status' => 'タスク状態',
        ];
    }
}
