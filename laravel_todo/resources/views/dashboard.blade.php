<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Welcome Message --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600">Here's an overview of your todos.</p>
                </div>
            </div>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                📋
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Total Todos</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                ⏳
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Active</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['active'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                ✅
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Completed</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['completed'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                🔥
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">High Priority</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['high_priority'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions & Recent Todos --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Quick Actions --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('todos.create') }}" 
                           class="flex items-center justify-center w-full px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create New Todo
                        </a>
                        <a href="{{ route('todos.index') }}" 
                           class="flex items-center justify-center w-full px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            View All Todos
                        </a>
                    </div>
                </div>

                {{-- Recent Todos --}}
                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Todos</h3>
                        <a href="{{ route('todos.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">View All →</a>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse($recentTodos as $todo)
                            <div class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        @if($todo->completed)
                                            <span class="text-green-500 text-xl">✓</span>
                                        @else
                                            <span class="text-gray-300 text-xl">○</span>
                                        @endif
                                        <div>
                                            <p class="font-medium {{ $todo->completed ? 'line-through text-gray-500' : 'text-gray-900' }}">
                                                {{ $todo->title }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $todo->created_at->diffForHumans() }} 
                                                @if($todo->due_date)
                                                    • Due {{ $todo->due_date->format('M d') }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full
                                        {{ $todo->priority == 'high' ? 'bg-red-100 text-red-700' : '' }}
                                        {{ $todo->priority == 'medium' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $todo->priority == 'low' ? 'bg-green-100 text-green-700' : '' }}">
                                        {{ ucfirst($todo->priority) }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center text-gray-500">
                                <p>No todos yet. <a href="{{ route('todos.create') }}" class="text-indigo-600 hover:underline">Create your first one!</a></p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>