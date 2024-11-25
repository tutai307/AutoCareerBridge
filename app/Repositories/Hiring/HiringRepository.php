<?php

namespace App\Repositories\Hiring;

use App\Models\Hiring;
use App\Models\User;
use App\Repositories\Hiring\HiringRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;

class HiringRepository implements HiringRepositoryInterface
{
    protected $model;
    protected $companyId;
    public function __construct(Hiring $model)
    {
        $this->model = $model;
    }


    public function getAllHirings($companyId)
    {
        $hirings = $this->model::with('user')->where('company_id', $companyId)
            ->paginate(LIMIT_10);
        return $hirings;
    }

    public function restoreUserHiring($userestore, $request)
    {
        $userestore->restore();
        $userestore->hirings()->restore();
        $userestore->update([
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(),
        ]);

        $avatarPath = $userestore->hirings()->first()->avatar_path ?? null;
        if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
            $avatarPath = $request->file('avatar_path')->store('hirings', 'public');
        }
        $this->model->where('user_id', $userestore->id)->update([
            'phone' => $request->phone,
            'name' => $request->full_name,
            'avatar_path' => $avatarPath,
        ]);

        return $userestore;
    }

    public function createHiring($request, $companyId)
    {
        $avatarPath = null;
        if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
            $avatarPath = $request->file('avatar_path')->store('hirings', 'public');
        }
        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(),
            'role' => ROLE_HIRING,
        ]);

        $this->model->create([
            'user_id' => $user->id,
            'company_id' => $companyId,
            'phone' => $request->phone,
            'name' => $request->full_name,
            'avatar_path' => $avatarPath,
        ]);
        return $user;
    }

    public function editHiring($userId)
    {
        $hiring = $this->model::with('user')->where('user_id', $userId)->first();
        return $hiring;
    }

    public function updateHiring($request, $userId)
    {
        $avatarPath = null;
        if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
            $avatarPath = $request->file('avatar_path')->store('academicAffairs', 'public');
        }
        $data = [
            'name' => $request->input('full_name'),
            'phone' => $request->input('phone'),
        ];
        if ($avatarPath) {
            $data['avatar_path'] = $avatarPath;
        }
        $this->model::where('user_id', $userId)->update($data);
    }

    public function deleteHiring($id)
    {
        $user = User::findOrFail($id);
        $user->hirings()->delete();
        $user->delete();
    }
    public function findHiring($request, $companyId)
    {
        $name = $request->searchName;
        $email = $request->searchEmail;
        $hirings = $this->model::with('user')->where('company_id', $companyId);
        if ($name) {
            $hirings->where('name', 'like', "%$name%");
        }
        if ($email) {
            $hirings->whereHas('user', function ($query) use ($email) {
                $query->where('email', 'like', "%$email%");
            });
        }
        return $hirings->paginate(LIMIT_10);
    }
}
