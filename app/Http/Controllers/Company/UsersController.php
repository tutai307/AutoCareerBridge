<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\User\UserService;
use Exception;
use Illuminate\Http\Request;
use Log;

/**
* UserController handles user management operations in the admin panel, including listing,
* creating, updating, and deleting user accounts.
*
* @package App\Http\Controllers\Admin
* @author Khuat Van Duy
* @access public
* @see index()
* @see create()
* @see store()
* @see edit()
* @see update()
* @see destroy()
*/

class UsersController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
    * Display a listing of the users with optional filters for search, role, active status, and date.
    *
    * @param Request $request The HTTP request instance, containing any filter parameters.
    * @return \Illuminate\View\View The view displaying the user list.
    *
    * @access public
    * @see UserService::getUsers()
    */
    
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'role', 'active', 'date']);
        $users = $this->userService->getUsers($filters);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $this->userService->createUser($request);
            return redirect()->route('admin.users.index')->with('status_success', 'Tạo tài khoản thành công');
        } catch (Exception $exception) {
            Log::error('Lỗi thêm mới tài khoản: ' . $exception->getMessage());
            return back()->with('error', 'Lỗi thêm mới tài khoản');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
