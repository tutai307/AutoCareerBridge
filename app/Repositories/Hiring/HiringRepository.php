<?php

namespace App\Repositories\Hiring;

use App\Models\Hiring;
use App\Models\User;
use App\Repositories\Hiring\HiringRepositoryInterface;
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
            'role' => ROLE_HIRING,
        ]);

        $this->model->create([
            'user_id' => $user->id,
            'company_id' => $companyId,
            'name' => $request->full_name,
            'avatar_path' => $avatarPath,
        ]);

        
    }

    public function editHiring($id)
    {
        $hiring = User::with('hirings')->find($id);
        return $hiring;
    }

    public function updateHiring($request, $companyId)
    {
        $avatarPath = null;
        if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
            $avatarPath = $request->file('avatar_path')->store('hirings', 'public');
        }
        $id = $request->user_id;
        $user = User::where('id', $id)->firstOrFail();
        $user->user_name = $request->input('name_update');
        $user->email = $request->input('email_update');
        $user->save();
        if (!$avatarPath) {
            $avatarPath = $user->hirings()->where('company_id', $companyId)->value('avatar_path');
        }
        $user->hirings()->where('company_id', $companyId)->update([
            'name' => $request->input('full_name_update'),
            'avatar_path' => $avatarPath,
        ]);
    }

    public function deleteHiring($id)
    {
        $user = User::findOrFail($id);
        $user->hirings()->delete();
        $user->delete();
    }
    public function findHiring($request, $companyId)
    {
        $full_name = $request->searchName;
        $email = $request->searchEmail;
        $hirings = $this->model::with('user')->where('company_id', $companyId);
        if ($full_name) {
            $hirings->where('name', 'like', "%$full_name%");
        }
        if ($email) {
            $hirings->whereHas('user', function ($query) use ($email) {
                $query->where('email', 'like', "%$email%");
            });
        }
        return $hirings->paginate(LIMIT_10);
    }
}
