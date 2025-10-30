@extends('layouts.app')

@section('title', __('messages.categories'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">{{ __('messages.categories') }}</h1>

    @if($categories->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($categories as $category)
        <a href="{{ route('categories.show', $category) }}" class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow overflow-hidden">
            @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                    <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            @endif
            
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2">{{ $category->name }}</h3>
                @if($category->description)
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $category->description }}</p>
                @endif
                <div class="flex items-center text-blue-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span class="font-semibold">{{ $category->products_count }} {{ __('messages.products') }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="text-center py-12 bg-white rounded-lg shadow">
        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
        </svg>
        <p class="text-gray-500 text-lg">{{ __('messages.no_categories') }}</p>
    </div>
    @endif
</div>
@endsection




