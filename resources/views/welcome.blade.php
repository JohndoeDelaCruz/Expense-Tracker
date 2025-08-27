<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Expense Tracker') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-900 via-black to-gray-800">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-black/50 backdrop-blur-md border border-gray-800 rounded-full mx-4 mt-4 shadow-2xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-white">Expense Tracker</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Login</a>
                            <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-md text-sm font-medium transition-colors shadow-lg">Sign Up</a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 pt-16 md:pt-24">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Floating background elements -->
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-white/5 rounded-full animate-float-slow"></div>
                    <div class="absolute top-1/3 right-1/4 w-24 h-24 bg-white/3 rounded-full animate-float-medium"></div>
                    <div class="absolute bottom-1/4 left-1/3 w-16 h-16 bg-white/4 rounded-full animate-float-fast"></div>
                </div>

                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in-up">
                    <span class="animate-slide-in-left">Take Control of Your</span><br>
                    <span class="text-gray-300 italic animate-slide-in-right animation-delay-300">Finances</span>
                </h1>
                <p class="text-xl text-gray-400 mb-8 max-w-2xl mx-auto animate-fade-in-up animation-delay-500">
                    Track your expenses, manage your budget, and achieve your financial goals with our sophisticated expense tracker.
                </p>
                
                @guest
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up animation-delay-700">
                    <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-black px-8 py-3 rounded-lg font-semibold text-lg transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 animate-slide-in-left animation-delay-900">
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="bg-transparent hover:bg-white/10 text-white border-2 border-white/30 hover:border-white px-8 py-3 rounded-lg font-semibold text-lg transition-all duration-300 shadow-xl backdrop-blur-sm animate-slide-in-right animation-delay-1100">
                        Sign In
                    </a>
                </div>
                @else
                <div class="flex justify-center animate-fade-in-up animation-delay-700">
                    <a href="{{ route('dashboard') }}" class="bg-white hover:bg-gray-100 text-black px-8 py-3 rounded-lg font-semibold text-lg transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 animate-slide-in-left animation-delay-900">
                        Go to Dashboard
                    </a>
                </div>
                @endguest

                <!-- Features -->
                <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-black/40 backdrop-blur-md border border-gray-700 rounded-lg p-6 shadow-2xl hover:shadow-3xl transition-all duration-300 hover:-translate-y-2 animate-slide-in-left animation-delay-1300">
                        <div class="bg-white/10 backdrop-blur-sm rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 animate-pulse-slow">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Track Expenses</h3>
                        <p class="text-gray-300">Easily log and categorize your daily expenses to see where your money goes.</p>
                    </div>

                    <div class="bg-black/40 backdrop-blur-md border border-gray-700 rounded-lg p-6 shadow-2xl hover:shadow-3xl transition-all duration-300 hover:-translate-y-2 animate-fade-in-up animation-delay-1500">
                        <div class="bg-white/10 backdrop-blur-sm rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 animate-pulse-slow animation-delay-200">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a2 2 0 002 2h2a2 2 0 002-2V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Generate Reports</h3>
                        <p class="text-gray-300">Get detailed insights and reports about your spending patterns and trends.</p>
                    </div>

                    <div class="bg-black/40 backdrop-blur-md border border-gray-700 rounded-lg p-6 shadow-2xl hover:shadow-3xl transition-all duration-300 hover:-translate-y-2 animate-slide-in-right animation-delay-1700">
                        <div class="bg-white/10 backdrop-blur-sm rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4 animate-pulse-slow animation-delay-400">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Secure & Private</h3>
                        <p class="text-gray-300">Your financial data is encrypted and secure. Only you have access to your information.</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-black/50 backdrop-blur-md border-t border-gray-800 py-8 mt-16 md:mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-400 text-sm">
                    © {{ date('Y') }} Expense Tracker. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
