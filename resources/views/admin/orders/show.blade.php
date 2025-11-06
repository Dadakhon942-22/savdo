@extends('layouts.app')

@section('title', __('messages.order_number', ['number' => $order->order_number]))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-600 via-slate-600 to-zinc-600 hover:from-gray-700 hover:via-slate-700 hover:to-zinc-700 text-white px-4 py-2 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 mb-4">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        {{ __('messages.back') }}
    </a>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold">{{ __('messages.order_number', ['number' => $order->order_number]) }}</h1>
                <p class="text-gray-500">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                <p class="text-gray-600 mt-2"><strong>{{ __('messages.user') }}:</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
            </div>
            <div class="text-right">
                <p class="text-2xl font-bold">{{ number_format($order->total, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="font-bold text-lg mb-4">{{ __('messages.change_status') }}</h2>
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex gap-4 items-end">
                @csrf
                @method('PUT')
                <select name="status" class="border rounded px-4 py-2">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>{{ __('messages.pending') }}</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>{{ __('messages.processing') }}</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>{{ __('messages.completed') }}</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>{{ __('messages.cancelled') }}</option>
                </select>
                <button type="submit" class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 text-white px-4 py-2 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-1.5 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('messages.update_status') }}
                </button>
            </form>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <div>
                <h2 class="font-bold text-lg mb-4">{{ __('messages.shipping_info') }}</h2>
                <p><strong>{{ __('messages.address') }}:</strong> {{ $order->shipping_address }}</p>
                <p><strong>{{ __('messages.phone') }}:</strong> {{ $order->phone }}</p>
                @if($order->notes)
                <p><strong>{{ __('messages.notes') }}:</strong> {{ $order->notes }}</p>
                @endif
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
