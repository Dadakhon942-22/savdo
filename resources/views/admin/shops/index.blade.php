@extends('layouts.app')

@section('title', __('messages.manage_shops'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="relative mb-8 md:mb-12">
        <div class="absolute inset-0 bg-gradient-to-br from-pink-600 via-rose-600 to-red-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        <div class="relative text-center py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-pink-50 via-rose-50 to-red-50 dark:from-pink-900/30 dark:via-rose-900/30 dark:to-red-900/30 border-2 border-pink-200 dark:border-pink-700 shadow-xl">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-pink-600 via-rose-600 to-red-600 dark:from-pink-400 dark:via-rose-400 dark:to-red-400 bg-clip-text text-transparent drop-shadow-sm">
                🏪 {{ __('messages.manage_shops') }}
            </h1>
            <p class="text-base md:text-xl text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.shops') }}</p>
        </div>
    </div>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
        <a href="{{ route('admin.shops.create') }}" class="bg-gradient-to-r from-pink-600 via-rose-600 to-red-600 hover:from-pink-700 hover:via-rose-700 hover:to-red-700 text-white px-6 py-3 rounded-xl font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            ➕ {{ __('messages.new_shop') }}
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-100 dark:bg-emerald-900/40 border-2 border-emerald-400 dark:border-emerald-700 text-emerald-800 dark:text-emerald-300 px-6 py-4 rounded-xl mb-6 font-extrabold shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="relative">
        <div class="absolute inset-0 bg-gradient-to-br from-pink-400 via-rose-400 to-red-400 rounded-2xl transform rotate-[-0.5deg] opacity-5 blur-sm"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden border-2 border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-pink-100 via-rose-100 to-red-100 dark:from-pink-900/40 dark:via-rose-900/40 dark:to-red-900/40">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.shop_name') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.shop_category') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.shop_owner') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.phone') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.status') }}</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('messages.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($shops as $shop)
                        <tr class="hover:bg-pink-50 dark:hover:bg-pink-900/10 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($shop->logo)
                                        <div class="h-12 w-12 bg-gradient-to-br from-gray-100 via-gray-50 to-white dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-xl border-2 border-pink-200 dark:border-pink-700 shadow-md flex items-center justify-center p-1 mr-3">
                                            <img src="{{ asset('storage/' . $shop->logo) }}" alt="{{ $shop->name }}" class="max-w-full max-h-full object-contain">
                                        </div>
                                    @else
                                        <div class="h-12 w-12 bg-gradient-to-br from-pink-500 via-rose-500 to-red-500 rounded-xl flex items-center justify-center mr-3 shadow-md">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="text-sm font-extrabold text-slate-900 dark:text-white">{{ $shop->name }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700 dark:text-slate-300">
                                {{ $shop->shopCategory->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700 dark:text-slate-300">
                                {{ $shop->seller->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700 dark:text-slate-300">
                                {{ $shop->phone }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1.5 rounded-xl text-xs font-extrabold
                                    {{ $shop->is_active ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300 border-2 border-emerald-300 dark:border-emerald-600' : 'bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-300 border-2 border-rose-300 dark:border-rose-600' }}">
                                    {{ $shop->is_active ? __('messages.active') : __('messages.inactive') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-extrabold">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('admin.shops.edit', $shop) }}" class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 text-white px-3 py-2 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-1.5 whitespace-nowrap">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        {{ __('messages.edit') }}
                                    </a>
                                    <form action="{{ route('admin.shops.destroy', $shop) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('messages.delete_confirm') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white px-3 py-2 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-1.5 whitespace-nowrap">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            {{ __('messages.delete') }}
                                        </button>
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

    <div class="mt-6">
        {{ $shops->links() }}
    </div>
</div>
@endsection
