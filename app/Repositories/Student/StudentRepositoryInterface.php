<?php

namespace App\Repositories\Student;

use App\Repositories\Base\BaseRepositoryInterface;

interface StudentRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel();
    public function getStudents(array $filters);
    public function getBySlug($slug);
    public function delete($id);
    public function getStudentById(int $id);
}