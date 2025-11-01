@extends('layouts.app')

@section('title', __('messages.checkout'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-3">{{ __('messages.checkout') }}</h1>
        <p class="text-xl text-gray-700 dark:text-gray-300">{{ __('messages.order_information') }}</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        <!-- Order Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-8 border-2 border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-6">{{ __('messages.order_information') }}</h2>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="shipping_address" class="block text-lg font-bold text-gray-900 dark:text-white mb-3">
                        {{ __('messages.shipping_address') }} *
                    </label>
                    <textarea name="shipping_address" id="shipping_address" rows="4" required class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 font-medium">{{ old('shipping_address') }}</textarea>
                    @error('shipping_address')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="phone" class="block text-lg font-bold text-gray-900 dark:text-white mb-3">
                        {{ __('messages.phone') }} *
                    </label>
                    <input type="text" name="phone" id="phone" required value="{{ old('phone') }}" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 font-medium" placeholder="{{ __('messages.phone_placeholder') }}">
                    @error('phone')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="notes" class="block text-lg font-bold text-gray-900 dark:text-white mb-3">
                        {{ __('messages.notes_optional') }}
                    </label>
                    <textarea name="notes" id="notes" rows="3" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 font-medium">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-4 rounded-xl font-extrabold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    {{ __('messages.confirm_order') }}
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-8 border-2 border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-6">{{ __('messages.order_summary') }}</h2>
            <div class="space-y-4">
                @foreach($cartItems as $item)
                <div class="flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center flex-1">
                        @if($item->product->image)
                            <div class="h-20 w-20 bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-xl border-2 border-gray-200 dark:border-gray-700 flex items-center justify-center p-1">
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->localized_name }}" class="max-w-full max-h-full object-contain">
                            </div>
                        @else
                            <div class="h-20 w-20 bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 rounded-xl flex items-center justify-center">
                                <svg class="w-10 h-10 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="ml-4 flex-1">
                            <p class="font-extrabold text-gray-900 dark:text-white">{{ $item->product->localized_name }}</p>
                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $item->quantity }} x {{ number_format($item->product->price, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                        </div>
                    </div>
                    <p class="font-extrabold text-lg text-gray-900 dark:text-white ml-4">{{ number_format($item->product->price * $item->quantity, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                </div>
                @endforeach
            </div>

            <div class="flex justify-between items-center mt-6 pt-6 border-t-2 border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 -mx-8 -mb-8 px-8 py-6 rounded-b-xl">
                <span class="text-2xl font-extrabold text-gray-900 dark:text-white">{{ __('messages.total') }}:</span>
                <span class="text-3xl font-extrabold text-primary-600 dark:text-primary-400">{{ number_format($total, 0, ',', ' ') }} {{ __('messages.currency') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
