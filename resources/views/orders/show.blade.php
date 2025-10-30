@extends('layouts.app')

@section('title', __('messages.order_number', ['number' => $order->order_number]))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <a href="{{ route('orders.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">← {{ __('messages.back') }}</a>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold">{{ __('messages.order_number', ['number' => $order->order_number]) }}</h1>
                <p class="text-gray-500">{{ $order->created_at->format('d.m.Y H:i') }}</p>
            </div>
            <div class="text-right">
                <span class="px-4 py-2 rounded text-sm font-medium
                    @if($order->status == 'completed') bg-green-100 text-green-800
                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                    @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                    @else bg-yellow-100 text-yellow-800
                    @endif">
                    {{ __('messages.' . $order->status) }}
                </span>
                <p class="text-2xl font-bold mt-2">{{ number_format($order->total, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <div>
                <h2 class="font-bold text-lg mb-4">{{ __('messages.shipping_info') }}</h2>
                <p><strong>{{ __('messages.shipping_address') }}:</strong> {{ $order->shipping_address }}</p>
                <p><strong>{{ __('messages.phone') }}:</strong> {{ $order->phone }}</p>
                @if($order->notes)
                <p><strong>{{ __('messages.notes') }}:</strong> {{ $order->notes }}</p>
                @endif
            </div>
            <div>
                <h2 class="font-bold text-lg mb-4">{{ __('messages.order_status') }}</h2>
                <p><strong>{{ __('messages.payment_status') }}:</strong> {{ __('messages.' . $order->payment_status) }}</p>
                <p><strong>{{ __('messages.status') }}:</strong> {{ __('messages.' . $order->status) }}</p>
            </div>
        </div>

        <div>
            <h2 class="font-bold text-lg mb-4">{{ __('messages.products') }}</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.product_name') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.price') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.quantity') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.total') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($order->items as $item)
                    <tr>
                        <td class="px-6 py-4">{{ $item->product_name }}</td>
                        <td class="px-6 py-4">{{ number_format($item->price, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                        <td class="px-6 py-4">{{ $item->quantity }}</td>
                        <td class="px-6 py-4 font-medium">{{ number_format($item->subtotal, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-bold">{{ __('messages.total') }}:</td>
                        <td class="px-6 py-4 font-bold">{{ number_format($order->total, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
