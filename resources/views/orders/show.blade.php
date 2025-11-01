@extends('layouts.app')

@section('title', __('messages.order_number', ['number' => $order->order_number]))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Back Link -->
    <div class="relative mb-6 md:mb-8">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-500 via-secondary-500 to-accent-500 rounded-xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
        <a href="{{ route('orders.index') }}" class="relative inline-flex items-center bg-gradient-to-r from-primary-50 via-secondary-50 to-accent-50 dark:from-primary-900/30 dark:via-secondary-900/30 dark:to-accent-900/30 hover:from-primary-100 hover:via-secondary-100 hover:to-accent-100 dark:hover:from-primary-900/50 dark:hover:via-secondary-900/50 dark:hover:to-accent-900/50 text-slate-900 dark:text-white hover:text-slate-800 dark:hover:text-gray-100 font-extrabold px-4 py-3 md:px-6 md:py-4 rounded-xl border-2 border-primary-200 dark:border-primary-700 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 md:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-base md:text-lg">{{ __('messages.back') }}</span>
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-8 border-2 border-gray-200 dark:border-gray-700 mb-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-8 gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-3">{{ __('messages.order_number', ['number' => $order->order_number]) }}</h1>
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

        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-extrabold text-gray-900 dark:text-white mb-4">{{ __('messages.shipping_info') }}</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm font-bold text-gray-600 dark:text-gray-400 mb-1">{{ __('messages.shipping_address') }}:</p>
                        <p class="text-gray-900 dark:text-white font-semibold">{{ $order->shipping_address }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-600 dark:text-gray-400 mb-1">{{ __('messages.phone') }}:</p>
                        <p class="text-gray-900 dark:text-white font-semibold">{{ $order->phone }}</p>
                    </div>
                    @if($order->notes)
                    <div>
                        <p class="text-sm font-bold text-gray-600 dark:text-gray-400 mb-1">{{ __('messages.notes') }}:</p>
                        <p class="text-gray-900 dark:text-white font-medium">{{ $order->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-extrabold text-gray-900 dark:text-white mb-4">{{ __('messages.order_status') }}</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm font-bold text-gray-600 dark:text-gray-400 mb-1">{{ __('messages.payment_status') }}:</p>
                        <p class="font-extrabold text-gray-900 dark:text-white">{{ __('messages.' . $order->payment_status) }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-600 dark:text-gray-400 mb-1">{{ __('messages.status') }}:</p>
                        <p class="font-extrabold text-gray-900 dark:text-white">{{ __('messages.' . $order->status) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-6">{{ __('messages.products') }}</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-gray-100 to-gray-50 dark:from-gray-700 dark:to-gray-800">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.product_name') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.price') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.quantity') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.total') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($order->items as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">{{ $item->product_name }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-700 dark:text-gray-300">{{ number_format($item->price, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                            <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 font-extrabold text-gray-900 dark:text-white">{{ number_format($item->subtotal, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gradient-to-r from-gray-100 to-gray-50 dark:from-gray-700 dark:to-gray-800">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-extrabold text-gray-900 dark:text-white">{{ __('messages.total') }}:</td>
                            <td class="px-6 py-4 font-extrabold text-2xl text-primary-600 dark:text-primary-400">{{ number_format($order->total, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
