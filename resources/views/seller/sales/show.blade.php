@extends('layouts.app')

@section('title', __('messages.order_number', ['number' => $order->order_number]))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="{{ route('seller.sales.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-600 via-slate-600 to-zinc-600 hover:from-gray-700 hover:via-slate-700 hover:to-zinc-700 text-white px-4 py-2 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 mb-4">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        {{ __('messages.back') }}
    </a>

    <!-- Hero Section -->
    <div class="relative mb-8">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-600 via-teal-600 to-green-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        <div class="relative text-center py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 dark:from-emerald-900/30 dark:via-teal-900/30 dark:to-green-900/30 border-2 border-emerald-200 dark:border-emerald-700 shadow-xl">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-emerald-600 via-teal-600 to-green-600 dark:from-emerald-400 dark:via-teal-400 dark:to-green-400 bg-clip-text text-transparent drop-shadow-sm">
                📦 {{ __('messages.order_number', ['number' => $order->order_number]) }}
            </h1>
            <p class="text-base md:text-xl text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.shop') }}: {{ $shop->name }}</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-8 border-2 border-gray-200 dark:border-gray-700">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-8 gap-4">
            <div>
                <p class="text-gray-500 dark:text-gray-400 mb-3">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                <p class="text-gray-600 dark:text-gray-300 mt-2">
                    <strong>{{ __('messages.customer') }}:</strong> {{ $order->user->name }} ({{ $order->user->email }})
                </p>
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
                <p class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">{{ number_format($order->shop_total, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
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
                    <thead class="bg-gradient-to-r from-emerald-100 to-teal-100 dark:from-emerald-900/40 dark:to-teal-900/40">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.product_name') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.price') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.quantity') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.total') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($order->items as $item)
                        <tr class="hover:bg-emerald-50 dark:hover:bg-emerald-900/10 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">{{ $item->product_name }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-700 dark:text-gray-300">{{ number_format($item->price, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                            <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 font-extrabold text-gray-900 dark:text-white">{{ number_format($item->subtotal, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gradient-to-r from-emerald-100 to-teal-100 dark:from-emerald-900/40 dark:to-teal-900/40">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-extrabold text-gray-900 dark:text-white">{{ __('messages.total') }}:</td>
                            <td class="px-6 py-4 font-extrabold text-2xl text-emerald-600 dark:text-emerald-400">{{ number_format($order->shop_total, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
