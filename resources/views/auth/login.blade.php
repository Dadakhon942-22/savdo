@extends('layouts.app')

@section('title', __('messages.login'))

@section('content')
<div class="max-w-md mx-auto py-8">
    <div class="relative">
        <!-- Pastki oyna -->
        <div class="absolute inset-0 bg-gradient-to-r from-primary-500 via-secondary-500 to-accent-500 rounded-2xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
        
        <!-- Asosiy karta -->
        <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border-2 border-gray-200 dark:border-gray-700 p-8">
        <h1 class="text-3xl sm:text-4xl font-bold mb-6 text-center bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-500 dark:from-primary-400 dark:via-secondary-400 dark:to-accent-400 bg-clip-text text-transparent">
            {{ __('messages.login') }}
        </h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                <ul class="text-sm text-red-600 dark:text-red-400">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" id="login-form" autocomplete="off">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.email') }}</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.password') }}</label>
                <input type="password" name="password" id="password" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded">
                    <span class="ml-2 text-sm text-gray-600">{{ __('messages.remember_me') }}</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-primary-600 to-secondary-600 text-white py-3 rounded-lg font-semibold hover:from-primary-700 hover:to-secondary-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg hover:shadow-xl">
                {{ __('messages.login') }}
            </button>
        </form>

        <script>
            // CSRF token'ni yangilash
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('login-form');
                const metaToken = document.querySelector('meta[name="csrf-token"]');
                
                if (!form || !metaToken) {
                    console.error('Login form or CSRF token not found');
                    return;
                }
                
                // Barcha _token inputlarini yangilash
                const formTokens = form.querySelectorAll('input[name="_token"]');
                formTokens.forEach(function(tokenInput) {
                    tokenInput.value = metaToken.content;
                });
                
                // Form submit'da token'ni yangilash
                form.addEventListener('submit', function(e) {
                    // Meta tag'dan yangi token olish va barcha inputlarga qo'yish
                    formTokens.forEach(function(tokenInput) {
                        tokenInput.value = metaToken.content;
                    });
                });
            });
        </script>

        <p class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
            {{ __('messages.no_account') }} <a href="{{ route('register') }}" class="text-primary-600 dark:text-primary-400 hover:underline font-semibold">{{ __('messages.register') }}</a>
        </p>
        </div>
    </div>
</div>
@endsection
