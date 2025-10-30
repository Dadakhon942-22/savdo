@extends('layouts.app')

@section('title', __('messages.checkout'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">{{ __('messages.checkout') }}</h1>

    <div class="grid md:grid-cols-2 gap-8">
        <div>
            <h2 class="text-xl font-bold mb-4">{{ __('messages.order_information') }}</h2>
            <form action="{{ route('orders.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
                @csrf
                
                <div class="mb-4">
                    <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('messages.shipping_address') }} *
                    </label>
                    <textarea name="shipping_address" id="shipping_address" rows="4" required class="w-full border rounded px-4 py-2">{{ old('shipping_address') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('messages.phone') }} *
                    </label>
                    <input type="text" name="phone" id="phone" required value="{{ old('phone') }}" class="w-full border rounded px-4 py-2" placeholder="{{ __('messages.phone_placeholder') }}">
                </div>

                <div class="mb-4">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('messages.notes_optional') }}
                    </label>
                    <textarea name="notes" id="notes" rows="3" class="w-full border rounded px-4 py-2">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
                    {{ __('messages.confirm_order') }}
                </button>
            </form>
        </div>

        <div>
            <h2 class="text-xl font-bold mb-4">{{ __('messages.order_summary') }}</h2>
            <div class="bg-white rounded-lg shadow p-6">
                @foreach($cartItems as $item)
                <div class="flex justify-between items-center mb-4 pb-4 border-b">
                    <div class="flex items-center">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="h-16 w-16 object-cover rounded">
                        @else
                            <div class="h-16 w-16 bg-gray-200 rounded"></div>
                        @endif
                        <div class="ml-4">
                            <p class="font-medium">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-500">{{ $item->quantity }} x {{ number_format($item->product->price, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                        </div>
                    </div>
                    <p class="font-bold">{{ number_format($item->product->price * $item->quantity, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                </div>
                @endforeach

                <div class="flex justify-between items-center mt-4 pt-4 border-t">
                    <span class="text-lg font-bold">{{ __('messages.total') }}:</span>
                    <span class="text-xl font-bold text-green-600">{{ number_format($total, 0, ',', ' ') }} {{ __('messages.currency') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
