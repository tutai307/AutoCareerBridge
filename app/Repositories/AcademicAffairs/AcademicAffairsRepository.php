<?php

namespace App\Repositories\AcademicAffairs;

use App\Models\AcademicAffairs;
use App\Repositories\Base\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AcademicAffairsRepository extends BaseRepository implements AcademicAffairsRepositoryInterface
{
    public function getModel()
    {
        return AcademicAffairs::class;
    }

    public function index($universityId){
        $academicAffairs= $this->model::with('user')->where('university_id', $universityId)
        ->paginate(LIMIT_10);
        return $academicAffairs;
    }

    public function edit($userId){
        $academicAffairs= $this->model::with('user')->where('user_id', $userId)->first();
        return $academicAffairs;
    }

    public function restoreUserAcademicAffairs($userestore, $request)
    {
        $userestore->restore();
        $userestore->academicAffairs()->restore();
        $userestore->update([
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(),
        ]);

        $avatarPath = $userestore->academicAffairs()->first()->avatar_path ?? null;
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

    public function updateAcademicAffairs($request,$userId){
       
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
        
    public function deleteAcademicAffairs($id){
        $this->model->where('user_id',$id)->delete();
    }

    public function search($request,$universityId){
        $name = $request->searchName;
        $email = $request->searchEmail;
        $academicAffairs = $this->model::with('user')->where('university_id', $universityId);
        if ($name) {
            $academicAffairs->where('name', 'like', "%$name%");
        }
        if ($email) {
            $academicAffairs->whereHas('user', function ($query) use ($email) {
                $query->where('email', 'like', "%$email%");
            });
        }
        return $academicAffairs->paginate(LIMIT_10);
    }
}    
