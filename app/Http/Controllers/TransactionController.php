<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Show the form for creating a new income.
     */
    public function createIncome()
    {
        $categories = Category::where('type', 'income')->get();
        return view('transactions.create-income', compact('categories'));
    }

    /**
     * Show the form for creating a new expense.
     */
    public function createExpense()
    {
        $categories = Category::where('type', 'expense')->get();
        return view('transactions.create-expense', compact('categories'));
    }

    /**
     * Store a newly created income in storage.
     */
    public function storeIncome(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'type' => 'income',
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Income added successfully!');
    }

    /**
     * Store a newly created expense in storage.
     */
    public function storeExpense(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'type' => 'expense',
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Expense added successfully!');
    }
}
