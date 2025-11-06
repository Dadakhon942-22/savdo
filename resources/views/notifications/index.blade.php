@extends('layouts.app')

@section('title', __('messages.notifications'))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">🔔 {{ __('messages.notifications') }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">{{ __('messages.all_notifications') }}</p>
        </div>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                @csrf
                <button type="submit" class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 text-white px-4 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center gap-1.5 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('messages.mark_all_read') }}
                </button>
            </form>
        @endif
    </div>

    <div class="space-y-4">
        @forelse($notifications as $notification)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border-2 {{ $notification->read_at ? 'border-gray-200 dark:border-gray-700' : 'border-primary-300 dark:border-primary-700' }} overflow-hidden transition-all hover:shadow-xl">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-2">
                                @if(!$notification->read_at)
                                    <span class="w-2 h-2 bg-primary-600 rounded-full animate-pulse"></span>
                                @endif
                                <p class="text-base font-bold text-gray-900 dark:text-white">
                                    @if(isset($notification->data['message']))
                                        {{ $notification->data['message'] }}
                                    @else
                                        {{ __('messages.new_notification') }}
                                    @endif
                                </p>
                            </div>
                            
                            @if(isset($notification->data['order_number']))
                                <div class="ml-5 space-y-1">
                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        📦 {{ __('messages.order') }}: <span class="font-semibold">#{{ $notification->data['order_number'] }}</span>
                                    </p>
                                    @if(isset($notification->data['amount']))
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            💰 {{ __('messages.amount_label') }}: <span class="font-semibold">{{ number_format($notification->data['amount'], 0, ',', ' ') }} {{ __('messages.currency') }}</span>
                                        </p>
                                    @endif
                                    @if(isset($notification->data['status']))
                                        <p class="text-sm">
                                            {{ __('messages.status') }}: 
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                                @if($notification->data['status'] == 'completed') bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300
                                                @elseif($notification->data['status'] == 'processing') bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300
                                                @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300
                                                @endif">
                                                {{ __('messages.' . $notification->data['status']) }}
                                            </span>
                                        </p>
                                    @endif
                                </div>
                            @endif
                            
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-3 ml-5">
                                {{ $notification->created_at->format('d.m.Y H:i') }} • {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>
                        
                        <div class="flex items-center space-x-2 ml-4">
                            @if(!$notification->read_at)
                                <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-lg text-primary-600 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-all" title="{{ __('messages.mark_as_read') }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete_notification') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all" title="{{ __('messages.delete_notification') }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                <svg class="w-20 h-20 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <p class="text-xl font-semibold text-gray-700 dark:text-gray-300">{{ __('messages.no_notifications') }}</p>
                <p class="text-gray-500 dark:text-gray-400 mt-2">{{ __('messages.you_have_no_notifications') }}</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $notifications->links() }}
    </div>
</div>
@endsection

