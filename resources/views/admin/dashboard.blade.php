@extends('layouts.app')

@section('title', __('messages.admin_panel'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">{{ __('messages.admin_panel') }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm mb-2">{{ __('messages.total_orders') }}</h3>
            <p class="text-3xl font-bold">{{ $stats['total_orders'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm mb-2">{{ __('messages.pending_orders') }}</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending_orders'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm mb-2">{{ __('messages.total_products') }}</h3>
            <p class="text-3xl font-bold">{{ $stats['total_products'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm mb-2">{{ __('messages.total_users') }}</h3>
            <p class="text-3xl font-bold">{{ $stats['total_users'] }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">{{ __('messages.recent_orders') }}</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.order_number', ['number' => '']) }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.user') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.amount') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.status') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.action') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentOrders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($order->total, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded text-xs
                                @if($order->status == 'completed') bg-green-100 text-green-800
                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ __('messages.' . $order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:underline">{{ __('messages.view') }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8 space-y-6">
        <div>
            <h2 class="text-xl font-bold mb-4">Foydalanuvchilar</h2>
            <a href="{{ route('admin.users.index') }}" class="block bg-gradient-to-r from-primary-600 to-secondary-600 text-white px-6 py-3 rounded-xl hover:from-primary-700 hover:to-secondary-700 text-center font-semibold shadow-lg">
                👥 Foydalanuvchilarni Boshqarish
            </a>
        </div>

        <div>
            <h2 class="text-xl font-bold mb-4">{{ __('messages.manage_shops') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('admin.shop-categories.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 text-center font-semibold shadow-lg">
                    {{ __('messages.shop_categories') }}
                </a>
                <a href="{{ route('admin.shops.index') }}" class="bg-pink-600 text-white px-6 py-3 rounded-xl hover:bg-pink-700 text-center font-semibold shadow-lg">
                    {{ __('messages.shops') }}
                </a>
            </div>
        </div>

        <div>
            <h2 class="text-xl font-bold mb-4">{{ __('messages.manage_products') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.products.index') }}" class="bg-primary-600 text-white px-6 py-3 rounded-xl hover:bg-primary-700 text-center font-semibold shadow-lg">
                    {{ __('messages.products') }}
                </a>
                <a href="{{ route('admin.categories.index') }}" class="bg-secondary-600 text-white px-6 py-3 rounded-xl hover:bg-secondary-700 text-center font-semibold shadow-lg">
                    {{ __('messages.categories') }}
                </a>
                <a href="{{ route('admin.orders.index') }}" class="bg-accent-600 text-white px-6 py-3 rounded-xl hover:bg-accent-700 text-center font-semibold shadow-lg">
                    {{ __('messages.orders') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
