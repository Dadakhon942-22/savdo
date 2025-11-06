@extends('layouts.app')

@section('title', __('messages.profile'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="relative mb-8 md:mb-12">
        <!-- Pastki oyna -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-secondary-600 to-accent-600 rounded-3xl transform rotate-[-1deg] opacity-20 blur-md"></div>
        
        <!-- Asosiy oyna -->
        <div class="relative text-center py-8 md:py-12 px-4 md:px-6 rounded-2xl md:rounded-3xl bg-gradient-to-br from-primary-50 via-secondary-50 to-accent-50 dark:from-primary-900/30 dark:via-secondary-900/30 dark:to-accent-900/30 border-2 border-primary-200 dark:border-primary-700 shadow-xl">
            <div class="relative z-10">
                <div class="inline-block mb-4 transform hover:scale-110 transition-transform duration-300">
                    <svg class="w-16 h-16 md:w-20 md:h-20 text-primary-600 dark:text-primary-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold mb-3 md:mb-4 bg-gradient-to-r from-primary-600 via-secondary-600 to-accent-600 dark:from-primary-400 dark:via-secondary-400 dark:to-accent-400 bg-clip-text text-transparent drop-shadow-sm">
                    👤 {{ __('messages.profile') }}
                </h1>
                <p class="text-base md:text-xl text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.personal_info') }}</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-100 dark:bg-emerald-900/40 border-2 border-emerald-400 dark:border-emerald-700 text-emerald-800 dark:text-emerald-300 px-6 py-4 rounded-xl mb-6 font-extrabold shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bitta forma -->
    <div class="mb-8">
        <div class="relative">
            <!-- Pastki oyna -->
            <div class="absolute inset-0 bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 rounded-2xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            
            <!-- Asosiy oyna -->
            <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 md:p-8 border-2 border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-6">{{ __('messages.profile') }}</h2>
                
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Grid layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3">{{ __('messages.name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 font-bold @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3">{{ __('messages.email') }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-slate-900 dark:text-white bg-white dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 font-bold @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3">{{ __('messages.role') }}</label>
                            <div class="px-4 py-3 bg-gradient-to-r from-primary-50 to-secondary-50 dark:from-gray-900 dark:to-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700">
                                @if($user->isAdmin())
                                    <span class="text-purple-700 dark:text-purple-400 font-extrabold">{{ __('messages.admin_role') }}</span>
                                @elseif($user->isSeller())
                                    <span class="text-blue-700 dark:text-blue-400 font-extrabold">{{ __('messages.seller') }}</span>
                                @else
                                    <span class="text-green-700 dark:text-green-400 font-extrabold">{{ __('messages.customer') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t-2 border-gray-200 dark:border-gray-700 my-6"></div>

                    <!-- Password section -->
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-4">{{ __('messages.change_password') }} ({{ __('messages.optional') }})</h3>
                        <div class="space-y-6">
                            <div>
                                <label for="current_password" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3">{{ __('messages.current_password') }}</label>
                                <div class="relative">
                                    <input type="password" name="current_password" id="current_password" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 pr-12 text-slate-900 dark:text-white bg-white dark:bg-gray-700 focus:ring-2 focus:ring-green-500 focus:border-green-500 font-bold @error('current_password') border-red-500 @enderror">
                                    <button type="button" onclick="togglePassword('current_password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                        <svg id="current_password_eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="current_password_eye_off" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('current_password')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="new_password" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3">{{ __('messages.new_password') }}</label>
                                <div class="relative">
                                    <input type="password" name="new_password" id="new_password" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 pr-12 text-slate-900 dark:text-white bg-white dark:bg-gray-700 focus:ring-2 focus:ring-green-500 focus:border-green-500 font-bold @error('new_password') border-red-500 @enderror">
                                    <button type="button" onclick="togglePassword('new_password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                        <svg id="new_password_eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="new_password_eye_off" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('new_password')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-2 font-extrabold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="new_password_confirmation" class="block text-lg font-extrabold text-slate-900 dark:text-white mb-3">{{ __('messages.new_password_confirmation') }}</label>
                                <div class="relative">
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 pr-12 text-slate-900 dark:text-white bg-white dark:bg-gray-700 focus:ring-2 focus:ring-green-500 focus:border-green-500 font-bold">
                                    <button type="button" onclick="togglePassword('new_password_confirmation')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                        <svg id="new_password_confirmation_eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="new_password_confirmation_eye_off" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-6 py-4 rounded-xl font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            {{ __('messages.update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const eye = document.getElementById(id + '_eye');
            const eyeOff = document.getElementById(id + '_eye_off');
            
            if (input.type === 'password') {
                input.type = 'text';
                eye.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            } else {
                input.type = 'password';
                eye.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            }
        }
    </script>

    <!-- Statistika -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl shadow-lg p-6 border-2 border-blue-200 dark:border-blue-700 text-center">
                <svg class="w-16 h-16 mx-auto text-blue-600 dark:text-blue-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <h3 class="text-4xl font-extrabold text-slate-900 dark:text-white mb-2">{{ $user->orders->count() }}</h3>
                <p class="text-slate-700 dark:text-slate-300 font-extrabold">{{ __('messages.orders') }}</p>
            </div>
        </div>

        @if($user->isCustomer())
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-green-700 rounded-xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-gradient-to-br from-emerald-50 to-green-100 dark:from-emerald-900/30 dark:to-green-800/30 rounded-xl shadow-lg p-6 border-2 border-emerald-200 dark:border-emerald-700 text-center">
                <svg class="w-16 h-16 mx-auto text-emerald-600 dark:text-emerald-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3 class="text-4xl font-extrabold text-slate-900 dark:text-white mb-2">{{ $user->cartItems->count() }}</h3>
                <p class="text-slate-700 dark:text-slate-300 font-extrabold">{{ __('messages.cart') }}</p>
            </div>
        </div>
        @endif

        @if($user->isSeller())
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-violet-700 rounded-xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl shadow-lg p-6 border-2 border-purple-200 dark:border-purple-700 text-center">
                <svg class="w-16 h-16 mx-auto text-purple-600 dark:text-purple-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="text-4xl font-extrabold text-slate-900 dark:text-white mb-2">{{ $user->products->count() }}</h3>
                <p class="text-slate-700 dark:text-slate-300 font-extrabold">{{ __('messages.products') }}</p>
            </div>
        </div>
        @endif

        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500 to-amber-700 rounded-xl transform rotate-[-1deg] opacity-10 blur-sm"></div>
            <div class="relative bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/30 dark:to-orange-800/30 rounded-xl shadow-lg p-6 border-2 border-orange-200 dark:border-orange-700 text-center">
                <svg class="w-16 h-16 mx-auto text-orange-600 dark:text-orange-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-sm font-extrabold text-slate-900 dark:text-white mb-2">{{ $user->created_at->format('d.m.Y') }}</h3>
                <p class="text-slate-700 dark:text-slate-300 font-extrabold">{{ __('messages.register') }}</p>
            </div>
        </div>
    </div>

    <!-- Mening Buyurtmalarim (faqat customer uchun) -->
    @if(auth()->user()->isCustomer())
    <div class="relative mb-8">
        <!-- Pastki oyna -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-500 via-secondary-500 to-accent-500 rounded-3xl transform rotate-[-1deg] opacity-10 blur-md"></div>
        
        <!-- Asosiy oyna -->
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 md:p-8 border-2 border-gray-200 dark:border-gray-700">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
                <div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-2">
                        📦 {{ __('messages.my_orders') }}
                    </h2>
                    <p class="text-lg text-slate-700 dark:text-slate-300 font-bold">{{ __('messages.all_orders') }}</p>
                </div>
                @if($orders->count() > 0)
                    <a href="{{ route('orders.index') }}" class="bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-6 py-3 rounded-xl font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        {{ __('messages.view_all') }}
                    </a>
                @endif
            </div>

            @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                <div class="relative bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-900/50 dark:to-gray-800/50 rounded-xl p-4 md:p-6 border-2 border-gray-200 dark:border-gray-700 hover:shadow-lg transition-all duration-300">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <div class="flex-1">
                            <h3 class="text-xl md:text-2xl font-extrabold text-slate-900 dark:text-white mb-2">{{ __('messages.order_number', ['number' => $order->order_number]) }}</h3>
                            <div class="flex items-center text-slate-700 dark:text-slate-300 font-bold mb-3">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $order->created_at->format('d.m.Y H:i') }}
                            </div>
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach($order->items->take(3) as $item)
                                <span class="inline-flex items-center px-3 py-1 bg-white dark:bg-gray-800 rounded-lg text-sm font-bold text-slate-700 dark:text-slate-300 border border-gray-200 dark:border-gray-700">
                                    {{ $item->product_name }} x {{ $item->quantity }}
                                </span>
                                @endforeach
                                @if($order->items->count() > 3)
                                <span class="inline-flex items-center px-3 py-1 bg-primary-100 dark:bg-primary-900/40 rounded-lg text-sm font-extrabold text-primary-700 dark:text-primary-300">
                                    +{{ $order->items->count() - 3 }} {{ __('messages.more') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-left md:text-right">
                            <span class="inline-block px-4 py-2 rounded-xl text-sm font-extrabold mb-3
                                @if($order->status == 'completed') bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-300
                                @elseif($order->status == 'processing') bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300
                                @elseif($order->status == 'cancelled') bg-rose-100 dark:bg-rose-900/40 text-rose-800 dark:text-rose-300
                                @else bg-yellow-100 dark:bg-yellow-900/40 text-yellow-800 dark:text-yellow-300
                                @endif">
                                {{ __('messages.' . $order->status) }}
                            </span>
                            <p class="text-2xl font-extrabold text-primary-600 dark:text-primary-400">{{ number_format($order->total, 0, ',', ' ') }} {{ __('messages.currency') }}</p>
                            <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center mt-3 text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-extrabold transition-colors">
                                {{ __('messages.view_details') }}
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <p class="text-xl font-extrabold text-slate-700 dark:text-slate-300 mb-4">{{ __('messages.no_orders') }}</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-6 py-3 rounded-xl font-extrabold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    {{ __('messages.products') }}
                </a>
            </div>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection
