<?php

namespace App\Repositories\Company;

use App\Models\Hiring;
use App\Models\User;
use App\Repositories\Company\HiringRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;

class HiringRepository implements HiringRepositoryInterface
{
    protected $model;
    protected $companyId;
    public function __construct(Hiring $model){
        $this->model = $model;    
    }
    

    public function getAllHirings(){
        $userID =  auth()->guard('admin')->user();
        $this->companyId=$userID ->company->id;
        try {
            $companyId = $this->companyId;
            $hirings = $this->model::with('user')->where('company_id', $companyId)
                ->paginate(LIMIT_10);
            return $hirings;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Hiển thị nhân viên thất bại');
        }
    }

    public function createHiring($request){

        $avatarPath = null;
        if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
            $avatarPath = $request->file('avatar_path')->store('hirings', 'public');
        }
        $userID =  auth()->guard('admin')->user();
        $this->companyId=$userID ->company->id;
        try {          
            $user = User::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 4,
            ]);

            $this->model->create([
                'user_id' => $user->id,
                'company_id' => $this->companyId,
                'full_name' => $request->full_name,
                'avatar_path' => $avatarPath,
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Thêm nhân viên thất bại');
        }
    }

    public function editHiring($id){
        try {
            $hiring = User::with('hirings')->find($id);
            return $hiring;
        } catch (Exception $e) {        
            Log::error($e->getMessage());
            return back()->with('error', 'Lấy nhân viên thất bại');
        }
    }

    public function updateHiring($request){
        $userID =  auth()->guard('admin')->user();
        $this->companyId=$userID ->company->id;
        $avatarPath = null;
        if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
            $avatarPath = $request->file('avatar_path')->store('hirings', 'public');
        }
        try {
            $id = $request->user_id;
            $user = User::where('id', $id)->firstOrFail();
            $user->user_name = $request->input('name_update');
            $user->email = $request->input('email_update');
            $user->save();
            if (!$avatarPath) {
                $avatarPath = $user->hirings()->where('company_id', $this->companyId)->value('avatar_path');
            }
            $user->hirings()->where('company_id', $this->companyId)->update([
                'full_name' => $request->input('full_name_update'),
                'avatar_path' => $avatarPath,
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Cập nhật nhân viên thất bại');
        }
    }

    public function deleteHiring($id){
        try {
            $user = User::findOrFail($id);
            $user->hirings()->delete();
            $user->delete();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Xóa nhân viên thất bại');
        }
    }
    public function findHiring($request){
        $userID =  auth()->guard('admin')->user();
        $this->companyId=$userID ->company->id;
        try {
            $full_name = $request->searchName;
            $email = $request->searchEmail;
            $companyId = $this->companyId;

            $hirings = $this->model::with('user')->where('company_id', $companyId);

            if ($full_name) {
                $hirings->where('full_name', 'like', "%$full_name%");
            }

            if ($email) {
                $hirings->whereHas('user', function ($query) use ($email) {
                    $query->where('email', 'like', "%$email%");
                });
            }

            return $hirings->paginate(LIMIT_10);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Tìm nhân viên thất bại');
        }
    }
}
