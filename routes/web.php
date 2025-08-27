<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\CategoryController;

// Redirect root to dashboard if authenticated, otherwise show welcome page
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'show'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

Route::get('/register', [RegisterController::class, 'show'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

// Protected Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Transaction Routes
Route::middleware('auth')->group(function () {
    Route::get('/income/create', [TransactionController::class, 'createIncome'])->name('transactions.income.create');
    Route::post('/income', [TransactionController::class, 'storeIncome'])->name('transactions.income.store');
    Route::get('/expense/create', [TransactionController::class, 'createExpense'])->name('transactions.expense.create');
    Route::post('/expense', [TransactionController::class, 'storeExpense'])->name('transactions.expense.store');
});

// Reports Routes
Route::middleware('auth')->group(function () {
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
});

// Category Routes
Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
});
