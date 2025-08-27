<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Expense Tracker') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom Styles -->
    <style>
        @keyframes toast-pop {
            0% {
                opacity: 0;
                transform: translate(-50%, 30px) scale(0.9);
            }
            60% {
                opacity: 1;
                transform: translate(-50%, -5px) scale(1.02);
            }
            100% {
                opacity: 1;
                transform: translate(-50%, 0) scale(1);
            }
        }
        
        @keyframes toast-fade-out {
            0% {
                opacity: 1;
                transform: translate(-50%, 0) scale(1);
            }
            100% {
                opacity: 0;
                transform: translate(-50%, 15px) scale(0.95);
            }
        }
        
        .animate-toast-pop {
            animation: toast-pop 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .animate-toast-fade-out {
            animation: toast-fade-out 0.3s ease-out forwards;
        }
        
        .toast-container {
            transform: translateX(-50%);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Flash Messages -->
    @if (session('success'))
        <div class="fixed bottom-6 left-1/2 z-50 bg-black/85 border border-gray-600 text-white px-4 py-2 rounded-full shadow-2xl backdrop-blur-md animate-toast-pop max-w-sm toast-container" role="alert" id="success-alert">
            <div class="flex items-center justify-center text-sm whitespace-nowrap">
                <svg class="w-4 h-4 mr-2 text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="fixed bottom-6 left-1/2 z-50 bg-black/85 border border-gray-600 text-white px-4 py-2 rounded-full shadow-2xl backdrop-blur-md animate-toast-pop max-w-sm toast-container" role="alert" id="error-alert">
            <div class="flex items-center justify-center text-sm whitespace-nowrap">
                <svg class="w-4 h-4 mr-2 text-red-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Auto-hide flash messages -->
    <script>
        // Auto-hide success alerts after 3 seconds
        setTimeout(function() {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.classList.add('animate-toast-fade-out');
                setTimeout(() => successAlert.remove(), 300);
            }
        }, 3000);

        // Auto-hide error alerts after 4 seconds
        setTimeout(function() {
            const errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                errorAlert.classList.add('animate-toast-fade-out');
                setTimeout(() => errorAlert.remove(), 300);
            }
        }, 4000);
    </script>
</body>
</html>
