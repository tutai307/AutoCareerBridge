<?php
namespace App\Repositories\University;
use Illuminate\Http\Request;
interface UniversityRepositoryInterface
{
    public function getAll();
    public function index();
    public function getDetailUniversity($slug);
    public function getWorkShops($slug);
    public function findUniversity($request);
}
