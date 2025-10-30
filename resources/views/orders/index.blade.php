@extends('layouts.app')

@section('title', __('messages.my_orders'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">{{ __('messages.my_orders') }}</h1>

    @if($orders->count() > 0)
    <div class="space-y-6">
        @foreach($orders as $order)
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h2 class="text-xl font-bold">{{ __('messages.order_number', ['number' => $order->order_number]) }}</h2>
                    <p class="text-gray-500">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                </div>
                <div class="text-right">
                    <span class="px-3 py-1 rounded text-sm font-medium
                        @if($order->status == 'completed') bg-green-100 text-green-800
                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800
                        @endif">
                        {{ __('messages.' . $order->status) }}
                    </span>
                    <p class="text-xl font-bold mt-2">{{ number_format($order->total, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                </div>
            </div>

            <div class="mb-4">
                <p><strong>{{ __('messages.shipping_address') }}:</strong> {{ $order->shipping_address }}</p>
                <p><strong>{{ __('messages.phone') }}:</strong> {{ $order->phone }}</p>
            </div>

            <div class="border-t pt-4">
                <h3 class="font-bold mb-2">{{ __('messages.products') }}:</h3>
                <ul class="space-y-2">
                    @foreach($order->items as $item)
                    <li class="flex justify-between">
                        <span>{{ $item->product_name }} x {{ $item->quantity }}</span>
                        <span>{{ number_format($item->subtotal, 0, ',', ' ') }} {{ __('messages.currency') }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-4">
                <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:underline">{{ __('messages.view_details') }}</a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12 bg-white rounded-lg shadow">
        <p class="text-gray-500 text-lg mb-4">{{ __('messages.no_orders') }}</p>
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">{{ __('messages.products') }}</a>
    </div>
    @endif
</div>
@endsection
