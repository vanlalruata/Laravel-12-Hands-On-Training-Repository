@extends('layouts.app')
@section('title', 'Tailwind CSS Demo')

@section('content')
    <div class="space-y-8">
        
        {{-- Typography --}}
        <section class="card p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Typography</h2>
            <h1 class="text-4xl font-extrabold text-gray-900">Heading 1</h1>
            <h2 class="text-3xl font-bold text-gray-800 mt-2">Heading 2</h2>
            <h3 class="text-2xl font-semibold text-gray-700 mt-2">Heading 3</h3>
            <p class="text-base text-gray-600 mt-4 leading-relaxed">
                Regular paragraph with <span class="text-primary-600 font-medium">highlighted text</span> 
                and <a href="#" class="text-primary-600 hover:underline">links</a>.
            </p>
        </section>

        {{-- Buttons --}}
        <section class="card p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Buttons</h2>
            <div class="flex flex-wrap gap-3">
                <button class="btn-primary">Primary Button</button>
                <button class="btn-secondary">Secondary Button</button>
                <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Success
                </button>
                <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Danger
                </button>
                <button class="px-4 py-2 border-2 border-primary-600 text-primary-600 rounded-lg hover:bg-primary-50 transition-colors">
                    Outline
                </button>
            </div>
        </section>

        {{-- Cards/Components --}}
        <section class="card p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Cards & Layout</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Card 1 --}}
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm">Total Todos</p>
                            <p class="text-3xl font-bold mt-1">24</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm">Completed</p>
                            <p class="text-3xl font-bold mt-1">18</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm">Pending</p>
                            <p class="text-3xl font-bold mt-1">6</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Forms --}}
        <section class="card p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Form Elements</h2>
            <div class="space-y-4 max-w-md">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Text Input</label>
                    <input type="text" class="input-field" placeholder="Enter text...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Select</label>
                    <select class="input-field">
                        <option>Option 1</option>
                        <option>Option 2</option>
                    </select>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" class="w-4 h-4 text-primary-600 rounded border-gray-300 focus:ring-primary-500">
                    <label class="ml-2 text-sm text-gray-700">Checkbox</label>
                </div>
                <div class="flex gap-2">
                    <button class="btn-primary flex-1">Submit</button>
                    <button class="btn-secondary flex-1">Cancel</button>
                </div>
            </div>
        </section>

        {{-- Alerts --}}
        <section class="card p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Alerts</h2>
            <div class="space-y-3">
                <div class="bg-green-50 border-l-4 border-green-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">Success! Your action was completed.</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">Error! Something went wrong.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection