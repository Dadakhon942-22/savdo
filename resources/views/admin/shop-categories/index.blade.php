@extends('layouts.app')

@section('title', __('messages.shop_categories'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="relative mb-8 md:mb-12">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-violet-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        <div class="relative text-center py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-indigo-50 via-purple-50 to-violet-50 dark:from-indigo-900/30 dark:via-purple-900/30 dark:to-violet-900/30 border-2 border-indigo-200 dark:border-indigo-700 shadow-xl">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-violet-600 dark:from-indigo-400 dark:via-purple-400 dark:to-violet-400 bg-clip-text text-transparent drop-shadow-sm">
                📂 {{ __('messages.shop_categories') }}
            </h1>
            <p class="text-base md:text-xl text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.manage_shop_categories') }}</p>
        </div>
    </div>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
        <a href="{{ route('admin.shop-categories.create') }}" class="bg-gradient-to-r from-indigo-600 via-purple-600 to-violet-600 hover:from-indigo-700 hover:via-purple-700 hover:to-violet-700 text-white px-6 py-3 rounded-xl font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            ➕ {{ __('messages.new_shop_category') }}
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-100 dark:bg-emerald-900/40 border-2 border-emerald-400 dark:border-emerald-700 text-emerald-800 dark:text-emerald-300 px-6 py-4 rounded-xl mb-6 font-extrabold shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
        <div class="group relative">
            <!-- Pastki oyna -->
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-purple-500 to-violet-500 rounded-2xl transform rotate-[-2deg] opacity-20 group-hover:opacity-30 transition-all duration-300 group-hover:rotate-[-3deg] blur-sm -z-10 pointer-events-none"></div>
            
            <!-- Asosiy oyna -->
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2 border-2 border-gray-200 dark:border-gray-700 h-full flex flex-col">
                <!-- Rasm bo'limi -->
                <div class="relative h-56 overflow-hidden bg-gradient-to-br from-indigo-500 via-purple-500 to-violet-500">
                    @if($category->image)
                        <div class="w-full h-full bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="max-w-full max-h-full object-contain p-2 group-hover:scale-110 transition-transform duration-700">
                        </div>
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-500 via-purple-500 to-violet-500">
                            <svg class="w-32 h-32 text-white opacity-90 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                
                <div class="p-4 md:p-6 flex-1 flex flex-col">
                    <h3 class="font-extrabold text-xl mb-2 text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                        {{ $category->name }}
                    </h3>
                    @if($category->description)
                        <p class="text-slate-700 dark:text-slate-300 text-sm mb-4 line-clamp-2">{{ Str::limit($category->description, 100) }}</p>
                    @endif
                    <p class="text-indigo-600 dark:text-indigo-400 font-extrabold mb-4">
                        {{ $category->shops_count }} {{ __('messages.shops') }}
                    </p>
                    
                    <div class="flex gap-2 mt-auto">
                        <a href="{{ route('admin.shop-categories.edit', $category) }}" class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 text-white py-2.5 px-3 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 text-center text-sm flex items-center justify-center gap-1.5 whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            {{ __('messages.edit') }}
                        </a>
                        <form action="{{ route('admin.shop-categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('messages.delete_confirm') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white py-2.5 px-3 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 text-sm flex items-center justify-center gap-1.5 whitespace-nowrap">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                {{ __('messages.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $categories->links() }}
    </div>
</div>
@endsection
