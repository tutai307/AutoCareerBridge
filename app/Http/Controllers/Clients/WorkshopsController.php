<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Services\Workshop\WorkshopService;
use Illuminate\Http\Request;

class WorkshopsController extends Controller
{
    protected $workShopService;
    public function __construct(WorkshopService $workShopService)
    {
        $this->workShopService = $workShopService;
    }
   public function index($slug)
   {
    $workshop = $this->workShopService->detailWorkShop($slug);
      return view('client.pages.workshop.detail',compact('workshop'));
   }
}
