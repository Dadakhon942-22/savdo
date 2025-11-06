@extends('layouts.app')

@section('title', __('messages.my_sales'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="relative mb-8 md:mb-12">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-600 via-teal-600 to-green-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        <div class="relative text-center py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-emerald-50 via-teal-50 to-green-50 dark:from-emerald-900/30 dark:via-teal-900/30 dark:to-green-900/30 border-2 border-emerald-200 dark:border-emerald-700 shadow-xl">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-emerald-600 via-teal-600 to-green-600 dark:from-emerald-400 dark:via-teal-400 dark:to-green-400 bg-clip-text text-transparent drop-shadow-sm">
                💰 {{ __('messages.my_sales') }}
            </h1>
            <p class="text-base md:text-xl text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.shop') }}: {{ $shop->name }}</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500 via-emerald-500 to-teal-500 rounded-xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 rounded-xl shadow-lg p-6 border-2 border-green-200 dark:border-green-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-slate-700 dark:text-slate-300 text-sm font-extrabold mb-2 uppercase tracking-wide">{{ __('messages.total_sales') }}</h3>
                        <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ number_format($totalSales, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                    </div>
                    <div class="bg-green-500/20 dark:bg-green-400/20 rounded-full p-3">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-500 rounded-xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl shadow-lg p-6 border-2 border-blue-200 dark:border-blue-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-slate-700 dark:text-slate-300 text-sm font-extrabold mb-2 uppercase tracking-wide">{{ __('messages.total_orders') }}</h3>
                        <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $orders->total() }}</p>
                    </div>
                    <div class="bg-blue-500/20 dark:bg-blue-400/20 rounded-full p-3">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 rounded-xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl shadow-lg p-6 border-2 border-purple-200 dark:border-purple-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-slate-700 dark:text-slate-300 text-sm font-extrabold mb-2 uppercase tracking-wide">{{ __('messages.top_products') }}</h3>
                        <p class="text-3xl font-extrabold text-slate-900 dark:text-white">{{ $topProducts->count() }}</p>
                    </div>
                    <div class="bg-purple-500/20 dark:bg-purple-400/20 rounded-full p-3">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Products -->
    @if($topProducts->count() > 0)
    <div class="relative mb-8">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 rounded-2xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 border-2 border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-6">🏆 {{ __('messages.top_selling_products') }}</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900/40 dark:to-pink-900/40">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.product') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.sold_quantity') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.total_revenue') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($topProducts as $index => $item)
                        <tr class="hover:bg-purple-50 dark:hover:bg-purple-900/10 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-purple-600 dark:text-purple-400">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($item->product->image)
                                        <div class="h-12 w-12 bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-xl border-2 border-purple-200 dark:border-purple-700 shadow-md flex items-center justify-center p-1 mr-3">
                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->localized_name }}" class="max-w-full max-h-full object-contain">
                                        </div>
                                    @else
                                        <div class="h-12 w-12 bg-gradient-to-br from-purple-500 via-pink-500 to-rose-500 rounded-xl flex items-center justify-center mr-3 shadow-md">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="text-sm font-extrabold text-slate-900 dark:text-white">{{ $item->product->localized_name }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700 dark:text-slate-300">
                                {{ $item->total_quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-emerald-600 dark:text-emerald-400">
                                {{ number_format($item->total_revenue, 0, ',', ' ') }} {{ __('messages.currency') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- Orders List -->
    <div class="relative mb-8">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-teal-500 to-green-500 rounded-2xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden border-2 border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-emerald-100 to-teal-100 dark:from-emerald-900/40 dark:to-teal-900/40">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.order_number', ['number' => '']) }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.customer') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.amount') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.status') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.date') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($orders as $order)
                        <tr class="hover:bg-emerald-50 dark:hover:bg-emerald-900/10 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-slate-900 dark:text-white">{{ $order->order_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700 dark:text-slate-300">{{ $order->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-emerald-600 dark:text-emerald-400">
                                {{ number_format($order->shop_total, 0, ',', ' ') }} {{ __('messages.currency') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1.5 rounded-full text-xs font-extrabold
                                    @if($order->status == 'completed') bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300
                                    @elseif($order->status == 'processing') bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300
                                    @elseif($order->status == 'cancelled') bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300
                                    @else bg-yellow-100 dark:bg-yellow-900/40 text-yellow-800 dark:text-yellow-300
                                    @endif">
                                    {{ __('messages.' . $order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-700 dark:text-slate-300">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('seller.sales.show', $order) }}" class="bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 hover:from-green-700 hover:via-emerald-700 hover:to-teal-700 text-white px-3 py-2 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-1.5 whitespace-nowrap inline-flex">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ __('messages.view') }}
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="w-24 h-24 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-xl font-extrabold text-slate-700 dark:text-slate-300">{{ __('messages.no_sales') }}</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection
