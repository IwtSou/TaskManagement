<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $appends = ['priority_jp', 'status_jp', 'due_date_formatted'];

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function getPriorityJpAttribute()
    {
        return match ($this->priority) {
            'low' => '低',
            'medium' => '中',
            'high' => '高',
        };
    }

    public function getStatusJpAttribute()
    {
        return match ($this->status) {
            'pending' => '未対応',
            'in_progress' => '進行中',
            'done' => '完了',
        };
    }

    public function getDueDateFormattedAttribute()
    {
        if ($this->due_date) {
            return Carbon::parse($this->due_date)->format('Y/m/d');
        } else {
            return $this->due_date;
        }

    }
}
