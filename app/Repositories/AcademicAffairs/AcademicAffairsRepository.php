<?php

namespace App\Repositories\AcademicAffairs;

use App\Models\AcademicAffair;
use App\Repositories\Base\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AcademicAffairsRepository extends BaseRepository implements AcademicAffairsRepositoryInterface
{
    public function getModel()
    {
        return AcademicAffair::class;
    }

    public function getAcademicAffairs($request,$universityId){
       
        $search = $request->search;
        $date =$request->date;
        $academicAffairs = $this->model::with('user')->where('university_id', $universityId)->orderBy('created_at', 'desc');
        if ($search) {
            $academicAffairs->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%") 
                      ->orWhereHas('user', function ($userQuery) use ($search) {
                          $userQuery->where('email', 'like', "%$search%"); 
                      });
            });
        }
        if ($date) {
            $academicAffairs->whereDate('created_at', '=', $date);
        }
    
        return $academicAffairs->paginate(LIMIT_10);
    }

    public function edit($userId){
        $academicAffairs= $this->model::with('user')->where('user_id', $userId)->first();
        return $academicAffairs;
    }

    public function restoreUserAcademicAffairs($userestore, $request)
    {
        $userestore->restore();
        $userestore->academicAffair()->restore();
        $userestore->update([
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(),
        ]);

        $avatarPath = $userestore->academicAffair()->first()->avatar_path ?? null;
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
            $academicAffairs = $this->model::where('user_id', $userId)->first();
            if ($academicAffairs && !empty($academicAffairs->avatar_path)) {
                Storage::disk('public')->delete($academicAffairs->avatar_path);
            }
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

  
}    
