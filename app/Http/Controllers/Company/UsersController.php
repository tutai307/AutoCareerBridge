<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\User\UserService;
use Exception;
use Hash;
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
     * Show the form for creating a new user account.
     *
     * @return \Illuminate\View\View The view displaying the form for creating a new user.
     *
     * @access public
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in the storage.
     *
     * This method processes the data from the request to create a new user. 
     * On success, redirects to the user list with a success message; otherwise, 
     * logs an error and redirects back with an error message.
     *
     * @param UserRequest $request The HTTP request instance with validated user data.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the user list.
     *
     * @access public
     * @throws Exception If user creation fails.
     * @see UserService::createUser()
     */
    public function store(UserRequest $request)
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
     * Show the form for editing the specified user account.
     *
     * @param User $user The user instance to edit, injected via route model binding.
     * @return \Illuminate\View\View The view displaying the edit user form.
     *
     * @access public
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user account in the storage.
     *
     * This method processes the data from the request to update the user account.
     * If successful, it redirects back with a success message; otherwise, it logs
     * an error and redirects back with an error message.
     *
     * @param UserRequest $request The HTTP request instance with validated data.
     * @param string $id The ID of the user to update.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the previous page.
     *
     * @access public
     * @throws Exception If user update fails.
     * @see UserService::updateUser()
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->except('password');
        $data['active'] = $request->has('active') ? ACTIVE : INACTIVE;

        if ($request->has('password')) {
            $data['password'] = Hash::make($request['password']);
        }

        try {
            $this->userService->updateUser($id, $data);
            return back()->with('status_success', 'Cập nhật tài khoản thành công');
        } catch (Exception $exception) {
            Log::error('Lỗi sửa tài khoản: ' . $exception->getMessage());
            return back()->with('error', 'Lỗi sửa tài khoản');
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * This method deletes a user record from the database by its ID.
     * If the deletion is successful, it redirects back with a success message.
     * If an error occurs, it logs the error and redirects back with an error message.
     *
     * @param User $user The user object to be deleted.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a status message.
     *
     * @throws \Exception If there is an error during deletion.
     *
     * @access public
     * @see UserService::deleteUser()
     */
    public function destroy(User $user)
    {
        try {
            $userExists = $this->userService->getUserById($user->id);
            if (!$userExists ) {
                return back()->with('error', 'Tài khoản không tồn tại');
            }
            $this->userService->deleteUser($user->id);
            return back()->with('status_success', 'Xóa tài khoản thành công');
        } catch (Exception $exception) {
            Log::error('Lỗi xóa tài khoản: ' . $exception->getMessage());
            return back()->with('error', 'Lỗi xóa tài khoản');
        }
    }
}
