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
        return Task::all()->count();
    }

    public static function finishedTasks()
    {
        return Task::where('completed', true)->get()->count();
    }

    public static function unfinishedTasks()
    {
        return Task::where('completed', false)->get()->count();
    }

    public static function overdueTasks()
    {
        return Task::where('due_date', '<', now()->toDateString())->get()->count();
    }
}
