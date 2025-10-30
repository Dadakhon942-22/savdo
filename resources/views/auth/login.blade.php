@extends('layouts.app')

@section('title', __('messages.login'))

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-center">{{ __('messages.login') }}</h1>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.email') }}</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}" class="w-full border rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.password') }}</label>
                <input type="password" name="password" id="password" required class="w-full border rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded">
                    <span class="ml-2 text-sm text-gray-600">{{ __('messages.remember_me') }}</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                {{ __('messages.login') }}
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            {{ __('messages.no_account') }} <a href="{{ route('register') }}" class="text-blue-600 hover:underline">{{ __('messages.register') }}</a>
        </p>
    </div>
</div>
@endsection
