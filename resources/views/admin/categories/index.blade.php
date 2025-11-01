@extends('layouts.app')

@section('title', __('messages.categories'))

@section('content')
@php use Illuminate\Support\Str; @endphp
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white">{{ __('messages.categories') }}</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            {{ __('messages.new_category') }}
        </a>
    </div>

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
                <div class="flex gap-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="flex-1 bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-4 py-3 rounded-xl text-center font-bold shadow-lg hover:shadow-xl transition-all duration-300">
                        {{ __('messages.edit') }}
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="flex-1" onsubmit="return confirm('{{ __('messages.delete_confirm') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300">
                            {{ __('messages.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
