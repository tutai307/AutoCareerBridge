<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Services\Notification\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

/**
 * .
 *
 * @package App\Http\Controllers\
 * @author Nguyen Manh Hung
 * @access public
 * @see index()
 * @see destroy()
 * @see seen()
 */
class NotificationsController extends Controller
{

    protected $notificationsService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationsService = $notificationService;
    }

    public function index(Request $request)
    {

        if (!auth()->guard('admin')->user()) return redirect()->back();

        try {
            $notifications = $this->notificationsService->getNotifications();
            if ($request->ajax()) {
                return response()->json($notifications->items());
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => $e->getMessage()
                ]);
            }
            return redirect()->back()->with('status_fail', $e->getMessage());
        }

        return view('management.pages.notification.notification', compact('notifications'));
    }

    public function destroy($id)
    {
        try {
            $del = $this->notificationsService->delete($id);
            if (!$del) return response()->json(['error' => 'Xóa lỗi!']);
            return response()->json([
                'code' => 200,
                'message' => __('message.admin.delete_success')
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function seen(Request $request)
    {

        if (!auth()->guard('admin')->user()) return redirect()->back()->with('status_fail', 'Lỗi đăng nhập');

        $args = [];
        $user = auth()->guard('admin')->user();
        if ($user->role == ROLE_UNIVERSITY) {
            $args['university'] = $user->university->id;
        } elseif ($user->role == ROLE_COMPANY) {
            $args['company'] = $user->company->id;
        } else {
            return redirect()->back()->with('status_fail', 'Bạn không có quyền!');
        }
        if (isset($request->id)) {
            $args['id'] = $request->id;
        }
        try {
            $result = $this->notificationsService->seen($args);
            if (!$result) return redirect()->back()->with('status_fail', 'Cập nhật thất bại');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('status_fail', $e->getMessage());
        }
    }
}
