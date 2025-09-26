<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class DashboardController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->latest()
            ->take(3)
            ->get();

        $totalTasks = Task::totalTasks();
        $finishedTasks = Task::finishedTasks();
        $unfinishedTasks = Task::unfinishedTasks();
        $overdueTasks = Task::overdueTasks();

        return view('dashboard', [
            'tasks' => $tasks,
            'totalTasks' => $totalTasks,
            'finishedTasks' => $finishedTasks,
            'unfinishedTasks' => $unfinishedTasks,
            'overdueTasks' => $overdueTasks,
        ]);
    }
}
