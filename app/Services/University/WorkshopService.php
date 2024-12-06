<?php

namespace App\Services\University;

use Illuminate\Support\Facades\Storage;
use App\Repositories\Workshop\WorkshopRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class WorkshopService
{
    protected $workshopRepository;

    public function __construct(WorkshopRepositoryInterface $workshopRepository)
    {
        $this->workshopRepository = $workshopRepository;
    }

    public function createWorkshop($request)
    {
        $user = Auth::guard('admin')->user();
        if ($user->role === ROLE_SUB_UNIVERSITY) {
            $universityId = $user->academicAffair->university_id;

        }
        if ($user->role === ROLE_UNIVERSITY) {
            $universityId = $user->university->id; 
        }
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'university_id' => $universityId,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'amount' => $request->amount,
            'content' => $request->content,
        ];


        if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
            $data['avatar_path'] = $request->file('avatar_path')->store('workshops', 'public');
            $data['avatar_path'] = '/storage/' . $data['avatar_path'];
        }

        return $this->workshopRepository->create($data);
    }
    public function updateWorkshop($request, $id): mixed
    {
        $user = Auth::guard('admin')->user();
        if ($user->role === ROLE_SUB_UNIVERSITY) {
            $universityId = $user->academicAffair->university_id; 

        }
        if ($user->role === ROLE_UNIVERSITY) {
            $universityId = $user->university->id; 

        }
        $workshop = $this->workshopRepository->find($id);
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'university_id' => $universityId ,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'amount' => $request->amount,
            'content' => $request->content,
        ];

        if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
            if (!empty($workshop->avatar_path)) {
                $filePath = str_replace('/storage', '', $workshop->avatar_path);
                if (Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }
            }

            $data['avatar_path'] = $request->file('avatar_path')->store('workshops', 'public');
            $data['avatar_path'] = '/storage/' . $data['avatar_path'];
        }
        return $workshop->update($data);
    }


    public function getWorkshops($filters)
    {
        return $this->workshopRepository->getWorkshop($filters);
    }

    public function getWorkshop($id)
    {
        return $this->workshopRepository->find($id);
    }
}
