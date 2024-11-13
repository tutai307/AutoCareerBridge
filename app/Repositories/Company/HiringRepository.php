<?php

namespace App\Repositories\Company;

use App\Models\Hiring;
use App\Models\User;
use App\Repositories\Company\HiringRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class HiringRepository implements HiringRepositoryInterface
{
    protected $model;

    public function __construct(Hiring $model){
        $this->model = $model;
    }

    public function getAllHirings(){
        try {
            $companyId = 1;
            $hirings = $this->model::with('user')->where('company_id', $companyId)
                ->paginate(2);
            return $hirings;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Không thể lấy dữ liệu nhân viên tuyển dụng'], 500);
        }
    }

    public function createHiring($request){
        try {
            $request->validate([
                'user_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 4,
            ]);

            $this->model->create([
                'user_id' => $user->id,
                'company_id' => 1,
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Không thể thêm nhân viên tuyển dụng mới'], 500);
        }
    }

    public function editHiring($id){
        try {
            $hiring = User::find($id);
            return $hiring;
        } catch (Exception $e) {
            
            Log::error($e->getMessage());
            return response()->json(['error' => 'Không thể lấy dữ liệu nhân viên tuyển dụng'], 500);
        }
    }

    public function updateHiring($request){
        try {
            $request->validate([
                'name_update' => 'required|string|max:255',
                'email_update' => 'required|email|max:255',
                'password_update' => 'required|string|min:8|confirmed',
            ]);

            $email = $request->email_update;
            $user = User::where('email', $email)->firstOrFail();
            $user->user_name = $request->input('name_update');
            $user->email = $request->input('email_update');
            $user->password = Hash::make($request->input('password_update'));
            $user->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Không thể cập nhật thông tin nhân viên tuyển dụng'], 500);
        }
    }

    public function deleteHiring($id){
        try {
            $hiring = User::find($id);
            $this->model::where('user_id', $id)->delete();
            $hiring->delete();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Không thể xóa nhân viên tuyển dụng'], 500);
        }
    }

    public function findHiring($request){
        try {
            $name = $request->name;
            $email = $request->email;
            $companyId = 1;

            $hirings = $this->model::with('user')->where('company_id', $companyId);

            if ($name) {
                $hirings->whereHas('user', function ($query) use ($name) {
                    $query->where('user_name', 'like', "%$name%");
                });
            }

            if ($email) {
                $hirings->whereHas('user', function ($query) use ($email) {
                    $query->where('email', 'like', "%$email%");
                });
            }

            return $hirings->get();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Không thể tìm dữ liệu tuyển dụng'], 500);
        }
    }
}
