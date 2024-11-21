<?php

namespace App\Services\AcademicAffairs;

use App\Repositories\AcademicAffairs\AcademicAffairsRepositoryInterface;
use App\Repositories\Auth\Managements\AuthRepositoryInterface;
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

  public function index($universityId){
    return $this->academicAffairsRepository->index($universityId);
  }

  public function store($request,$universityId){
    $avatarPath = null;
    if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
      $data['avatar_path'] = $request->file('avatar_path')->store('academicAffairs', 'public');
      $data['avatar_path'] = Storage::url($data['avatar_path']);
        
    }
    $dataUser = [
        'user_name' => $request->user_name,
        'password' => $request->password,
        'email' => $request->email,
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

  public function find($request,$universityId){
    return $this->academicAffairsRepository->search($request,$universityId);
  }
}
