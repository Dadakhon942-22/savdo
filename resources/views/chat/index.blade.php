@extends('layouts.app')

@section('title', __('messages.chat'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-[calc(100vh-200px)]">
        <!-- Foydalanuvchilar ro'yxati (Desktop) -->
        <div class="hidden lg:block bg-white dark:bg-gray-800 rounded-xl shadow-2xl border-2 border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-primary-50 to-secondary-50 dark:from-primary-900/30 dark:to-secondary-900/30">
                <h2 class="text-xl font-extrabold text-slate-900 dark:text-white">
                    💬 {{ auth()->user()->isAdmin() ? __('messages.users') : __('messages.admin') }}
                </h2>
            </div>
            <div class="overflow-y-auto h-[calc(100%-80px)] p-2">
                @foreach($conversations as $conversation)
                <div class="chat-user-item cursor-pointer p-3 rounded-lg mb-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ $conversation->id == (request()->get('user_id') ?? 0) ? 'bg-primary-50 dark:bg-primary-900/30 border-2 border-primary-500' : '' }}" 
                     data-user-id="{{ $conversation->id }}" 
                     onclick="selectUser({{ $conversation->id }}, '{{ $conversation->name }}', '{{ $conversation->role }}')">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($conversation->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 dark:text-white">{{ $conversation->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    @if($conversation->role == 'admin')
                                        {{ __('messages.admin') }}
                                    @elseif($conversation->role == 'seller')
                                        {{ __('messages.seller') }}
                                    @else
                                        {{ __('messages.customer') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if(isset($conversation->unread_count) && $conversation->unread_count > 0)
                        <span class="unread-badge bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                            {{ $conversation->unread_count > 9 ? '9+' : $conversation->unread_count }}
                        </span>
                        @else
                        <span class="unread-badge bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold hidden">
                            0
                        </span>
                        @endif
                    </div>
                </div>
                @endforeach
                @if($conversations->isEmpty())
                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <p>{{ __('messages.no_conversations') }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Chat oynasi -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border-2 border-gray-200 dark:border-gray-700 flex flex-col overflow-hidden">
            <!-- Chat header -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-primary-50 to-secondary-50 dark:from-primary-900/30 dark:to-secondary-900/30">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div id="chat-user-avatar" class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold hidden">
                            A
                        </div>
                        <div>
                            <h3 id="chat-user-name" class="text-lg font-extrabold text-slate-900 dark:text-white">
                                {{ __('messages.select_user') }}
                            </h3>
                            <p id="chat-user-role" class="text-xs text-gray-500 dark:text-gray-400"></p>
                        </div>
                    </div>
                    <!-- Mobile menu toggle -->
                    <button onclick="toggleMobileUserList()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Xabarlar oynasi -->
            <div id="messages-container" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 dark:bg-gray-900/50">
                <div class="text-center text-gray-500 dark:text-gray-400 py-8">
                    {{ __('messages.select_user_to_chat') }}
                </div>
            </div>

            <!-- Xabar yuborish formasi -->
            <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <form id="message-form" class="flex gap-2">
                    <input type="hidden" id="to-user-id" name="to_user_id">
                    <input type="text" 
                           id="message-input" 
                           name="message" 
                           placeholder="{{ __('messages.type_message') }}" 
                           class="flex-1 border-2 border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           required
                           disabled>
                    <button type="submit" 
                            id="send-button"
                            class="bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white px-6 py-2 rounded-lg font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                        {{ __('messages.send') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Mobile user list (overlay) -->
    <div id="mobile-user-list" class="lg:hidden fixed inset-0 bg-black/50 z-50 hidden" onclick="toggleMobileUserList()">
        <div class="absolute right-0 top-0 bottom-0 w-80 bg-white dark:bg-gray-800 shadow-2xl overflow-y-auto" onclick="event.stopPropagation()">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-primary-50 to-secondary-50 dark:from-primary-900/30 dark:to-secondary-900/30 flex items-center justify-between">
                <h2 class="text-xl font-extrabold text-slate-900 dark:text-white">
                    💬 {{ auth()->user()->isAdmin() ? __('messages.users') : __('messages.admin') }}
                </h2>
                <button onclick="toggleMobileUserList()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-2">
                @foreach($conversations as $conversation)
                <div class="chat-user-item cursor-pointer p-3 rounded-lg mb-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" 
                     data-user-id="{{ $conversation->id }}" 
                     onclick="selectUser({{ $conversation->id }}, '{{ $conversation->name }}', '{{ $conversation->role }}'); toggleMobileUserList();">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($conversation->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 dark:text-white">{{ $conversation->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    @if($conversation->role == 'admin')
                                        {{ __('messages.admin') }}
                                    @elseif($conversation->role == 'seller')
                                        {{ __('messages.seller') }}
                                    @else
                                        {{ __('messages.customer') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if(isset($conversation->unread_count) && $conversation->unread_count > 0)
                        <span class="unread-badge bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                            {{ $conversation->unread_count > 9 ? '9+' : $conversation->unread_count }}
                        </span>
                        @else
                        <span class="unread-badge bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold hidden">
                            0
                        </span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
let currentUserId = null;
let messageInterval = null;

function toggleMobileUserList() {
    document.getElementById('mobile-user-list').classList.toggle('hidden');
}

function selectUser(userId, userName, userRole) {
    currentUserId = userId;
    
    // UI yangilash
    document.getElementById('to-user-id').value = userId;
    document.getElementById('chat-user-name').textContent = userName;
    document.getElementById('chat-user-avatar').textContent = userName.charAt(0).toUpperCase();
    document.getElementById('chat-user-avatar').classList.remove('hidden');
    
    const roleText = {
        'admin': '{{ __('messages.admin') }}',
        'seller': '{{ __('messages.seller') }}',
        'customer': '{{ __('messages.customer') }}'
    };
    document.getElementById('chat-user-role').textContent = roleText[userRole] || '';
    
    // Formani yoqish
    document.getElementById('message-input').disabled = false;
    document.getElementById('send-button').disabled = false;
    
    // Xabarlarni yuklash va o'qilgan deb belgilash (chat'ga kirilganda)
    loadMessages(userId, true); // markAsRead = true
    
    // Avtomatik yangilanish (keyingi yuklashlarda o'qilgan deb belgilanmaydi)
    if (messageInterval) {
        clearInterval(messageInterval);
    }
    messageInterval = setInterval(() => {
        if (currentUserId) {
            loadMessages(currentUserId, false); // markAsRead = false (avtomatik yangilanishda)
        }
        updateUnreadCounts();
    }, 2000);
    
    // Birinchi marta yuklash
    updateUnreadCounts();
}

// Sahifa yuklanganda va har 3 soniyada navbar badge'ni yangilash
document.addEventListener('DOMContentLoaded', function() {
    updateUnreadCounts();
    setInterval(updateUnreadCounts, 3000);
});

function loadMessages(userId, markAsRead = false) {
    const url = `{{ route('chat.messages') }}?user_id=${userId}${markAsRead ? '&mark_as_read=true' : ''}`;
    fetch(url, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.messages) {
            displayMessages(data.messages);
            // Unread count yangilash
            updateUnreadCounts();
        }
    })
    .catch(error => console.error('Error:', error));
}

function displayMessages(messages) {
    const container = document.getElementById('messages-container');
    container.innerHTML = '';
    const currentUserId = {{ auth()->id() ?: 'null' }};
    
    messages.forEach(message => {
        const isFromMe = message.from_user_id == currentUserId;
        const isRead = message.read_at !== null;
        const messageDiv = document.createElement('div');
        
        // O'zi yozgan xabarlar o'ngda, kelgan xabarlar chapda
        messageDiv.className = `flex ${isFromMe ? 'justify-end' : 'justify-start'} mb-3`;
        
        // O'qilgan/o'qilmagan holatiga qarab dizayn
        let messageClass = '';
        let readIndicator = '';
        
        if (isFromMe) {
            // Men yuborgan xabar (o'ng taraf)
            if (isRead) {
                // O'qilgan - yashil rang, 2 ta checkmark bilan (✓✓)
                messageClass = 'bg-gradient-to-r from-green-500 to-emerald-500 text-white';
                readIndicator = '<svg class="w-3.5 h-3.5 inline ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg><svg class="w-3.5 h-3.5 inline ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg>';
            } else {
                // O'qilmagan - oddiy rang, 1 ta checkmark bilan (✓)
                messageClass = 'bg-gradient-to-r from-primary-600 to-secondary-600 text-white';
                readIndicator = '<svg class="w-3.5 h-3.5 inline ml-1 opacity-70" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg>';
            }
        } else {
            // Men olgan xabar (chap taraf)
            if (isRead) {
                // O'qilgan - oddiy rang
                messageClass = 'bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-2 border-gray-200 dark:border-gray-600';
            } else {
                // O'qilmagan - yorqin rang, animatsiya
                messageClass = 'bg-blue-100 dark:bg-blue-900/50 text-gray-900 dark:text-white border-2 border-blue-400 dark:border-blue-500 shadow-lg ring-2 ring-blue-300 dark:ring-blue-600 animate-pulse';
            }
        }
        
        messageDiv.innerHTML = `
            <div class="max-w-xs lg:max-w-md px-4 py-2.5 rounded-xl ${messageClass} ${isFromMe ? 'rounded-tr-none' : 'rounded-tl-none'}">
                <p class="text-sm font-medium break-words">${escapeHtml(message.message)}</p>
                <div class="flex items-center justify-between mt-1.5">
                    <p class="text-xs ${isFromMe ? 'text-white/80' : 'text-gray-500 dark:text-gray-400'}">
                        ${new Date(message.created_at).toLocaleTimeString('uz-UZ', {hour: '2-digit', minute: '2-digit'})}
                    </p>
                    ${isFromMe ? `<span class="text-xs ml-2">${readIndicator}</span>` : ''}
                </div>
            </div>
        `;
        container.appendChild(messageDiv);
    });
    
    container.scrollTop = container.scrollHeight;
    
    // O'qilmagan xabarlar sonini yangilash
    updateUnreadCounts();
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function updateUnreadCounts() {
    const currentUserId = {{ auth()->id() ?: 'null' }};
    let totalUnread = 0;
    
    document.querySelectorAll('.chat-user-item').forEach(item => {
        const userId = item.dataset.userId;
        
        fetch(`{{ route('chat.messages') }}?user_id=${userId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.messages) {
                const unreadCount = data.messages.filter(m => 
                    m.to_user_id == currentUserId && !m.read_at
                ).length;
                
                totalUnread += unreadCount;
                
                // Badge ni topish va yangilash
                let badge = item.querySelector('.unread-badge');
                
                if (unreadCount > 0) {
                    if (!badge) {
                        // Badge yo'q bo'lsa yaratish
                        badge = document.createElement('span');
                        badge.className = 'unread-badge bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold';
                        const userInfo = item.querySelector('.flex.items-center.justify-between');
                        if (userInfo) {
                            userInfo.appendChild(badge);
                        }
                    }
                    badge.textContent = unreadCount > 9 ? '9+' : unreadCount;
                    badge.style.display = 'flex';
                } else {
                    // Badge bor bo'lsa yashirish
                    if (badge) {
                        badge.style.display = 'none';
                    }
                }
                
                // Navbar badge'ni yangilash
                updateNavbarBadge(totalUnread);
            }
        })
        .catch(error => console.error('Error updating unread count:', error));
    });
    
    // Navbar badge'ni yangilash (agar xabarlar bo'lmasa)
    updateNavbarBadge(totalUnread);
}

function updateNavbarBadge(totalUnread) {
    // Desktop navbar badge
    const desktopBadge = document.getElementById('chat-unread-badge');
    if (desktopBadge) {
        if (totalUnread > 0) {
            desktopBadge.textContent = totalUnread > 9 ? '9+' : totalUnread;
            desktopBadge.classList.remove('hidden');
        } else {
            desktopBadge.classList.add('hidden');
        }
    }
    
    // Mobile navbar badge
    const mobileBadge = document.getElementById('chat-unread-badge-mobile');
    if (mobileBadge) {
        if (totalUnread > 0) {
            mobileBadge.textContent = totalUnread > 9 ? '9+' : totalUnread;
            mobileBadge.classList.remove('hidden');
        } else {
            mobileBadge.classList.add('hidden');
        }
    }
}

// Xabar yuborish
document.getElementById('message-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const messageInput = document.getElementById('message-input');
    const toUserId = document.getElementById('to-user-id').value;
    const message = messageInput.value.trim();
    
    if (!message || !toUserId) return;
    
    fetch('{{ route('chat.send') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            to_user_id: toUserId,
            message: message
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            messageInput.value = '';
            loadMessages(toUserId, false); // markAsRead = false (yangi yuborilgan xabar o'qilgan deb belgilanmaydi)
            updateUnreadCounts();
        }
    })
    .catch(error => console.error('Error:', error));
});

// Enter tugmasi bilan yuborish
document.getElementById('message-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        document.getElementById('message-form').dispatchEvent(new Event('submit'));
    }
});
</script>
@endsection

