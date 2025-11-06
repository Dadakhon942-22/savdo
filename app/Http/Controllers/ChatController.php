<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Chat sahifasini ko'rsatish
     */
    public function index()
    {
        $user = Auth::user();
        
        // Umumiy unread count (navbar uchun)
        $totalUnreadCount = 0;
        
        // Agar admin bo'lsa, barcha customer va seller lar bilan chat
        if ($user->isAdmin()) {
            // Admin uchun barcha customer va seller lar
            $conversations = User::where('id', '!=', $user->id)
                ->whereIn('role', ['customer', 'seller'])
                ->get()
                ->map(function($conversationUser) use ($user, &$totalUnreadCount) {
                    $unreadCount = Message::where('from_user_id', $conversationUser->id)
                        ->where('to_user_id', $user->id)
                        ->whereNull('read_at')
                        ->count();
                    $conversationUser->unread_count = $unreadCount;
                    $totalUnreadCount += $unreadCount;
                    return $conversationUser;
                })
                ->sortBy('name')
                ->values();
        } else {
            // Customer/Seller uchun faqat admin bilan chat
            $admin = User::where('role', 'admin')->first();
            $conversations = collect();
            if ($admin) {
                $unreadCount = Message::where('from_user_id', $admin->id)
                    ->where('to_user_id', $user->id)
                    ->whereNull('read_at')
                    ->count();
                $admin->unread_count = $unreadCount;
                $totalUnreadCount = $unreadCount;
                $conversations->push($admin);
            }
        }
        
        return view('chat.index', compact('conversations', 'totalUnreadCount'));
    }

    /**
     * Xabarlarni olish (AJAX)
     */
    public function getMessages(Request $request)
    {
        $user = Auth::user();
        $otherUserId = $request->input('user_id');
        $markAsRead = $request->input('mark_as_read', false); // Chat'ga kirilganligini belgilash
        
        if (!$otherUserId) {
            return response()->json(['error' => 'User ID required'], 400);
        }

        // Faqat admin yoki customer/seller bilan muloqot qilish mumkin
        $otherUser = User::findOrFail($otherUserId);
        
        if ($user->isAdmin()) {
            // Admin faqat customer/seller bilan chat qiladi
            if (!in_array($otherUser->role, ['customer', 'seller'])) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        } else {
            // Customer/Seller faqat admin bilan chat qiladi
            if (!$otherUser->isAdmin()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        // Xabarlarni olish
        $messages = Message::where(function($query) use ($user, $otherUserId) {
                $query->where('from_user_id', $user->id)
                      ->where('to_user_id', $otherUserId);
            })
            ->orWhere(function($query) use ($user, $otherUserId) {
                $query->where('from_user_id', $otherUserId)
                      ->where('to_user_id', $user->id);
            })
            ->with(['fromUser', 'toUser'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Faqat chat'ga kirilganda (mark_as_read = true bo'lganda) o'qilgan deb belgilash
        if ($markAsRead) {
            Message::where('from_user_id', $otherUserId)
                ->where('to_user_id', $user->id)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);

            // Yangilangan xabarlarni qayta yuklash
            $messages = Message::where(function($query) use ($user, $otherUserId) {
                    $query->where('from_user_id', $user->id)
                          ->where('to_user_id', $otherUserId);
                })
                ->orWhere(function($query) use ($user, $otherUserId) {
                    $query->where('from_user_id', $otherUserId)
                          ->where('to_user_id', $user->id);
                })
                ->with(['fromUser', 'toUser'])
                ->orderBy('created_at', 'asc')
                ->get();
        }

        return response()->json([
            'messages' => $messages,
            'other_user' => $otherUser
        ]);
    }

    /**
     * Xabar yuborish
     */
    public function send(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:5000',
        ]);

        $user = Auth::user();
        $otherUser = User::findOrFail($request->to_user_id);

        // Faqat admin yoki customer/seller bilan muloqot qilish mumkin
        if ($user->isAdmin()) {
            if (!in_array($otherUser->role, ['customer', 'seller'])) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        } else {
            if (!$otherUser->isAdmin()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        $message = Message::create([
            'from_user_id' => $user->id,
            'to_user_id' => $request->to_user_id,
            'message' => $request->message,
        ]);

        $message->load(['fromUser', 'toUser']);

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    /**
     * Xabarlarni o'qilgan deb belgilash
     */
    public function markAsRead(Request $request)
    {
        $user = Auth::user();
        $fromUserId = $request->input('from_user_id');

        Message::where('from_user_id', $fromUserId)
            ->where('to_user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }
}
