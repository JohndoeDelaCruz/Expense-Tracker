<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories with usage statistics
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get all categories with transaction counts and totals
        $categories = Category::withCount(['transactions' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->with(['transactions' => function ($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->select('category_id', DB::raw('SUM(amount) as total_amount'), 'type')
                      ->groupBy('category_id', 'type');
            }])
            ->orderBy('type')
            ->orderBy('name')
            ->get()
            ->map(function ($category) use ($user) {
                // Calculate totals for this category
                $totalAmount = $user->transactions()
                    ->where('category_id', $category->id)
                    ->sum('amount');
                    
                $lastUsed = $user->transactions()
                    ->where('category_id', $category->id)
                    ->latest('date')
                    ->first();
                
                $category->total_amount = $totalAmount;
                $category->last_used = $lastUsed ? $lastUsed->date : null;
                
                return $category;
            });
        
        // Separate income and expense categories
        $incomeCategories = $categories->where('type', 'income');
        $expenseCategories = $categories->where('type', 'expense');
        
        // Category usage statistics
        $mostUsedCategory = $categories->sortByDesc('transactions_count')->first();
        $totalCategories = $categories->count();
        $usedCategories = $categories->where('transactions_count', '>', 0)->count();
        
        return view('categories.index', compact(
            'incomeCategories',
            'expenseCategories',
            'mostUsedCategory',
            'totalCategories',
            'usedCategories'
        ));
    }

    /**
     * Show the form for creating a new category
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'type' => 'required|in:income,expense',
            'color' => 'required|string|max:7',
            'icon' => 'required|string|max:10',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Show the form for editing a category
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'type' => 'required|in:income,expense',
            'color' => 'required|string|max:7',
            'icon' => 'required|string|max:10',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category
     */
    public function destroy(Category $category)
    {
        // Check if category has transactions
        if ($category->transactions()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Cannot delete category with existing transactions.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
