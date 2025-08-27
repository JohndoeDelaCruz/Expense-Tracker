<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportsController extends Controller
{
    /**
     * Display the reports dashboard
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $period = $request->get('period', 'month'); // month, year, all
        
        // Get date range based on period
        $dateRange = $this->getDateRange($period);
        
        // Get transactions for the period
        $transactionsQuery = $user->transactions()
            ->with('category')
            ->whereBetween('date', $dateRange);
        
        // Summary statistics
        $totalIncome = $transactionsQuery->clone()->where('type', 'income')->sum('amount');
        $totalExpenses = $transactionsQuery->clone()->where('type', 'expense')->sum('amount');
        $netBalance = $totalIncome - $totalExpenses;
        $transactionCount = $transactionsQuery->clone()->count();
        
        // Category breakdown
        $expensesByCategory = $user->transactions()
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->with('category')
            ->where('type', 'expense')
            ->whereBetween('date', $dateRange)
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->get();
            
        $incomeByCategory = $user->transactions()
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->with('category')
            ->where('type', 'income')
            ->whereBetween('date', $dateRange)
            ->groupBy('category_id')
            ->orderByDesc('total')
            ->get();
        
        // Monthly trend (last 6 months)
        $monthlyTrend = $this->getMonthlyTrend($user);
        
        // Recent transactions
        $recentTransactions = $user->transactions()
            ->with('category')
            ->whereBetween('date', $dateRange)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
        
        return view('reports.index', compact(
            'totalIncome',
            'totalExpenses', 
            'netBalance',
            'transactionCount',
            'expensesByCategory',
            'incomeByCategory',
            'monthlyTrend',
            'recentTransactions',
            'period'
        ));
    }
    
    /**
     * Get date range based on period
     */
    private function getDateRange($period)
    {
        switch ($period) {
            case 'year':
                return [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()];
            case 'month':
                return [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()];
            case 'week':
                return [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
            default:
                return [Carbon::parse('1900-01-01'), Carbon::now()->endOfYear()];
        }
    }
    
    /**
     * Get monthly trend data for charts
     */
    private function getMonthlyTrend($user)
    {
        $months = [];
        $incomeData = [];
        $expenseData = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthStart = $month->copy()->startOfMonth();
            $monthEnd = $month->copy()->endOfMonth();
            
            $months[] = $month->format('M Y');
            
            $monthlyIncome = $user->transactions()
                ->where('type', 'income')
                ->whereBetween('date', [$monthStart, $monthEnd])
                ->sum('amount');
                
            $monthlyExpenses = $user->transactions()
                ->where('type', 'expense')
                ->whereBetween('date', [$monthStart, $monthEnd])
                ->sum('amount');
            
            $incomeData[] = $monthlyIncome;
            $expenseData[] = $monthlyExpenses;
        }
        
        return [
            'labels' => $months,
            'income' => $incomeData,
            'expenses' => $expenseData
        ];
    }
}
