<?php

namespace App\Services\University;

use Illuminate\Support\Facades\Storage;
use App\Repositories\Workshop\WorkshopRepositoryInterface;

class WorkshopService
{
    protected $workshopRepository;

    public function __construct(WorkshopRepositoryInterface $workshopRepository)
    {
        $this->workshopRepository = $workshopRepository;
    }

    public function createWorkshop($request)
    {
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'university_id' => auth('admin')->user()->university->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'amount' => $request->amount,
            'content' => $request->content,
        ];

        if ($request->hasFile('avatar_path') && $request->file('avatar_path')->isValid()) {
            $data['avatar_path'] = $request->file('avatar_path')->store('workshops', 'public');
            $data['avatar_path'] = Storage::url($data['avatar_path']);
        }

        return $this->workshopRepository->create($data);
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
