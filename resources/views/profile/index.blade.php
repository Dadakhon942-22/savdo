@extends('layouts.app')

@section('title', __('messages.profile'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">{{ __('messages.profile') }}</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Shaxsiy ma'lumotlar -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">{{ __('messages.personal_info') }}</h2>
            
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="w-full border rounded px-4 py-2 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.email') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full border rounded px-4 py-2 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.role') }}</label>
                    <div class="px-4 py-2 bg-gray-100 rounded">
                        @if($user->isAdmin())
                            <span class="text-purple-600 font-semibold">{{ __('messages.admin_role') }}</span>
                        @elseif($user->isSeller())
                            <span class="text-blue-600 font-semibold">{{ __('messages.seller') }}</span>
                        @else
                            <span class="text-green-600 font-semibold">{{ __('messages.customer') }}</span>
                        @endif
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{ __('messages.update') }}
                </button>
            </form>
        </div>

        <!-- Parolni o'zgartirish -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">{{ __('messages.change_password') }}</h2>
            
            <form action="{{ route('profile.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.current_password') }}</label>
                    <input type="password" name="current_password" id="current_password" required class="w-full border rounded px-4 py-2 @error('current_password') border-red-500 @enderror">
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.new_password') }}</label>
                    <input type="password" name="new_password" id="new_password" required class="w-full border rounded px-4 py-2 @error('new_password') border-red-500 @enderror">
                    @error('new_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.new_password_confirmation') }}</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required class="w-full border rounded px-4 py-2">
                </div>

                <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    {{ __('messages.change_password') }}
                </button>
            </form>
        </div>
    </div>

    <!-- Statistika -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <svg class="w-12 h-12 mx-auto text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <h3 class="text-2xl font-bold">{{ $user->orders->count() }}</h3>
            <p class="text-gray-600">{{ __('messages.orders') }}</p>
        </div>

        @if($user->isCustomer())
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <svg class="w-12 h-12 mx-auto text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="text-2xl font-bold">{{ $user->cartItems->count() }}</h3>
            <p class="text-gray-600">{{ __('messages.cart') }}</p>
        </div>
        @endif

        @if($user->isSeller())
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <svg class="w-12 h-12 mx-auto text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <h3 class="text-2xl font-bold">{{ $user->products->count() }}</h3>
            <p class="text-gray-600">{{ __('messages.products') }}</p>
        </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <svg class="w-12 h-12 mx-auto text-yellow-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-sm font-bold">{{ $user->created_at->format('d.m.Y') }}</h3>
            <p class="text-gray-600">{{ __('messages.register') }}</p>
        </div>
    </div>
</div>
@endsection




