<?php

namespace App\Repositories\Company;
use App\Models\Hiring;
use App\Models\User;
use App\Repositories\Company\HiringRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HiringRepository implements HiringRepositoryInterface
{
    protected $model;
    public function __construct(Hiring  $model){
        $this->model = $model;
    }

    public function getAllHirings(){
        $companyId = 1;
        $hirings = $this->model::with('user')->where('company_id', $companyId)
            ->get();
           
        return $hirings;
    }

    public function createHiring($request){
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

        Hiring::create([
            'user_id' => $user->id,
            'company_id' => 1,
        ]);
    }

    public function editHiring($id){
        $hiring = User::find($id);
        return $hiring;
    }

    public function updateHiring($request){
        $request->validate([
            'name_update' => 'required|string|max:255',
            'email_update' => 'required|email|max:255',
            'password_update' => 'required|string|min:8|confirmed',
        ]);   
        $email = $request->email_update;
        $user = User::where('email', $email)->firstOrFail();
        $user->user_name = $request->input('name_update');
        $user->email = $request->input('email_update');;
        $user->password = $request->input('password_update');
        $user->save();
    }

    public function deleteHiring($id){
        $hiring= User::find($id);
        Hiring::where('user_id', $id)->delete();
        $hiring->delete();
    }

    public function findHiring($request){
        $name = $request->name;
        $email = $request->email;
        $companyId = 1;
        $hirings = $this->model::with('user')  
        ->where('company_id', $companyId);
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
    }
}
