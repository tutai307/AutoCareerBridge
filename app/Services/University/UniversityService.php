<?php

namespace App\Services\University;

use App\Models\University;
use App\Models\WorkShop;
use App\Repositories\University\UniversityRepositoryInterface;
use App\Repositories\Workshop\WorkshopRepositoryInterface;
use Illuminate\Http\Request;

class UniversityService
{
    protected $universityRepository;
    protected $workshopRepository;

    public function __construct(UniversityRepositoryInterface $universityRepository, WorkshopRepositoryInterface $workshopRepository){
        $this->universityRepository = $universityRepository;
        $this->workshopRepository = $workshopRepository;
    }

    public function getAll(){
        return $this->universityRepository->getAll();
    }

    public function popularUniversities(){
        return $this->universityRepository->popularUniversities();
    }

    public function getDetail($slug){
        return $this->universityRepository->getDetailUniversity($slug);
    }

    public function getWorkShops($slug){
        return $this->universityRepository->getWorkShops($slug);
    }

    public function findUniversity($request){
        return $this->universityRepository->findUniversity($request);
    }

    public function totalRecord(){
        return $this->universityRepository->totalRecord();
    }

    public function getWorkshopDashboard($dateFrom, $dateTo){
        $records = $this->workshopRepository->getWorkshopDashboard($dateFrom, $dateTo);
        $totalPending = [];
        $totalApproved = [];
        $totalRejected = [];
        $date = [];

        foreach ($records as $value) {
            array_push($totalPending, $value->total_pending);
            array_push($totalApproved, $value->total_approved);
            array_push($totalRejected, $value->total_rejected);
            array_push($date, $value->created_date);
        }

        return [
            'workshopPending' => $totalPending,
            'workApperoved' => $totalApproved,
            'workshopReject' => $totalRejected,
            'date' => $date
        ];
    }
}
