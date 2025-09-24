<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->id());

        if ($request->filled('status')) {
            if ($request->status === 'pending') {
                $query->where('completed', false);
            } elseif ($request->status === 'completed') {
                $query->where('completed', true);
            }
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('date_filter')) {
            switch ($request->date_filter) {
                case 'overdue':
                    $query->where('due_date', '<', now()->toDateString())
                        ->where('completed', false);
                    break;

                case 'today':
                    $query->whereDate('due_date', now()->toDateString());
                    break;

                case 'week':
                    $query->whereBetween('due_date', [
                        now()->startOfWeek()->toDateString(),
                        now()->endOfWeek()->toDateString()
                    ]);
                    break;

                case 'no_date':
                    $query->whereNull('due_date');
                    break;
            }
        }

        $tasks = $query->orderBy('due_date', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->query());

        return view('tasks/index', ['tasks' => $tasks]);
    }

    public function show(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        return response()->json([
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'due_date' => $task->due_date ? $task->due_date->format('d/m/Y') : null,
            'priority' => $task->priority,
            'priority_label' => ucfirst($task->priority),
            'completed' => $task->completed,
            'completed_text' => $task->completed ? 'Concluída' : 'Pendente',
            'created_at' => $task->created_at->format('d/m/Y H:i'),
            'updated_at' => $task->updated_at->format('d/m/Y H:i'),
        ]);
    }

    public function create()
    {
        return view('tasks/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50|min:3',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'completed' => false,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada');
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks/edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:50|min:3',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->update($request->only(['title', 'description', 'due_date', 'priority']));

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarefa eliminada');
    }

    public function toggle(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->update(['completed' => !$task->completed]);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'completed' => $task->completed
            ]);
        }

        return redirect()->route('tasks.index');
    }
}
