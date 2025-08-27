@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-800 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-black/40 backdrop-blur-md border border-gray-700 rounded-lg p-8 shadow-2xl">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-white">
                    Sign in to your account
                </h2>
                <p class="mt-2 text-sm text-gray-300">
                    Or
                    <a href="{{ route('register') }}" class="font-medium text-white hover:text-gray-300 transition-colors">
                        create a new account
                    </a>
                </p>
            </div>
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required 
                               class="appearance-none relative block w-full px-3 py-3 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-600' }} bg-black/20 backdrop-blur-sm placeholder-gray-400 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-white focus:border-white focus:z-10 sm:text-sm transition-all" 
                               placeholder="Email address" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                               class="appearance-none relative block w-full px-3 py-3 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-600' }} bg-black/20 backdrop-blur-sm placeholder-gray-400 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-white focus:border-white focus:z-10 sm:text-sm transition-all" 
                               placeholder="Password">
                        @error('password')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" 
                               class="h-4 w-4 text-white focus:ring-white border-gray-600 bg-black/20 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-300">
                            Remember me
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-black bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-600 group-hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 6 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
