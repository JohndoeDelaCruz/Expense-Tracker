<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Income Categories
            ['name' => 'Salary', 'type' => 'income', 'color' => '#10B981', 'icon' => '💼'],
            ['name' => 'Freelance', 'type' => 'income', 'color' => '#059669', 'icon' => '💻'],
            ['name' => 'Business', 'type' => 'income', 'color' => '#047857', 'icon' => '🏢'],
            ['name' => 'Investment', 'type' => 'income', 'color' => '#065F46', 'icon' => '📈'],
            ['name' => 'Other Income', 'type' => 'income', 'color' => '#064E3B', 'icon' => '💰'],

            // Expense Categories
            ['name' => 'Food & Dining', 'type' => 'expense', 'color' => '#EF4444', 'icon' => '🍽️'],
            ['name' => 'Transportation', 'type' => 'expense', 'color' => '#DC2626', 'icon' => '🚗'],
            ['name' => 'Shopping', 'type' => 'expense', 'color' => '#B91C1C', 'icon' => '🛒'],
            ['name' => 'Entertainment', 'type' => 'expense', 'color' => '#991B1B', 'icon' => '🎬'],
            ['name' => 'Bills & Utilities', 'type' => 'expense', 'color' => '#7F1D1D', 'icon' => '📄'],
            ['name' => 'Healthcare', 'type' => 'expense', 'color' => '#F97316', 'icon' => '🏥'],
            ['name' => 'Education', 'type' => 'expense', 'color' => '#EA580C', 'icon' => '📚'],
            ['name' => 'Travel', 'type' => 'expense', 'color' => '#C2410C', 'icon' => '✈️'],
            ['name' => 'Other Expenses', 'type' => 'expense', 'color' => '#9A3412', 'icon' => '💸'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
