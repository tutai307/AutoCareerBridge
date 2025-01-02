<?php
namespace App\Repositories\University;
use App\Repositories\Base\BaseRepositoryInterface;
use Illuminate\Http\Request;
interface UniversityRepositoryInterface extends BaseRepositoryInterface
{
    public function popularUniversities();
    public function getDetailUniversity($slug);
    public function getWorkShops($slug);
    public function findUniversity($request);
    public function totalRecord();

    public function getStudentMatchingJob($idJob, $universityId);

}
