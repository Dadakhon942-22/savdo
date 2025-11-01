<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Savdo')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
    <nav class="bg-white dark:bg-gray-800 shadow-lg border-b-2 border-gray-100 dark:border-gray-700 transition-colors duration-300 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl sm:text-2xl font-extrabold bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-500 dark:from-primary-400 dark:via-secondary-400 dark:to-accent-400 bg-clip-text text-transparent hover:scale-105 transition-transform duration-200">
                        SAVDO
                    </a>
                </div>

                <!-- Desktop menu -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="relative text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium {{ request()->routeIs('home') ? 'text-primary-600 dark:text-primary-400 font-bold' : '' }} transition-all duration-200 px-3 py-2 rounded-lg {{ request()->routeIs('home') ? 'shadow-lg shadow-green-500/50 dark:shadow-green-400/50 bg-primary-50 dark:bg-primary-900/20' : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                        {{ __('messages.home') }}
                    </a>
                    <a href="{{ route('categories.index') }}" class="relative text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium {{ request()->routeIs('categories.*') ? 'text-primary-600 dark:text-primary-400 font-bold' : '' }} transition-all duration-200 px-3 py-2 rounded-lg {{ request()->routeIs('categories.*') ? 'shadow-lg shadow-green-500/50 dark:shadow-green-400/50 bg-primary-50 dark:bg-primary-900/20' : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                        {{ __('messages.categories') }}
                    </a>
                </div>

                <!-- O'ng taraf menu (Desktop) -->
                <div class="hidden md:flex items-center space-x-2 lg:space-x-4">
                    <!-- Til tanlash -->
                    <div class="flex items-center space-x-1 border-r border-gray-200 dark:border-gray-700 pr-4">
                        <a href="{{ route('locale.switch', 'uz') }}" class="px-3 py-1.5 rounded-lg text-sm font-medium transition-all duration-200 {{ session('locale', 'uz') == 'uz' ? 'bg-gradient-to-r from-primary-500 to-accent-500 text-white shadow-md shadow-green-500/50 dark:shadow-green-400/50' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">UZ</a>
                        <a href="{{ route('locale.switch', 'en') }}" class="px-3 py-1.5 rounded-lg text-sm font-medium transition-all duration-200 {{ session('locale') == 'en' ? 'bg-gradient-to-r from-primary-500 to-accent-500 text-white shadow-md shadow-green-500/50 dark:shadow-green-400/50' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">EN</a>
                        <a href="{{ route('locale.switch', 'ru') }}" class="px-3 py-1.5 rounded-lg text-sm font-medium transition-all duration-200 {{ session('locale') == 'ru' ? 'bg-gradient-to-r from-primary-500 to-accent-500 text-white shadow-md shadow-green-500/50 dark:shadow-green-400/50' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}">RU</a>
                    </div>

                    @auth
                        <!-- Admin panel -->
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="p-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 {{ request()->routeIs('admin.*') ? 'text-primary-600 dark:text-primary-400 shadow-lg shadow-green-500/50 dark:shadow-green-400/50' : '' }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </a>
                        @endif

                        <!-- Seller panel -->
                        @if(auth()->user()->isSeller())
                            <a href="{{ route('seller.products.index') }}" class="p-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-secondary-50 dark:hover:bg-secondary-900/20 hover:text-secondary-600 dark:hover:text-secondary-400 transition-all duration-200 {{ request()->routeIs('seller.*') ? 'shadow-lg shadow-green-500/50 dark:shadow-green-400/50' : '' }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </a>
                        @endif

                        <!-- Savat -->
                        <a href="{{ route('cart.index') }}" class="p-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-accent-50 dark:hover:bg-accent-900/20 hover:text-accent-600 dark:hover:text-accent-400 relative {{ request()->routeIs('cart.*') ? 'text-accent-600 dark:text-accent-400 shadow-lg shadow-green-500/50 dark:shadow-green-400/50' : '' }} transition-all duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            @if(auth()->user()->cartItems->count() > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ auth()->user()->cartItems->count() }}
                                </span>
                            @endif
                        </a>

                        <!-- Notifications -->
                        <div class="relative group">
                            <button id="notification-button" class="p-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 relative {{ request()->routeIs('notifications.*') ? 'shadow-lg shadow-green-500/50 dark:shadow-green-400/50' : '' }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                @php
                                    $unreadCount = auth()->user()->unreadNotifications->count();
                                @endphp
                                @if($unreadCount > 0)
                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold animate-pulse">
                                        {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                    </span>
                                @endif
                            </button>
                            <!-- Notification Dropdown -->
                            <div id="notification-dropdown" class="absolute right-0 mt-2 w-96 bg-white/95 dark:bg-gray-800/95 backdrop-blur-lg rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 hidden z-50 transform transition-all duration-200 max-h-[500px] overflow-y-auto">
                                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                                    <h3 class="font-bold text-gray-900 dark:text-white">🔔 {{ __('messages.notifications') }}</h3>
                                    @if($unreadCount > 0)
                                        <form action="{{ route('notifications.mark-all-read') }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-xs text-primary-600 dark:text-primary-400 hover:underline">
                                                {{ __('messages.mark_all_read') }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <div id="notification-list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse(auth()->user()->notifications->take(10) as $notification)
                                        <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors {{ $notification->read_at ? '' : 'bg-primary-50 dark:bg-primary-900/20' }}">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                        @if(isset($notification->data['message']))
                                                            {{ $notification->data['message'] }}
                                                        @else
                                                            Yangi xabarnoma
                                                        @endif
                                                    </p>
                                                    @if(isset($notification->data['order_number']))
                                                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                                            Buyurtma #{{ $notification->data['order_number'] }}
                                                        </p>
                                                    @endif
                                                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                                @if(!$notification->read_at)
                                                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="ml-2">
                                                        @csrf
                                                        <button type="submit" class="text-primary-600 dark:text-primary-400 text-xs">
                                                            ✓
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-8 text-center">
                                            <p class="text-gray-500 dark:text-gray-400">{{ __('messages.no_notifications') }}</p>
                                        </div>
                                    @endforelse
                                </div>
                                @if(auth()->user()->notifications->count() > 10)
                                    <div class="p-4 border-t border-gray-200 dark:border-gray-700 text-center">
                                        <a href="{{ route('notifications.index') }}" class="text-primary-600 dark:text-primary-400 hover:underline text-sm font-semibold">
                                            {{ __('messages.view_all') }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Profile -->
                        <a href="{{ route('profile.index') }}" class="p-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 {{ request()->routeIs('profile.*') ? 'text-primary-600 dark:text-primary-400 shadow-lg shadow-green-500/50 dark:shadow-green-400/50' : '' }} transition-all duration-200" title="{{ __('messages.profile') }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </a>
                        
                        <!-- Orders -->
                        <a href="{{ route('orders.index') }}" class="p-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-secondary-50 dark:hover:bg-secondary-900/20 hover:text-secondary-600 dark:hover:text-secondary-400 {{ request()->routeIs('orders.*') ? 'text-secondary-600 dark:text-secondary-400 shadow-lg shadow-green-500/50 dark:shadow-green-400/50' : '' }} transition-all duration-200" title="{{ __('messages.my_orders') }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </a>
                        
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="p-2 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-700 dark:hover:text-red-300 transition-all duration-200" title="{{ __('messages.logout') }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors duration-200 text-sm lg:text-base">{{ __('messages.login') }}</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-4 lg:px-6 py-2 lg:py-2.5 rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 text-sm lg:text-base">
                            {{ __('messages.register') }}
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center space-x-2">
                    @auth
                        <a href="{{ route('cart.index') }}" class="p-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-accent-50 dark:hover:bg-accent-900/20 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            @if(auth()->user()->cartItems->count() > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ auth()->user()->cartItems->count() }}
                                </span>
                            @endif
                        </a>
                    @endauth
                    <button id="mobile-menu-button" class="p-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 pt-2 border-t border-gray-200 dark:border-gray-700 mt-2">
                <div class="space-y-2">
                    <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 {{ request()->routeIs('home') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400 font-bold shadow-lg shadow-green-500/50 dark:shadow-green-400/50' : '' }}">
                        {{ __('messages.home') }}
                    </a>
                    <div class="px-4 py-2">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2 font-semibold">{{ __('messages.categories') }}:</p>
                        @if(isset($navbarCategories) && $navbarCategories->count() > 0)
                            <div class="space-y-1">
                                @foreach($navbarCategories->take(6) as $category)
                                    <a href="{{ route('categories.show', $category) }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all">
                                        <span class="text-sm">{{ $category->localized_name }}</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded-full">
                                            {{ $category->products_count }}
                                        </span>
                                    </a>
                                @endforeach
                                @if($navbarCategories->count() > 6)
                                    <a href="{{ route('categories.index') }}" class="block px-3 py-2 text-center text-sm font-semibold text-primary-600 dark:text-primary-400 rounded-lg hover:bg-primary-50 dark:hover:bg-primary-900/20 mt-2">
                                        Barchasi →
                                    </a>
                                @endif
                            </div>
                        @else
                            <a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm">
                                {{ __('messages.categories') }}
                            </a>
                        @endif
                    </div>
                    
                    <!-- Til tanlash (Mobile) -->
                    <div class="px-4 py-2">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">{{ __('messages.language') }}:</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('locale.switch', 'uz') }}" class="flex-1 text-center px-3 py-2 rounded-lg text-sm font-medium {{ session('locale', 'uz') == 'uz' ? 'bg-gradient-to-r from-primary-500 to-accent-500 text-white shadow-md' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }}">UZ</a>
                            <a href="{{ route('locale.switch', 'en') }}" class="flex-1 text-center px-3 py-2 rounded-lg text-sm font-medium {{ session('locale') == 'en' ? 'bg-gradient-to-r from-primary-500 to-accent-500 text-white shadow-md' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }}">EN</a>
                            <a href="{{ route('locale.switch', 'ru') }}" class="flex-1 text-center px-3 py-2 rounded-lg text-sm font-medium {{ session('locale') == 'ru' ? 'bg-gradient-to-r from-primary-500 to-accent-500 text-white shadow-md' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }}">RU</a>
                        </div>
                    </div>

                    @auth
                        <a href="{{ route('notifications.index') }}" class="flex items-center px-4 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 relative">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            {{ __('messages.notifications') }}
                            @php
                                $unreadCount = auth()->user()->unreadNotifications->count();
                            @endphp
                            @if($unreadCount > 0)
                                <span class="ml-auto bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                                    {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                </span>
                            @endif
                        </a>

                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Admin Panel
                            </a>
                        @endif
                        
                        @if(auth()->user()->isSeller())
                            <a href="{{ route('seller.products.index') }}" class="flex items-center px-4 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Seller Panel
                            </a>
                        @endif

                        <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ __('messages.profile') }}
                        </a>

                        <a href="{{ route('orders.index') }}" class="flex items-center px-4 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            {{ __('messages.my_orders') }}
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="px-4">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-2 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                {{ __('messages.logout') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-center rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            {{ __('messages.login') }}
                        </a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-center rounded-lg bg-gradient-to-r from-primary-600 to-secondary-600 text-white">
                            {{ __('messages.register') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Notification dropdown toggle
        const notificationButton = document.getElementById('notification-button');
        const notificationDropdown = document.getElementById('notification-dropdown');
        
        if (notificationButton && notificationDropdown) {
            notificationButton.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationDropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!notificationButton.contains(e.target) && !notificationDropdown.contains(e.target)) {
                    notificationDropdown.classList.add('hidden');
                }
            });
        }
    </script>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <main class="py-8">
        @yield('content')
    </main>

    <footer class="bg-gradient-to-r from-gray-900 via-slate-900 to-gray-900 dark:from-gray-950 dark:via-slate-950 dark:to-gray-950 text-white mt-12 py-8 border-t border-gray-700 dark:border-gray-800 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-gray-300">&copy; {{ date('Y') }} <span class="font-bold bg-gradient-to-r from-primary-400 to-accent-400 bg-clip-text text-transparent">SAVDO</span> - {{ __('messages.all_rights_reserved') }}</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-accent-400 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-secondary-400 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
