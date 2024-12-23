<?php

namespace App\Services\AcademicAffairs;

use App\Models\User;
use App\Repositories\AcademicAffairs\AcademicAffairsRepositoryInterface;
use App\Repositories\Auth\Managements\AuthRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AcademicAffairsService
{
    protected $academicAffairsRepository;
    protected $authRepository;

    public function __construct(AcademicAffairsRepositoryInterface $academicAffairsRepository, AuthRepositoryInterface $authRepository )
    {
        $this->academicAffairsRepository = $academicAffairsRepository;
        $this->authRepository = $authRepository;
    }

  public function getAcademicAffairs($request,$universityId){
    return $this->academicAffairsRepository->getAcademicAffairs($request,$universityId);
  }

  public function store($request,$universityId){
    $email = $request->email;
    $userestore = User::withTrashed()->where('email', $email)->first();

    if ($userestore) {
        return $this->academicAffairsRepository->restoreUserAcademicAffairs($userestore, $request);
    }

    $avatarPath = null;
    if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
      $avatarPath = $request->file('avatar_path')->store('academicAffairs', 'public');

    }
    $dataUser = [
        'user_name' => $request->user_name,
        'password' => Hash::make($request->password),
        'email' => $request->email,
        'email_verified_at'=>Carbon::now(),
        'role' => ROLE_SUB_UNIVERSITY,
    ];
    $user= $this->authRepository->create($dataUser);
    $data = [
        'university_id' => $universityId,
        'user_id' => $user->id,
        'name' => $request->full_name,
        'phone' => $request->phone,
        'avatar_path' => $avatarPath,
    ];
    return $this->academicAffairsRepository->create($data);
  }

  public function edit($userId){
    return $this->academicAffairsRepository->edit($userId);
  }

  public function update($request,$userId){
    return $this->academicAffairsRepository->updateAcademicAffairs($request,$userId);

  }

  public function delete($id){
    $this->academicAffairsRepository->deleteAcademicAffairs($id);
     $this->authRepository->delete($id);
  }

}
