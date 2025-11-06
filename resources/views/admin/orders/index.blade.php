@extends('layouts.app')

@section('title', __('messages.orders'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-3">{{ __('messages.all_orders') }}</h1>
        <p class="text-xl text-gray-700 dark:text-gray-300">{{ __('messages.manage_orders') }}</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden border-2 border-gray-200 dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gradient-to-r from-gray-100 to-gray-50 dark:from-gray-700 dark:to-gray-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.order_number', ['number' => '']) }}</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.user') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.amount') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.status') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.date') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.action') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-gray-900 dark:text-white">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-white">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold text-primary-600 dark:text-primary-400">{{ number_format($order->total, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.orders.show', $order) }}" class="bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 hover:from-green-700 hover:via-emerald-700 hover:to-teal-700 text-white px-3 py-2 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-1.5 whitespace-nowrap">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ __('messages.view') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
