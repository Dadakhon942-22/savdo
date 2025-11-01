@extends('layouts.app')

@section('title', __('messages.products'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white">{{ __('messages.products') }}</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            {{ __('messages.new_product') }}
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden border-2 border-gray-200 dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gradient-to-r from-gray-100 to-gray-50 dark:from-gray-700 dark:to-gray-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.image') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.name') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.category') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.price') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.stock') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.status') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-900 dark:text-white uppercase tracking-wider">{{ __('messages.action') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->localized_name }}" class="h-20 w-20 object-cover rounded-xl border-2 border-gray-200 dark:border-gray-700">
                            @else
                                <div class="h-20 w-20 bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 rounded-xl flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-extrabold text-gray-900 dark:text-white">{{ $product->localized_name }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $product->category->localized_name }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-extrabold text-gray-900 dark:text-white">{{ number_format($product->price, 0, ',', ' ') }} {{ __('messages.currency') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-gray-900 dark:text-white">{{ $product->stock }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->is_active)
                                <span class="px-3 py-1.5 rounded-full text-xs font-extrabold bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300">{{ __('messages.active') }}</span>
                            @else
                                <span class="px-3 py-1.5 rounded-full text-xs font-extrabold bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300">{{ __('messages.inactive') }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.products.edit', $product) }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-xl font-bold transition-colors">{{ __('messages.edit') }}</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl font-bold transition-colors">{{ __('messages.delete') }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
