<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    public function read($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        
        return back()->with('success', 'Xabarnoma o\'qilgan deb belgilandi');
    }

    public function markAllRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        
        return back()->with('success', 'Barcha xabarnomalar o\'qilgan deb belgilandi');
    }

    public function destroy($id)
    {
        auth()->user()->notifications()->findOrFail($id)->delete();
        
        return back()->with('success', 'Xabarnoma o\'chirildi');
    }
}
