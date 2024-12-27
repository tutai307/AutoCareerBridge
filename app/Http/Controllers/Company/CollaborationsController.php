<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollabRequest;
use App\Services\Collaboration\CollaborationService;
use Illuminate\Http\Request;

/**
 * CollaborationsController handles collaboration management,
 * @author Hoang Duy Lap
 * @access public
 * @package Collaboration
 * @see index()
 */
class CollaborationsController extends Controller
{
    protected $collaborationService;

    public function __construct(CollaborationService $collaborationService)
    {
        $this->collaborationService = $collaborationService;
    }

    public function index(Request $request)
    {
        $activeTab = $request->input('active_tab', 'receive');

        $search = $request->input('search', null);
        $dateRange = $request->input('date_range', null);
        if ($search || $dateRange) {
            $data = $this->collaborationService->searchAllCollaborations($search, $dateRange);

            if ($request->ajax()) {
                return view('management.pages.company.collaboration.table', [
                    'data' => $data['data'],
                    'status' => 'Search Results',
                    'isSearchResult' => true
                ]);
            }

            return view('management.pages.company.collaboration.index', [
                'data' => $data['data'],
                'receivedRequests' => collect(),
                'accepted' => collect(),
                'pendingRequests' => collect(),
                'rejected' => collect(),
                'completed' => collect(),
                'activeTab' => 'search',
                'isSearchResult' => true
            ]);
        }

        // Nếu không có tìm kiếm, thực hiện như bình thường
        $data = $this->collaborationService->getIndexService($activeTab);
        if ($request->ajax()) {
            return view('management.pages.company.collaboration.table', ['data' => $data['data'], 'status' => $data['status']]);
        }

        return view('management.pages.company.collaboration.index', [
            'receivedRequests' => $data['received'],
            'pendingRequests' => $data['pending'],
            'accepted' => $data['accepted'],
            'rejected' => $data['rejected'],
            'completed' => $data['completed'],
            'activeTab' => $activeTab,
            'data' => $data['data'],
        ]);
    }

    public function createRequest(CollabRequest $request)
    {
        $data = $request->only(['university_id', 'title', 'content', 'end_date']);
        try {
            $this->collaborationService->sendCollaborationEmail($data);
            return response()->json(['error' => false, 'message' => 'Request sent successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            $data = $this->collaborationService->changeStatus($request->only('id', 'status', 'res_message'));
            if (isset($data)) {
                return back()->with('status_success', __('message.university.collaboration.change_status_success'));
            } else {
                return back()->with('status_fail', __('message.university.collaboration.change_status_fail'));
            }
        } catch (\Exception $e) {
            return back()->with('status_fail', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $data = $this->collaborationService->findById($id);
            if (!$data) {
                return back()->with('status_fail', __('message.company.collaboration.not_found'));
            }
            if ($data->created_by != auth('admin')->user()->role) {
                return back()->with('status_fail', __('message.company.collaboration.not_permission'));
            }
            $data->delete();
            return back()->with('status_success', __('message.company.collaboration.revoke_success'));
        } catch (\Exception $e) {
            return back()->with('status_fail', $e->getMessage());
        }
    }
}
