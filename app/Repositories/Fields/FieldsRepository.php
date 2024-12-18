<?php

namespace App\Repositories\Fields;

use App\Models\Field;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Fields\FieldsRepositoryInterface;

class FieldsRepository extends BaseRepository implements FieldsRepositoryInterface
{
    public function getModel()
    {
        return Field::class;
    }

    public function getFields()
    {
        $query = $this->model->query();

        if ($search = request()->get('search')) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($status = request()->get('status')) {
            $query->where('status', $status);
        }

        return $query
            ->orderByRaw('status = ' . STATUS_PENDING . ' DESC')
            ->orderBy('id', 'desc')
            ->paginate(PAGINATE_FIELD);
    }

    public function getAllFields()
    {
        $fields = Field::all();
        return response()->json($fields);
    }

    public function getFieldsWithJobCount()
    {
        $fields = $this->model::with(['majors.jobs'])
            ->whereHas('majors.jobs') 
            ->get();
        foreach ($fields as $field) {
            $field->total_jobs = $field->majors->sum(function ($major) {
                return $major->jobs->count(); 
            });
        }

        return $fields;
    }


}
