<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the user's todos.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->todos();

        // Filter by status
        if ($request->has('status')) {
            match($request->status) {
                'completed' => $query->completed(),
                'active' => $query->active(),
                default => null,
            };
        }

        // Filter by priority
        if ($request->has('priority') && in_array($request->priority, ['low', 'medium', 'high'])) {
            $query->priority($request->priority);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $todos = $query->orderByRaw('ISNULL(due_date), due_date ASC')
                      ->latest()
                      ->paginate(10)
                      ->withQueryString();

        $stats = [
            'total' => Auth::user()->todos()->count(),
            'completed' => Auth::user()->todos()->completed()->count(),
            'active' => Auth::user()->todos()->active()->count(),
            'high_priority' => Auth::user()->todos()->priority('high')->active()->count(),
        ];

        return view('todos.index', compact('todos', 'stats'));
    }

    /**
     * Show the form for creating a new todo.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created todo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date|after_or_equal:today',
            'completed' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->boolean('completed')) {
            $validated['completed_at'] = now();
        }

        Todo::create($validated);

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo created successfully! 🎉');
    }

    /**
     * Show the form for editing the specified todo.
     */
    public function edit(Todo $todo)
    {
        // Authorization check
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified todo.
     */
    public function update(Request $request, Todo $todo)
    {
        // Authorization check
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'completed' => 'boolean',
        ]);

        // Handle completed_at timestamp
        $wasCompleted = $todo->completed;
        $nowCompleted = $request->boolean('completed');

        if (!$wasCompleted && $nowCompleted) {
            $validated['completed_at'] = now();
        } elseif ($wasCompleted && !$nowCompleted) {
            $validated['completed_at'] = null;
        }

        $todo->update($validated);

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo updated successfully! ✏️');
    }

    /**
     * Remove the specified todo.
     */
    public function destroy(Todo $todo)
    {
        // Authorization check
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $todo->delete();

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo deleted successfully! 🗑️');
    }

    /**
     * Toggle the completed status of the todo.
     */
    public function toggle(Todo $todo)
    {
        // Authorization check
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($todo->completed) {
            $todo->markAsIncomplete();
            $message = 'Todo marked as active!';
        } else {
            $todo->markAsCompleted();
            $message = 'Todo completed! Great job! 🎉';
        }

        return redirect()
            ->route('todos.index')
            ->with('success', $message);
    }
}