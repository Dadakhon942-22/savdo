@extends('layouts.app')

@section('title', 'Savat')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">{{ __('messages.cart') }}</h1>

    @if($cartItems->count() > 0)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.products') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.price') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.quantity') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.total') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($cartItems as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="h-16 w-16 object-cover rounded">
                            @else
                                <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">{{ __('messages.no_image') }}</span>
                                </div>
                            @endif
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                <div class="text-sm text-gray-500">{{ $item->product->category->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ number_format($item->product->price, 0, ',', ' ') }} {{ __('messages.currency') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-20 border rounded px-2 py-1">
                            <button type="submit" class="ml-2 text-blue-600 hover:text-blue-800">{{ __('messages.update') }}</button>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ number_format($item->product->price * $item->quantity, 0, ',', ' ') }} {{ __('messages.currency') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">{{ __('messages.delete') }}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="bg-gray-50 px-6 py-4">
            <div class="flex justify-between items-center">
                <span class="text-lg font-bold">{{ __('messages.total') }}:</span>
                <span class="text-xl font-bold">{{ number_format($total, 0, ',', ' ') }} {{ __('messages.currency') }}</span>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('orders.create') }}" class="bg-green-600 text-white px-8 py-3 rounded hover:bg-green-700 inline-block">
            {{ __('messages.checkout') }}
        </a>
    </div>
    @else
    <div class="text-center py-12 bg-white rounded-lg shadow">
        <p class="text-gray-500 text-lg mb-4">{{ __('messages.empty_cart') }}</p>
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">{{ __('messages.products') }}</a>
    </div>
    @endif
</div>
@endsection

