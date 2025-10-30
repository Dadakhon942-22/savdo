@extends('layouts.app')

@section('title', __('messages.my_products'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold">{{ __('messages.my_products') }}</h1>
            <p class="text-gray-600 mt-2">{{ __('messages.shop') }}: {{ $shop->name }}</p>
        </div>
        <a href="{{ route('seller.products.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            {{ __('messages.new_product') }}
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.image') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.name') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.category') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.price') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.stock') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.status') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('messages.action') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover rounded">
                        @else
                            <div class="h-16 w-16 bg-gray-200 rounded"></div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->category->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($product->price, 0, ',', ' ') }} {{ __('messages.currency') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->stock }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($product->is_active)
                            <span class="px-2 py-1 rounded text-xs bg-green-100 text-green-800">{{ __('messages.active') }}</span>
                        @else
                            <span class="px-2 py-1 rounded text-xs bg-red-100 text-red-800">{{ __('messages.inactive') }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('seller.products.edit', $product) }}" class="text-blue-600 hover:text-blue-900 mr-4">{{ __('messages.edit') }}</a>
                        <form action="{{ route('seller.products.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('{{ __('messages.delete_confirm') }}')">{{ __('messages.delete') }}</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        {{ __('messages.no_products') }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection




