@extends('layouts.app')

@section('title', __('messages.orders'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">{{ __('messages.all_orders') }}</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.order_number', ['number' => '']) }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.user') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.amount') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.status') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.date') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.action') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($orders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->order_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($order->total, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 rounded text-xs
                            @if($order->status == 'completed') bg-green-100 text-green-800
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ __('messages.' . $order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:underline">{{ __('messages.view') }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
