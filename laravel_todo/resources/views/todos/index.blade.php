@extends('layouts.app')

@section('title', 'My Todos')

@section('content')
    <div class="px-4 sm:px-0">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif        

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</div>
                <div class="text-sm text-gray-500">Total Todos</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="text-2xl font-bold text-blue-600">{{ $stats['active'] }}</div>
                <div class="text-sm text-gray-500">Active</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="text-2xl font-bold text-green-600">{{ $stats['completed'] }}</div>
                <div class="text-sm text-gray-500">Completed</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="text-2xl font-bold text-red-600">{{ $stats['high_priority'] }}</div>
                <div class="text-sm text-gray-500">High Priority</div>
            </div>
        </div>

        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <h1 class="text-3xl font-bold text-gray-900">My Todo List</h1>
            <a href="{{ route('todos.create') }}" 
               class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Todo
            </a>
        </div>

        {{-- Filters & Search --}}
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <form action="{{ route('todos.index') }}" method="GET" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-50">
                    <input type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search todos..."
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <select name="status" class="border rounded-lg px-3 py-2">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <select name="priority" class="border rounded-lg px-3 py-2">
                    <option value="">All Priorities</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>🔴 High</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>🟢 Low</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Search
                </button>
                @if(request('search') || request('status') || request('priority'))
                    <a href="{{ route('todos.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        {{-- Todo List --}}
        @if($todos->count() > 0)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <ul class="divide-y divide-gray-200">
                    @foreach($todos as $todo)
                        <li class="p-4 hover:bg-gray-50 transition-colors {{ $todo->completed ? 'bg-gray-50' : '' }}">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-1">
                                        {{-- Status Toggle Form --}}
                                        <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-xl hover:scale-110 transition-transform">
                                                @if($todo->completed)
                                                    <span class="text-green-500" title="Mark as incomplete">✓</span>
                                                @else
                                                    <span class="text-gray-300 hover:text-indigo-500" title="Mark as complete">○</span>
                                                @endif
                                            </button>
                                        </form>
                                        
                                        <span class="{{ $todo->completed ? 'line-through text-gray-500' : 'text-gray-900' }} font-medium">
                                            {{ $todo->title }}
                                        </span>
                                        
                                        {{-- Priority Badge --}}
                                        <span class="px-2 py-0.5 text-xs rounded-full 
                                            {{ $todo->priority == 'high' ? 'bg-red-100 text-red-700' : '' }}
                                            {{ $todo->priority == 'medium' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                            {{ $todo->priority == 'low' ? 'bg-green-100 text-green-700' : '' }}">
                                            {{ ucfirst($todo->priority) }}
                                        </span>
                                    </div>
                                    
                                    @if($todo->description)
                                        <p class="text-sm text-gray-600 ml-8 {{ $todo->completed ? 'line-through' : '' }}">
                                            {{ Str::limit($todo->description, 100) }}
                                        </p>
                                    @endif
                                    
                                    <div class="flex items-center gap-4 ml-8 mt-2 text-xs text-gray-500">
                                        @if($todo->due_date)
                                            <span class="flex items-center gap-1 {{ $todo->due_date->isPast() && !$todo->completed ? 'text-red-500 font-medium' : '' }}">
                                                📅 Due {{ $todo->due_date->format('M d, Y') }}
                                                @if($todo->due_date->isToday())
                                                    <span class="text-orange-500">(Today)</span>
                                                @endif
                                            </span>
                                        @endif
                                        @if($todo->completed_at)
                                            <span>✓ Completed {{ $todo->completed_at->diffForHumans() }}</span>
                                        @else
                                            <span>Created {{ $todo->created_at->diffForHumans() }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('todos.edit', $todo) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 text-sm font-medium px-3 py-1 rounded hover:bg-indigo-50">
                                        Edit
                                    </a>
                                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium px-3 py-1 rounded hover:bg-red-50">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $todos->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <div class="text-6xl mb-4">📝</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No todos found</h3>
                <p class="text-gray-500 mb-4">{{ request('status') || request('priority') ? 'Try adjusting your filters.' : 'Get started by creating your first todo!' }}</p>
                @if(!request('status') && !request('priority'))
                    <a href="{{ route('todos.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create First Todo
                    </a>
                @endif
            </div>
        @endif
    </div>
@endsection