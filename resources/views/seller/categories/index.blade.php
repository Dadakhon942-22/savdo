@extends('layouts.app')

@section('title', __('messages.categories'))

@section('content')
@php use Illuminate\Support\Str; @endphp
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="relative mb-8 md:mb-12">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-secondary-600 to-accent-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        <div class="relative text-center py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-primary-50 via-secondary-50 to-accent-50 dark:from-primary-900/30 dark:via-secondary-900/30 dark:to-accent-900/30 border-2 border-primary-200 dark:border-primary-700 shadow-xl">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600 dark:from-primary-400 dark:via-secondary-400 dark:to-accent-400 bg-clip-text text-transparent drop-shadow-sm">
                📁 {{ __('messages.categories') }}
            </h1>
            <p class="text-base md:text-xl text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.shop') }}: {{ $shop->name }}</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 dark:bg-green-900/40 border-2 border-green-400 dark:border-green-700 text-green-800 dark:text-green-300 px-6 py-4 rounded-xl mb-6 font-bold shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 dark:bg-red-900/40 border-2 border-red-400 dark:border-red-700 text-red-800 dark:text-red-300 px-6 py-4 rounded-xl mb-6 font-bold shadow-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
            {{ __('messages.my_shop') }} - {{ __('messages.categories') }}
        </h2>
        <a href="{{ route('seller.categories.create') }}" class="bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            {{ __('messages.new_category') }}
        </a>
    </div>

    @if($categories->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
        <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden border-2 border-gray-200 dark:border-gray-700 hover:shadow-3xl transition-all duration-300 transform hover:scale-105">
            @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->localized_name }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
            @else
                <div class="w-full h-48 bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 flex items-center justify-center">
                    <svg class="w-20 h-20 text-white opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            @endif
            <div class="p-6">
                <h3 class="text-xl font-extrabold text-gray-900 dark:text-white mb-3">{{ $category->localized_name }}</h3>
                @if($category->localized_description)
                    <p class="text-gray-700 dark:text-gray-300 mb-4 font-medium line-clamp-2">{{ Str::limit($category->localized_description, 100) }}</p>
                @endif
                <div class="mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-extrabold bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300">
                        {{ $category->products_count }} {{ __('messages.products') }}
                    </span>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('seller.categories.edit', $category) }}" class="flex-1 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 text-white px-3 py-3 rounded-xl text-center font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-1.5 whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        {{ __('messages.edit') }}
                    </a>
                    <form action="{{ route('seller.categories.destroy', $category) }}" method="POST" class="flex-1" onsubmit="return confirm('{{ __('messages.delete_confirm') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white px-3 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-1.5 whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            {{ __('messages.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12 md:py-20 bg-white dark:bg-gray-800 rounded-2xl md:rounded-3xl shadow-lg border-2 border-gray-100 dark:border-gray-700">
        <svg class="mx-auto h-16 w-16 md:h-20 md:w-20 text-gray-400 dark:text-gray-500 mb-4 md:mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
        </svg>
        <p class="text-gray-600 dark:text-gray-400 text-lg md:text-2xl font-semibold mb-4">{{ __('messages.no_categories') }}</p>
        <a href="{{ route('seller.categories.create') }}" class="inline-block bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            {{ __('messages.new_category') }}
        </a>
    </div>
    @endif
</div>
@endsection

