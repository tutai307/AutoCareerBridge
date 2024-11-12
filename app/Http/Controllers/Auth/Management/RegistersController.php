<?php

namespace App\Http\Controllers\Auth\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Managements\AuthService;
use App\Http\Requests\Auth\RegisterRequest;

class RegistersController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function viewResgister()
    {
        return view('management.auth.register');
    }

    // public function postResgister(RegisterRequest $request)
    public function postResgister(Request $request)
    {
        $data = $request->all();
        $this->authService->register($data);


        return "Thành công";
        // return redirect()->route('management.login');
    }
}
