<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
