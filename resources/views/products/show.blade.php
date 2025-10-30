@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">← {{ __('messages.back') }}</a>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400 text-xl">{{ __('messages.no_image') }}</span>
                    </div>
                @endif
            </div>
            <div class="md:w-1/2 p-8">
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $product->category->name }}</p>
                <p class="text-3xl font-bold text-blue-600 mb-4">{{ number_format($product->price, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                
                @if($product->stock > 0)
                    <p class="text-green-600 mb-4">{{ __('messages.in_stock', ['count' => $product->stock]) }}</p>
                @else
                    <p class="text-red-600 mb-4">{{ __('messages.out_of_stock') }}</p>
                @endif

                @if($product->description)
                <div class="mb-6">
                    <h2 class="font-bold mb-2">{{ __('messages.description') }}</h2>
                    <p class="text-gray-700">{{ $product->description }}</p>
                </div>
                @endif

                @auth
                    @if($product->stock > 0)
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="mb-4">
                            <label for="quantity" class="block mb-2">{{ __('messages.quantity') }}:</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="border rounded px-4 py-2 w-32">
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded hover:bg-blue-700 text-lg">
                            {{ __('messages.add_to_cart') }}
                        </button>
                    </form>
                    @else
                    <button disabled class="bg-gray-400 text-white px-8 py-3 rounded cursor-not-allowed">
                        {{ __('messages.out_of_stock') }}
                    </button>
                    @endif
                @else
                    <p class="text-gray-600">{!! __('messages.login_to_add', ['login' => '<a href="'.route('login').'" class="text-blue-600 hover:underline">'.__('messages.login').'</a>']) !!}</p>
                @endauth
            </div>
        </div>
    </div>

    @if($relatedProducts->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6">{{ __('messages.similar_products') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
            <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                <a href="{{ route('products.show', $relatedProduct) }}">
                    @if($relatedProduct->image)
                        <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">{{ __('messages.no_image') }}</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2">{{ $relatedProduct->name }}</h3>
                        <p class="text-blue-600 font-bold text-xl">{{ number_format($relatedProduct->price, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
