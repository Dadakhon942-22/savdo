@extends('layouts.app')

@section('title', __('messages.admin_panel'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">{{ __('messages.admin_panel') }}</h1>
        <p class="text-gray-600 dark:text-gray-400">{{ __('messages.dashboard') }}</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Orders -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl shadow-lg p-6 border-2 border-blue-200 dark:border-blue-700 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2 uppercase tracking-wide">{{ __('messages.total_orders') }}</h3>
                    <p class="text-4xl font-extrabold text-gray-900 dark:text-white">{{ $stats['total_orders'] }}</p>
                </div>
                <div class="bg-blue-500/20 dark:bg-blue-400/20 rounded-full p-3">
                    <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/30 dark:to-orange-800/30 rounded-xl shadow-lg p-6 border-2 border-orange-200 dark:border-orange-700 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2 uppercase tracking-wide">{{ __('messages.pending_orders') }}</h3>
                    <p class="text-4xl font-extrabold text-orange-600 dark:text-orange-400">{{ $stats['pending_orders'] }}</p>
                </div>
                <div class="bg-orange-500/20 dark:bg-orange-400/20 rounded-full p-3">
                    <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 rounded-xl shadow-lg p-6 border-2 border-green-200 dark:border-green-700 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2 uppercase tracking-wide">{{ __('messages.total_products') }}</h3>
                    <p class="text-4xl font-extrabold text-gray-900 dark:text-white">{{ $stats['total_products'] }}</p>
                </div>
                <div class="bg-green-500/20 dark:bg-green-400/20 rounded-full p-3">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl shadow-lg p-6 border-2 border-purple-200 dark:border-purple-700 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2 uppercase tracking-wide">{{ __('messages.total_users') }}</h3>
                    <p class="text-4xl font-extrabold text-gray-900 dark:text-white">{{ $stats['total_users'] }}</p>
                </div>
                <div class="bg-purple-500/20 dark:bg-purple-400/20 rounded-full p-3">
                    <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 mb-8 border border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('messages.recent_orders') }}</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gradient-to-r from-gray-100 to-gray-50 dark:from-gray-700 dark:to-gray-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.order_number', ['number' => '']) }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.user') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.amount') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.status') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.action') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700 dark:text-gray-300">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-white">{{ number_format($order->total, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold
                                @if($order->status == 'completed') bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300
                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300
                                @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300
                                @endif">
                                {{ __('messages.' . $order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-semibold hover:underline transition-colors">{{ __('messages.view') }}</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">{{ __('messages.no_orders') }}</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Management Sections -->
    <div class="mt-8 space-y-8">
        <!-- Users Management -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('messages.total_users') }}</h2>
            <a href="{{ route('admin.users.index') }}" class="block bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-6 py-4 rounded-xl text-center font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                👥 {{ __('messages.total_users') }}
            </a>
        </div>

        <!-- Shop Management -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('messages.manage_shops') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('admin.shop-categories.index') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-4 rounded-xl text-center font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                    {{ __('messages.shop_categories') }}
                </a>
                <a href="{{ route('admin.shops.index') }}" class="bg-gradient-to-r from-pink-600 to-rose-600 hover:from-pink-700 hover:to-rose-700 text-white px-6 py-4 rounded-xl text-center font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                    {{ __('messages.shops') }}
                </a>
            </div>
        </div>

        <!-- Product Management -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('messages.manage_products') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.products.index') }}" class="bg-gradient-to-r from-primary-600 to-blue-600 hover:from-primary-700 hover:to-blue-700 text-white px-6 py-4 rounded-xl text-center font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                    {{ __('messages.products') }}
                </a>
                <a href="{{ route('admin.categories.index') }}" class="bg-gradient-to-r from-secondary-600 to-teal-600 hover:from-secondary-700 hover:to-teal-700 text-white px-6 py-4 rounded-xl text-center font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                    {{ __('messages.categories') }}
                </a>
                <a href="{{ route('admin.orders.index') }}" class="bg-gradient-to-r from-accent-600 to-orange-600 hover:from-accent-700 hover:to-orange-700 text-white px-6 py-4 rounded-xl text-center font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                    {{ __('messages.orders') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
