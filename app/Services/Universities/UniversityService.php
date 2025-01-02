<?php

namespace App\Services\Universities;

use App\Models\University;
use App\Repositories\Universities\UniversityRepository;
use Illuminate\Support\Facades\Storage;

class UniversityService
{
    public $universityRepository;
    public function __construct(UniversityRepository $universityRepository)
    {
        $this->universityRepository = $universityRepository;
    }

    public function getUniversityById($id)
    {
        return $this->universityRepository->findById($id);
    }

    public function uploadImage($id, $image)
    {
        $university = $this->universityRepository->findById($id);

        if (!$university) {
            throw new \Exception('Không tìm thấy trường đại học với ID: ' . $id);
        }

        if ($university->avatar && Storage::exists($university->avatar)) {
            Storage::delete($university->avatar);
        }
        $imagePath = $image->store('universities', 'public');
        $imageUrl = Storage::url($imagePath);

        $this->universityRepository->updateAvatar($university, $imagePath);

        return $imageUrl;
    }

    public function updateUniversity(int $universityId, array $data)
    {
        $university = $this->universityRepository->find($universityId);
        return $university->update( $data);
    }

    public function create(array $data)
    {
        return $this->universityRepository->create($data);
    }
}
