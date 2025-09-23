<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'completed',
        'user_id',
    ];

    public $casts = [
        'completed' => 'boolean',
        'due_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function totalTasks()
    {
        return static::where('user_id', auth()->id())->count();
    }

    public static function finishedTasks()
    {
        return static::where('user_id', auth()->id())
            ->where('completed', true)
            ->count();
    }

    public static function unfinishedTasks()
    {
        return static::where('user_id', auth()->id())
            ->where('completed', false)
            ->count();
    }

    public static function overdueTasks()
    {
        return static::where('user_id', auth()->id())
            ->where('due_date', '<', now()->toDateString())
            ->where('completed', false)
            ->count();
    }
}
