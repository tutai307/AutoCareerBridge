<?php
namespace App\Repositories\Universities;

use App\Models\University;
use App\Repositories\Universities\UniversityRepositoryInterface;
use App\Repositories\Base\BaseRepository;

class UniversityRepository extends BaseRepository implements UniversityRepositoryInterface
{
    public function getModel()
    {
        return University::class;
    }

    public function findById($id)
    {
        return University::where('user_id', $id)->firstOrFail();
    }

    public function updateAvatar($university, $imagePath)
    {
        $university->update(['avatar_image' => $imagePath]);
    }

}