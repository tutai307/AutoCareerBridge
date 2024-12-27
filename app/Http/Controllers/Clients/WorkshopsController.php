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
    $data = $this->workShopService->detailWorkShop($slug);
    $workshop = $data[0];
    $countCompany = $data[1];     
   return view('client.pages.workshop.detail',compact('workshop', 'countCompany'));
   }
}
