<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollabRequest;
use App\Services\Collaboration\CollaborationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $activeTab = $request->input('active_tab', 'accept');
        $page = $request->input('page', 1);
        $search = $request->input('search');
//        $dateRange = $request->input('date_range');

        if ($search) {
            $data = $this->collaborationService->searchAllCollaborations($search, $page);
// if ($search || $dateRange) {
//            $data = $this->collaborationService->searchAllCollaborations($search, $dateRange, $page);

            if ($request->ajax()) {
                return view('management.pages.company.collaboration.table', [
                    'data' => $data['data'],
                    'status' => 'Search Results',
                    'isSearchResult' => true
                ]);
            }

            return view('management.pages.company.collaboration.index', [
                'data' => $data['data'],
                'accepted' => collect(),
                'pendingRequests' => collect(),
                'rejected' => collect(),
                'activeTab' => 'search',
                'isSearchResult' => true
            ]);
        }

        // Nếu không có tìm kiếm, thực hiện như bình thường
        $data = $this->collaborationService->getIndexService($activeTab, $page);
        if ($request->ajax()) {
            return view('management.pages.company.collaboration.table', ['data' => $data['data'], 'status' => $data['status']]);
        }

        return view('management.pages.company.collaboration.index', [
            'pendingRequests' => $data['pending'],
            'accepted' => $data['accepted'],
            'rejected' => $data['rejected'],
            'activeTab' => $activeTab,
            'data' => $data['data'],
        ]);
    }

    public function createRequest(CollabRequest $request)
    {
        $data = $request->only(['university_id', 'title', 'content']);

        $this->collaborationService->sendCollaborationEmail($data);
        return response()->json(['message' => 'Request sent successfully'], 201);
    }

}
