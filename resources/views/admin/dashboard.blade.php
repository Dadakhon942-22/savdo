@extends('layouts.app')

@section('title', __('messages.admin_panel'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="relative mb-8 md:mb-12">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-secondary-600 to-accent-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        <div class="relative text-center py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-primary-50 via-secondary-50 to-accent-50 dark:from-primary-900/30 dark:via-secondary-900/30 dark:to-accent-900/30 border-2 border-primary-200 dark:border-primary-700 shadow-xl">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600 dark:from-primary-400 dark:via-secondary-400 dark:to-accent-400 bg-clip-text text-transparent drop-shadow-sm">
                🎛️ {{ __('messages.admin_panel') }}
            </h1>
            <p class="text-base md:text-xl text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.dashboard') }}</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Orders -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-500 rounded-xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl shadow-lg p-6 border-2 border-blue-200 dark:border-blue-700 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-slate-700 dark:text-slate-300 text-sm font-extrabold mb-2 uppercase tracking-wide">{{ __('messages.total_orders') }}</h3>
                        <p class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ $stats['total_orders'] }}</p>
                    </div>
                    <div class="bg-blue-500/20 dark:bg-blue-400/20 rounded-full p-3">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500 via-amber-500 to-yellow-500 rounded-xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/30 dark:to-orange-800/30 rounded-xl shadow-lg p-6 border-2 border-orange-200 dark:border-orange-700 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-slate-700 dark:text-slate-300 text-sm font-extrabold mb-2 uppercase tracking-wide">{{ __('messages.pending_orders') }}</h3>
                        <p class="text-4xl font-extrabold text-orange-600 dark:text-orange-400">{{ $stats['pending_orders'] }}</p>
                    </div>
                    <div class="bg-orange-500/20 dark:bg-orange-400/20 rounded-full p-3">
                        <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-teal-500 to-green-500 rounded-xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 rounded-xl shadow-lg p-6 border-2 border-green-200 dark:border-green-700 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-slate-700 dark:text-slate-300 text-sm font-extrabold mb-2 uppercase tracking-wide">{{ __('messages.total_products') }}</h3>
                        <p class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ $stats['total_products'] }}</p>
                    </div>
                    <div class="bg-green-500/20 dark:bg-green-400/20 rounded-full p-3">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500 via-violet-500 to-pink-500 rounded-xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl shadow-lg p-6 border-2 border-purple-200 dark:border-purple-700 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-slate-700 dark:text-slate-300 text-sm font-extrabold mb-2 uppercase tracking-wide">{{ __('messages.total_users') }}</h3>
                        <p class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ $stats['total_users'] }}</p>
                    </div>
                    <div class="bg-purple-500/20 dark:bg-purple-400/20 rounded-full p-3">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="relative mb-8">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-400 via-gray-500 to-gray-600 rounded-2xl transform rotate-[-0.5deg] opacity-5 blur-sm"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 border-2 border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white">{{ __('messages.recent_orders') }}</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-gray-100 to-gray-50 dark:from-gray-700 dark:to-gray-800">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.order_number', ['number' => '']) }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.user') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.amount') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.status') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-slate-900 dark:text-white">{{ $order->order_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700 dark:text-slate-300">{{ $order->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-slate-900 dark:text-white">{{ number_format($order->total, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1.5 rounded-full text-xs font-extrabold
                                    @if($order->status == 'completed') bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300
                                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300
                                    @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300
                                    @endif">
                                    {{ __('messages.' . $order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-extrabold hover:underline transition-colors">{{ __('messages.view') }}</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <p class="text-slate-500 dark:text-slate-400 text-lg font-bold">{{ __('messages.no_orders') }}</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Management Sections -->
    <div class="mt-8 space-y-8">
        <!-- Users Management -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500 via-violet-500 to-pink-500 rounded-2xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-2 border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ __('messages.total_users') }}</h2>
                    <span class="text-3xl font-extrabold text-purple-600 dark:text-purple-400">{{ $stats['total_users'] }}</span>
                </div>
                <a href="{{ route('admin.users.index') }}" class="block bg-gradient-to-r from-purple-600 via-violet-600 to-pink-600 hover:from-purple-700 hover:via-violet-700 hover:to-pink-700 text-white px-6 py-4 rounded-xl text-center font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                    👥 {{ __('messages.total_users') }}
                </a>
            </div>
        </div>

        <!-- Shop Management -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-2xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-2 border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ __('messages.manage_shops') }}</h2>
                    <span class="text-3xl font-extrabold text-indigo-600 dark:text-indigo-400">{{ $stats['total_shops'] }}</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.shop-categories.index') }}" class="relative bg-gradient-to-r from-indigo-600 via-purple-600 to-violet-600 hover:from-indigo-700 hover:via-purple-700 hover:to-violet-700 text-white px-6 py-4 rounded-xl text-center font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-between">
                        <span>{{ __('messages.shop_categories') }}</span>
                        <span class="bg-white/20 rounded-full px-3 py-1 text-sm">{{ $stats['total_shop_categories'] }}</span>
                    </a>
                    <a href="{{ route('admin.shops.index') }}" class="relative bg-gradient-to-r from-pink-600 via-rose-600 to-red-600 hover:from-pink-700 hover:via-rose-700 hover:to-red-700 text-white px-6 py-4 rounded-xl text-center font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-between">
                        <span>{{ __('messages.shops') }}</span>
                        <span class="bg-white/20 rounded-full px-3 py-1 text-sm">{{ $stats['total_shops'] }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Products & Categories Management -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-teal-500 to-green-500 rounded-2xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-2 border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ __('messages.products_and_categories') }}</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.products.index') }}" class="relative bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 hover:from-green-700 hover:via-emerald-700 hover:to-teal-700 text-white px-6 py-4 rounded-xl text-center font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-between">
                        <span>{{ __('messages.products') }}</span>
                        <span class="bg-white/20 rounded-full px-3 py-1 text-sm">{{ $stats['total_products'] }}</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="relative bg-gradient-to-r from-blue-600 via-cyan-600 to-teal-600 hover:from-blue-700 hover:via-cyan-700 hover:to-teal-700 text-white px-6 py-4 rounded-xl text-center font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-between">
                        <span>{{ __('messages.categories') }}</span>
                        <span class="bg-white/20 rounded-full px-3 py-1 text-sm">{{ $stats['total_categories'] }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Orders Management -->
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-accent-500 via-orange-500 to-red-500 rounded-2xl transform rotate-[-0.5deg] opacity-10 blur-sm"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-2 border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">{{ __('messages.manage_orders') }}</h2>
                    <span class="text-3xl font-extrabold text-orange-600 dark:text-orange-400">{{ $stats['total_orders'] }}</span>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="block bg-gradient-to-r from-accent-600 via-orange-600 to-red-600 hover:from-accent-700 hover:via-orange-700 hover:to-red-700 text-white px-6 py-4 rounded-xl text-center font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                    📋 {{ __('messages.orders') }} ({{ $stats['pending_orders'] }} {{ __('messages.pending') }})
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
