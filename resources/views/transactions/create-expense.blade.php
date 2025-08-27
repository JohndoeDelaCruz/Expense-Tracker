@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-black/40 backdrop-blur-md border border-gray-700 overflow-hidden shadow-2xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-white">Add Expense</h1>
                    <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                </div>

                @if ($errors->any())
                    <div class="bg-red-500/20 border border-red-500 rounded-lg p-4 mb-6">
                        <ul class="text-red-300 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('transactions.expense.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                        <select name="category_id" id="category_id" required class="w-full bg-white/10 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-white/50 focus:border-white backdrop-blur-sm">
                            <option value="" class="bg-gray-800 text-gray-300">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" class="bg-gray-800 text-white" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->icon }} {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Amount</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-300">₱</span>
                            <input type="number" step="0.01" min="0.01" name="amount" id="amount" value="{{ old('amount') }}" required 
                                   class="w-full bg-white/10 border border-gray-600 rounded-lg pl-8 pr-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-white/50 focus:border-white backdrop-blur-sm"
                                   placeholder="0.00">
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description (Optional)</label>
                        <input type="text" name="description" id="description" value="{{ old('description') }}" 
                               class="w-full bg-white/10 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-white/50 focus:border-white backdrop-blur-sm"
                               placeholder="Add a note...">
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-300 mb-2">Date</label>
                        <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required 
                               class="w-full bg-white/10 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-white/50 focus:border-white backdrop-blur-sm">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('dashboard') }}" class="bg-transparent hover:bg-white/10 text-white border-2 border-white/30 hover:border-white px-6 py-3 rounded-lg font-medium transition-all duration-300 backdrop-blur-sm">
                            Cancel
                        </a>
                        <button type="submit" class="bg-white hover:bg-gray-100 text-black px-6 py-3 rounded-lg font-medium transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                            Add Expense
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
