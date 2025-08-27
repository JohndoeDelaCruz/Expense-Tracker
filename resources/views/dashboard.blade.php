@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-black/40 backdrop-blur-md border border-gray-700 overflow-hidden shadow-2xl sm:rounded-lg">
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-white">Dashboard</h1>
                    <div class="text-sm text-gray-300">
                        {{ now()->format('F j, Y') }}
                    </div>
                </div>

                <!-- Welcome Message -->
                <div class="bg-white/10 backdrop-blur-sm border border-gray-600 rounded-lg p-6 mb-6">
                    <h2 class="text-lg font-semibold text-white mb-2">
                        Welcome back, {{ $user->name }}!
                    </h2>
                    <p class="text-gray-300">
                        Ready to track your expenses? Start managing your finances efficiently with our expense tracker.
                    </p>
                </div>

                <!-- Quick Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white/10 backdrop-blur-md border border-gray-600 rounded-lg p-6 hover:bg-white/20 transition-all duration-300 hover:-translate-y-1 shadow-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-300 text-sm font-medium">Total Income</p>
                                <p class="text-2xl font-bold text-white">₱{{ number_format($totalIncome, 2) }}</p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-full p-3">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md border border-gray-600 rounded-lg p-6 hover:bg-white/20 transition-all duration-300 hover:-translate-y-1 shadow-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-300 text-sm font-medium">Total Expenses</p>
                                <p class="text-2xl font-bold text-white">₱{{ number_format($totalExpenses, 2) }}</p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-full p-3">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md border border-gray-600 rounded-lg p-6 hover:bg-white/20 transition-all duration-300 hover:-translate-y-1 shadow-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-300 text-sm font-medium">Net Balance</p>
                                <p class="text-2xl font-bold {{ $netBalance >= 0 ? 'text-green-400' : 'text-red-400' }}">₱{{ number_format($netBalance, 2) }}</p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-full p-3">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white/10 backdrop-blur-md border border-gray-600 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-white mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('transactions.income.create') }}" class="bg-white hover:bg-gray-100 text-black px-4 py-3 rounded-lg font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Add Income</span>
                        </a>
                        <a href="{{ route('transactions.expense.create') }}" class="bg-transparent hover:bg-white/10 text-white border-2 border-white/30 hover:border-white px-4 py-3 rounded-lg font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-xl hover:shadow-2xl hover:-translate-y-1 backdrop-blur-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Add Expense</span>
                        </a>
                        <a href="{{ route('reports.index') }}" class="bg-white/20 hover:bg-white/30 text-white border border-gray-500 px-4 py-3 rounded-lg font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-xl hover:shadow-2xl hover:-translate-y-1 backdrop-blur-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a2 2 0 002 2h2a2 2 0 002-2V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                            </svg>
                            <span>View Reports</span>
                        </a>
                        <a href="{{ route('categories.index') }}" class="bg-gray-800 hover:bg-gray-700 text-white border border-gray-600 px-4 py-3 rounded-lg font-medium transition-all duration-300 flex items-center justify-center space-x-2 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Categories</span>
                        </a>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="bg-white/10 backdrop-blur-md border border-gray-600 rounded-lg shadow-xl">
                    <div class="px-6 py-4 border-b border-gray-600">
                        <h3 class="text-lg font-semibold text-white">Recent Transactions</h3>
                    </div>
                    <div class="p-6">
                        @if($recentTransactions->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentTransactions as $transaction)
                                    <div class="flex items-center justify-between p-4 bg-white/5 rounded-lg border border-gray-600">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-lg" 
                                                 style="background-color: {{ $transaction->category->color }}20; border: 1px solid {{ $transaction->category->color }}">
                                                {{ $transaction->category->icon }}
                                            </div>
                                            <div>
                                                <p class="text-white font-medium">{{ $transaction->category->name }}</p>
                                                @if($transaction->description)
                                                    <p class="text-gray-400 text-sm">{{ $transaction->description }}</p>
                                                @endif
                                                <p class="text-gray-500 text-xs">{{ $transaction->date->format('M j, Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold {{ $transaction->type === 'income' ? 'text-green-400' : 'text-red-400' }}">
                                                {{ $transaction->type === 'income' ? '+' : '-' }}₱{{ number_format($transaction->amount, 2) }}
                                            </p>
                                            <p class="text-gray-400 text-xs uppercase">{{ $transaction->type }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-white">No transactions yet</h3>
                                <p class="mt-1 text-sm text-gray-300">Get started by adding your first transaction.</p>
                                <div class="mt-6 flex justify-center space-x-4">
                                    <a href="{{ route('transactions.income.create') }}" class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                                        Add Income
                                    </a>
                                    <a href="{{ route('transactions.expense.create') }}" class="bg-transparent hover:bg-white/10 text-white border-2 border-white/30 hover:border-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 backdrop-blur-sm">
                                        Add Expense
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
