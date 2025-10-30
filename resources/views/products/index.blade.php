@extends('layouts.app')

@section('title', __('messages.products'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">{{ __('messages.products') }}</h1>

    <div class="flex flex-col md:flex-row gap-8">
        <aside class="md:w-1/4">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="font-bold text-lg mb-4">{{ __('messages.search') }}</h2>
                <form action="{{ route('products.index') }}" method="GET">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('messages.search_placeholder') }}" class="w-full border rounded px-4 py-2 mb-4">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">{{ __('messages.search') }}</button>
                </form>

                <h2 class="font-bold text-lg mb-4 mt-6">{{ __('messages.categories') }}</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">{{ __('messages.all') }}</a>
                    </li>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" class="text-gray-700 hover:text-blue-600">
                            {{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <div class="md:w-3/4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <a href="{{ route('products.show', $product) }}">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">{{ __('messages.no_image') }}</span>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-2">{{ $product->category->name }}</p>
                            <p class="text-blue-600 font-bold text-xl">{{ number_format($product->price, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                            @if($product->stock > 0)
                                <span class="text-green-600 text-sm">{{ __('messages.in_stock', ['count' => $product->stock]) }}</span>
                            @else
                                <span class="text-red-600 text-sm">{{ __('messages.out_of_stock') }}</span>
                            @endif
                        </div>
                    </a>
                    @auth
                        @if($product->stock > 0)
                        <form action="{{ route('cart.store') }}" method="POST" class="p-4 pt-0">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                                {{ __('messages.add_to_cart') }}
                            </button>
                        </form>
                        @endif
                    @endauth
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">{{ __('messages.no_products') }}</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
