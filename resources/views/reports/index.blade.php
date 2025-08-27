@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-black/40 backdrop-blur-md border border-gray-700 overflow-hidden shadow-2xl sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-white">Financial Reports</h1>
                    <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                </div>

                <!-- Period Filter -->
                <div class="flex space-x-4 mb-6">
                    <a href="?period=week" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('period') == 'week' ? 'bg-white text-black' : 'bg-white/10 text-white hover:bg-white/20' }}">
                        This Week
                    </a>
                    <a href="?period=month" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('period', 'month') == 'month' ? 'bg-white text-black' : 'bg-white/10 text-white hover:bg-white/20' }}">
                        This Month
                    </a>
                    <a href="?period=year" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('period') == 'year' ? 'bg-white text-black' : 'bg-white/10 text-white hover:bg-white/20' }}">
                        This Year
                    </a>
                    <a href="?period=all" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('period') == 'all' ? 'bg-white text-black' : 'bg-white/10 text-white hover:bg-white/20' }}">
                        All Time
                    </a>
                </div>

                <!-- Summary Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white/10 backdrop-blur-md border border-gray-600 rounded-lg p-6">
                        <p class="text-gray-300 text-sm font-medium">Total Income</p>
                        <p class="text-2xl font-bold text-green-400">₱{{ number_format($totalIncome, 2) }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md border border-gray-600 rounded-lg p-6">
                        <p class="text-gray-300 text-sm font-medium">Total Expenses</p>
                        <p class="text-2xl font-bold text-red-400">₱{{ number_format($totalExpenses, 2) }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md border border-gray-600 rounded-lg p-6">
                        <p class="text-gray-300 text-sm font-medium">Net Balance</p>
                        <p class="text-2xl font-bold {{ $netBalance >= 0 ? 'text-green-400' : 'text-red-400' }}">₱{{ number_format($netBalance, 2) }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md border border-gray-600 rounded-lg p-6">
                        <p class="text-gray-300 text-sm font-medium">Transactions</p>
                        <p class="text-2xl font-bold text-white">{{ $transactionCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Monthly Trend Chart -->
            <div class="bg-black/40 backdrop-blur-md border border-gray-700 overflow-hidden shadow-2xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">6-Month Trend</h3>
                    <canvas id="monthlyTrendChart" width="400" height="200"></canvas>
                </div>
            </div>

            <!-- Expense Breakdown -->
            <div class="bg-black/40 backdrop-blur-md border border-gray-700 overflow-hidden shadow-2xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Expense Breakdown</h3>
                    <canvas id="expenseBreakdownChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Category Analysis -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Top Expense Categories -->
            <div class="bg-black/40 backdrop-blur-md border border-gray-700 overflow-hidden shadow-2xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Top Expense Categories</h3>
                    <div class="space-y-4">
                        @forelse($expensesByCategory->take(5) as $category)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm" 
                                         style="background-color: {{ $category->category->color }}20; border: 1px solid {{ $category->category->color }}">
                                        {{ $category->category->icon }}
                                    </div>
                                    <span class="text-white">{{ $category->category->name }}</span>
                                </div>
                                <span class="text-red-400 font-medium">₱{{ number_format($category->total, 2) }}</span>
                            </div>
                        @empty
                            <p class="text-gray-400 text-center py-4">No expense categories found</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Income Sources -->
            <div class="bg-black/40 backdrop-blur-md border border-gray-700 overflow-hidden shadow-2xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Income Sources</h3>
                    <div class="space-y-4">
                        @forelse($incomeByCategory as $category)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm" 
                                         style="background-color: {{ $category->category->color }}20; border: 1px solid {{ $category->category->color }}">
                                        {{ $category->category->icon }}
                                    </div>
                                    <span class="text-white">{{ $category->category->name }}</span>
                                </div>
                                <span class="text-green-400 font-medium">₱{{ number_format($category->total, 2) }}</span>
                            </div>
                        @empty
                            <p class="text-gray-400 text-center py-4">No income categories found</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-black/40 backdrop-blur-md border border-gray-700 overflow-hidden shadow-2xl sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Recent Transactions</h3>
                <div class="space-y-3">
                    @forelse($recentTransactions as $transaction)
                        <div class="flex items-center justify-between p-3 bg-white/5 rounded-lg border border-gray-600">
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
                    @empty
                        <p class="text-gray-400 text-center py-8">No transactions found for this period</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Monthly Trend Chart
    const monthlyCtx = document.getElementById('monthlyTrendChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: @json($monthlyTrend['labels']),
            datasets: [{
                label: 'Income',
                data: @json($monthlyTrend['income']),
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4
            }, {
                label: 'Expenses',
                data: @json($monthlyTrend['expenses']),
                borderColor: '#EF4444',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#ffffff'
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        color: '#ffffff'
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: '#ffffff'
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                }
            }
        }
    });

    // Expense Breakdown Chart
    const expenseCtx = document.getElementById('expenseBreakdownChart').getContext('2d');
    new Chart(expenseCtx, {
        type: 'doughnut',
        data: {
            labels: @json($expensesByCategory->pluck('category.name')),
            datasets: [{
                data: @json($expensesByCategory->pluck('total')),
                backgroundColor: @json($expensesByCategory->pluck('category.color')),
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#ffffff',
                        padding: 20
                    }
                }
            }
        }
    });
</script>
@endsection
