<?php

namespace App\Http\Controllers\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class JobsController extends Controller
{
    public function show($id){
        return view('management.pages.university.jobs.jobDetail');
    }
}
