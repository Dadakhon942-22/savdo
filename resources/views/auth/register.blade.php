@extends('layouts.app')

@section('title', __('messages.register'))

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-6 text-center">{{ __('messages.register') }}</h1>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.name') }}</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}" class="w-full border rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.email') }}</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}" class="w-full border rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.password') }}</label>
                <input type="password" name="password" id="password" required class="w-full border rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.password_confirmation') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full border rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.role') }}</label>
                <select name="role" id="role" class="w-full border rounded px-4 py-2">
                    <option value="customer">{{ __('messages.customer') }}</option>
                    <option value="seller">{{ __('messages.seller') }}</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                {{ __('messages.register') }}
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            {{ __('messages.already_account') }} <a href="{{ route('login') }}" class="text-blue-600 hover:underline">{{ __('messages.login') }}</a>
        </p>
    </div>
</div>
@endsection
