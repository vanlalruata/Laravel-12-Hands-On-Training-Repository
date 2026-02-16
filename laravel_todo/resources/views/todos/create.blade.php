@extends('layouts.app')

@section('title', 'Create New Todo')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-0">
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-900">Create New Todo</h1>
                <p class="mt-1 text-sm text-gray-600">Add a new task to your list.</p>
            </div>

            @if($errors->any())
                <div class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('todos.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2"
                           placeholder="Enter todo title"
                           required>
                </div>                

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        Description
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2"
                              placeholder="Add more details (optional)">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700">
                            Priority
                        </label>
                        <select name="priority" 
                                id="priority"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>🟢 Low</option>
                            <option value="medium" {{ old('priority') == 'medium' || !old('priority') ? 'selected' : '' }}>🟡 Medium</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>🔴 High</option>
                        </select>
                    </div>

                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700">
                            Due Date
                        </label>
                        <input type="date" 
                               name="due_date" 
                               id="due_date"
                               value="{{ old('due_date') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" 
                           name="completed" 
                           id="completed"
                           value="1"
                           {{ old('completed') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="completed" class="ml-2 block text-sm text-gray-900">
                        Mark as completed immediately
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t">
                    <a href="{{ route('todos.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Todo
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection