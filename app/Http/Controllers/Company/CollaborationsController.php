<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\Collaboration\CollaborationService;
use Illuminate\Http\Request;

class CollaborationsController extends Controller
{
    protected $collaborationService;

    public function __construct(CollaborationService $collaborationService)
    {
        $this->collaborationService = $collaborationService;
    }

    public function index()
    {
        $activeShips = $this->collaborationService->getShipsByStatus(4);
        $pendingRequests = $this->collaborationService->getShipsByStatus(1);
        $acceptedShips = $this->collaborationService->getShipsByStatus(2);
        $rejectedShips = $this->collaborationService->getShipsByStatus(3);
        return view('management.pages.company.collaboration.index', compact(
            'activeShips',
            'pendingRequests',
            'acceptedShips',
            'rejectedShips'
        ));
    }
}
