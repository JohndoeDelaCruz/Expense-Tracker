@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-black/40 backdrop-blur-md border border-gray-700 overflow-hidden shadow-2xl sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-white">Categories</h1>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('categories.create') }}" class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                            <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            Add Category
                        </a>
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white/10 backdrop-blur-md border border-gray-600 rounded-lg p-4">
                        <p class="text-gray-300 text-sm">Total Categories</p>
                        <p class="text-2xl font-bold text-white">{{ $totalCategories }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md border border-gray-600 rounded-lg p-4">
                        <p class="text-gray-300 text-sm">Categories Used</p>
                        <p class="text-2xl font-bold text-white">{{ $usedCategories }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md border border-gray-600 rounded-lg p-4">
                        <p class="text-gray-300 text-sm">Most Used</p>
                        <p class="text-lg font-bold text-white">
                            @if($mostUsedCategory)
                                {{ $mostUsedCategory->icon }} {{ $mostUsedCategory->name }}
                            @else
                                None
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Income Categories -->
            <div class="bg-black/40 backdrop-blur-md border border-gray-700 overflow-hidden shadow-2xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-white">Income Categories</h3>
                        <span class="text-green-400 text-sm">{{ $incomeCategories->count() }} categories</span>
                    </div>
                    <div class="space-y-3">
                        @forelse($incomeCategories as $category)
                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-lg border border-gray-600 hover:bg-white/10 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-lg" 
                                         style="background-color: {{ $category->color }}20; border: 1px solid {{ $category->color }}">
                                        {{ $category->icon }}
                                    </div>
                                    <div>
                                        <p class="text-white font-medium">{{ $category->name }}</p>
                                        <div class="flex items-center space-x-4 text-xs text-gray-400">
                                            <span>{{ $category->transactions_count }} transactions</span>
                                            @if($category->total_amount > 0)
                                                <span>₱{{ number_format($category->total_amount, 2) }}</span>
                                            @endif
                                            @if($category->last_used)
                                                <span>Last: {{ $category->last_used->format('M j') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('categories.edit', $category) }}" class="text-gray-400 hover:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    @if($category->transactions_count == 0)
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-400 transition-colors" onclick="return confirm('Are you sure?')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-gray-400">No income categories found</p>
                                <a href="{{ route('categories.create') }}" class="text-white hover:text-gray-300 text-sm mt-2 inline-block">Create your first income category</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Expense Categories -->
            <div class="bg-black/40 backdrop-blur-md border border-gray-700 overflow-hidden shadow-2xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-white">Expense Categories</h3>
                        <span class="text-red-400 text-sm">{{ $expenseCategories->count() }} categories</span>
                    </div>
                    <div class="space-y-3">
                        @forelse($expenseCategories as $category)
                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-lg border border-gray-600 hover:bg-white/10 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-lg" 
                                         style="background-color: {{ $category->color }}20; border: 1px solid {{ $category->color }}">
                                        {{ $category->icon }}
                                    </div>
                                    <div>
                                        <p class="text-white font-medium">{{ $category->name }}</p>
                                        <div class="flex items-center space-x-4 text-xs text-gray-400">
                                            <span>{{ $category->transactions_count }} transactions</span>
                                            @if($category->total_amount > 0)
                                                <span>₱{{ number_format($category->total_amount, 2) }}</span>
                                            @endif
                                            @if($category->last_used)
                                                <span>Last: {{ $category->last_used->format('M j') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('categories.edit', $category) }}" class="text-gray-400 hover:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    @if($category->transactions_count == 0)
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-400 transition-colors" onclick="return confirm('Are you sure?')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-gray-400">No expense categories found</p>
                                <a href="{{ route('categories.create') }}" class="text-white hover:text-gray-300 text-sm mt-2 inline-block">Create your first expense category</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
