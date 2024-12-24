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
use Illuminate\Support\Facades\Storage;

class HiringRepository implements HiringRepositoryInterface
{
    protected $model;
    protected $companyId;
    public function __construct(Hiring $model)
    {
        $this->model = $model;
    }


    public function getHirings($request, $companyId)
    {
        $search = $request->search;
        $date =$request->date;
        $hirings = $this->model::with('user')->where('company_id', $companyId)->orderBy('created_at', 'desc');
        if ($search) {
            $hirings->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%") 
                      ->orWhereHas('user', function ($userQuery) use ($search) {
                          $userQuery->where('email', 'like', "%$search%"); 
                      });
            });
        }
        if ($date) {
            $hirings->whereDate('created_at', '=', $date);
        }
        return $hirings->paginate(LIMIT_10);
    }

    public function restoreUserHiring($userestore, $request)
    {
        $userestore->restore();
        $userestore->hiring()->restore();
        $userestore->update([
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(),
        ]);

        $avatarPath = $userestore->hiring()->first()->avatar_path ?? null;
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
            $hiring = $this->model::where('user_id', $userId)->first();
            if ($hiring && !empty($hiring->avatar_path)) {
                // Xóa ảnh cũ trong storage
                Storage::disk('public')->delete($hiring->avatar_path);
            }
            $avatarPath = $request->file('avatar_path')->store('hirings', 'public');
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
        $user->hiring()->delete();
        $user->delete();
    }
}
