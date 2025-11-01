@extends('layouts.app')

@section('title', __('messages.my_orders'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-3">{{ __('messages.my_orders') }}</h1>
        <p class="text-xl text-gray-700 dark:text-gray-300">{{ __('messages.all_orders') }}</p>
    </div>

    @if($orders->count() > 0)
    <div class="space-y-6">
        @foreach($orders as $order)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 md:p-8 border-2 border-gray-200 dark:border-gray-700 hover:shadow-3xl transition-all duration-300">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-6 gap-4">
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white mb-2">{{ __('messages.order_number', ['number' => $order->order_number]) }}</h2>
                    <div class="flex items-center text-gray-700 dark:text-gray-300 font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $order->created_at->format('d.m.Y H:i') }}
                    </div>
                </div>
                <div class="text-left md:text-right">
                    <span class="inline-block px-4 py-2 rounded-xl text-sm font-extrabold mb-3
                        @if($order->status == 'completed') bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300
                        @elseif($order->status == 'processing') bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300
                        @elseif($order->status == 'cancelled') bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300
                        @else bg-yellow-100 dark:bg-yellow-900/40 text-yellow-800 dark:text-yellow-300
                        @endif">
                        {{ __('messages.' . $order->status) }}
                    </span>
                    <p class="text-3xl font-extrabold text-primary-600 dark:text-primary-400">{{ number_format($order->total, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                </div>
            </div>

            <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-bold text-gray-600 dark:text-gray-400 mb-1">{{ __('messages.shipping_address') }}:</p>
                        <p class="text-gray-900 dark:text-white font-semibold">{{ $order->shipping_address }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-600 dark:text-gray-400 mb-1">{{ __('messages.phone') }}:</p>
                        <p class="text-gray-900 dark:text-white font-semibold">{{ $order->phone }}</p>
                    </div>
                </div>
            </div>

            <div class="border-t-2 border-gray-200 dark:border-gray-700 pt-6">
                <h3 class="text-lg font-extrabold text-gray-900 dark:text-white mb-4">{{ __('messages.products') }}:</h3>
                <ul class="space-y-2">
                    @foreach($order->items as $item)
                    <li class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-900/50 rounded-lg">
                        <span class="font-bold text-gray-900 dark:text-white">{{ $item->product_name }} x {{ $item->quantity }}</span>
                        <span class="font-extrabold text-primary-600 dark:text-primary-400">{{ number_format($item->subtotal, 0, ',', ' ') }} {{ __('messages.currency') }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-6">
                <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    {{ __('messages.view_details') }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-20 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border-2 border-gray-200 dark:border-gray-700">
        <svg class="w-28 h-28 mx-auto text-gray-400 dark:text-gray-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
        </svg>
        <p class="text-2xl font-extrabold text-gray-700 dark:text-gray-300 mb-4">{{ __('messages.no_orders') }}</p>
        <a href="{{ route('products.index') }}" class="inline-block bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            {{ __('messages.products') }}
        </a>
    </div>
    @endif
</div>
@endsection
