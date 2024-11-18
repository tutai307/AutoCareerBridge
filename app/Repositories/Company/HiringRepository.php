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
    protected $companyId;
    public function __construct(Hiring $model, $companyId = 1){
        $this->model = $model;
        $this->companyId = $companyId;
    }

    public function getAllHirings(){
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
        $request->validate([
            'full_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'full_name.required' => 'Vui lòng nhập tên đầy đủ.',
            'user_name.required' => 'Vui lòng nhập tên người dùng.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.unique' => 'Địa chỉ email này đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);
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
        $request->validate([
            'full_name_update' => 'required|string|max:255',
            'name_update' => 'required|string|max:255',
            'email_update' => 'required|email|max:255',
            
        ],[
            'full_name_update.required' => 'Vui lòng nhập tên.',
            'name_update.required' => 'Vui lòng nhập tên.',
            'name_update.string' => 'Tên phải là một chuỗi ký tự.',
            'name_update.max' => 'Tên không được vượt quá 255 ký tự.',
            'email_update.required' => 'Vui lòng nhập địa chỉ email.',
            'email_update.email' => 'Địa chỉ email không hợp lệ.',
            'email_update.max' => 'Địa chỉ email không được vượt quá 255 ký tự.',
        ]);
        try {
            $id = $request->user_id;
            $user = User::where('id', $id)->firstOrFail();
            $user->user_name = $request->input('name_update');
            $user->email = $request->input('email_update');
            $user->save();
            $user->hirings()->where('company_id', $this->companyId)->update([
                'full_name' => $request->input('full_name_update')
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Cập nhật nhân viên thất bại');
        }
    }

    public function deleteHiring($id){
        try {
            $hiring = User::find($id);
            $this->model::where('user_id', $id)->delete();
            $hiring->delete();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Xóanhân viên thất bại');
        }
    }
    public function findHiring($request){
        try {
            $name = $request->searchName;
            $email = $request->searchEmail;
            $companyId = $this->companyId;

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

            return $hirings->paginate(LIMIT_10) ->appends(['searchName' => $request->searchName, 'searchEmail' => $request->searchEmail]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Tìm nhân viên thất bại');
        }
    }
}
