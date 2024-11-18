<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Workshop\WorkshopService;
use Illuminate\Http\Request;



class WorkshopsController extends Controller
{
    protected $workshopService;

    public function __construct(WorkshopService $workshopService)
    {
        $this->workshopService = $workshopService;

    }

    public function index(Request $request){
        return view('admin.workshops.index');
    }


}
