@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-black/40 backdrop-blur-md border border-gray-700 overflow-hidden shadow-2xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-white">Create Category</h1>
                    <a href="{{ route('categories.index') }}" class="text-gray-300 hover:text-white transition-colors">
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

                <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Category Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                               class="w-full bg-white/10 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-white/50 focus:border-white backdrop-blur-sm"
                               placeholder="Enter category name">
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-300 mb-2">Type</label>
                        <select name="type" id="type" required class="w-full bg-white/10 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-white/50 focus:border-white backdrop-blur-sm">
                            <option value="" class="bg-gray-800 text-gray-300">Select type</option>
                            <option value="income" class="bg-gray-800 text-white" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
                            <option value="expense" class="bg-gray-800 text-white" {{ old('type') == 'expense' ? 'selected' : '' }}>Expense</option>
                        </select>
                    </div>

                    <!-- Icon -->
                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-300 mb-2">Icon (Emoji)</label>
                        <input type="text" name="icon" id="icon" value="{{ old('icon') }}" required maxlength="4"
                               class="w-full bg-white/10 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-white/50 focus:border-white backdrop-blur-sm"
                               placeholder="💰">
                        <p class="text-gray-400 text-xs mt-1">Choose an emoji to represent this category</p>
                    </div>

                    <!-- Color -->
                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-300 mb-2">Color</label>
                        <div class="flex items-center space-x-4">
                            <input type="color" name="color" id="color" value="{{ old('color', '#10B981') }}" required 
                                   class="w-16 h-12 bg-white/10 border border-gray-600 rounded-lg cursor-pointer">
                            <div class="flex-1">
                                <p class="text-gray-400 text-sm">Choose a color for this category</p>
                                <div class="flex space-x-2 mt-2">
                                    <button type="button" onclick="setColor('#10B981')" class="w-6 h-6 rounded-full border-2 border-white/30" style="background-color: #10B981"></button>
                                    <button type="button" onclick="setColor('#EF4444')" class="w-6 h-6 rounded-full border-2 border-white/30" style="background-color: #EF4444"></button>
                                    <button type="button" onclick="setColor('#F59E0B')" class="w-6 h-6 rounded-full border-2 border-white/30" style="background-color: #F59E0B"></button>
                                    <button type="button" onclick="setColor('#8B5CF6')" class="w-6 h-6 rounded-full border-2 border-white/30" style="background-color: #8B5CF6"></button>
                                    <button type="button" onclick="setColor('#EC4899')" class="w-6 h-6 rounded-full border-2 border-white/30" style="background-color: #EC4899"></button>
                                    <button type="button" onclick="setColor('#06B6D4')" class="w-6 h-6 rounded-full border-2 border-white/30" style="background-color: #06B6D4"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('categories.index') }}" class="bg-transparent hover:bg-white/10 text-white border-2 border-white/30 hover:border-white px-6 py-3 rounded-lg font-medium transition-all duration-300 backdrop-blur-sm">
                            Cancel
                        </a>
                        <button type="submit" class="bg-white hover:bg-gray-100 text-black px-6 py-3 rounded-lg font-medium transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                            Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setColor(color) {
        document.getElementById('color').value = color;
    }
</script>
@endsection
