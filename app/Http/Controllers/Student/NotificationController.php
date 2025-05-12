<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $student_id = Auth::guard('student')->user()->id;
        $notifications = StudentNotification::where('student_id', $student_id)
                                         ->orderBy('created_at', 'desc')
                                         ->take(10)
                                         ->get()
                                         ->map(function ($notification) {
                                             return [
                                                 'id' => $notification->id,
                                                 'title' => $notification->title,
                                                 'content' => $notification->content,
                                                 'is_read' => $notification->is_read,
                                                 'action_url' => $notification->action_url,
                                                 'created_at' => $notification->created_at->format('d/m/Y H:i'),
                                                 'metadata' => $notification->metadata
                                             ];
                                         });

        $unreadCount = StudentNotification::where('student_id', $student_id)
                                       ->where('is_read', false)
                                       ->count();

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }

    public function markAsRead(Request $request)
    {
        $student_id = Auth::guard('student')->user()->id;

        if ($request->notification_id) {
            // Đánh dấu một thông báo cụ thể
            StudentNotification::where('id', $request->notification_id)
                             ->where('student_id', $student_id)
                             ->update(['is_read' => true]);
        } else {
            // Đánh dấu tất cả là đã đọc
            StudentNotification::where('student_id', $student_id)
                             ->update(['is_read' => true]);
        }

        return response()->json(['success' => true]);
    }
}
