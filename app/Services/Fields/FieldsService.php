<?php

namespace App\Services\Fields;

use App\Repositories\Fields\FieldsRepositoryInterface;

class FieldsService
{
    protected $fieldsRepository;
    public function __construct(FieldsRepositoryInterface $fieldsRepository)
    {
        $this->fieldsRepository = $fieldsRepository;
    }

    public function getFields()
    {
        return $this->fieldsRepository->getFields();
    }
    public function getAll()
    {
        return $this->fieldsRepository->getAll();
    }

    public function changeStatus($id, $confirm)
    {
        $fields = $this->fieldsRepository->find($id);
        if (empty($fields)) {
            return null;
        }

        if ($confirm === 'accept') {
            $fields->update(['status' => STATUS_APPROVED]);
        } elseif ($confirm === 'reject') {
            $fields->update(['status' => STATUS_REJECTED]);
        }
        $fields->update([
            'updated_by' => auth('admin')->user()->id,
        ]);

        return $fields->only(['status']);
    }

    public function createFields($request)
    {
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'created_by' => auth('admin')->user()->id,
            'updated_by' => auth('admin')->user()->id,
            'status' => $request->status ?? STATUS_APPROVED
        ];
        return $this->fieldsRepository->create($data);
    }

    public function updateFields($request, $id)
    {
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status ?? STATUS_APPROVED,
            'created_by' => auth('admin')->user()->id,
            'updated_by' => auth('admin')->user()->id,
            'description' => $request->description,
        ];

        $fiedls = $this->fieldsRepository->find($id);
        if (empty($fiedls)) {
            return null;
        }

        return $fiedls->update($data);
    }

    public function fieldsFirst($id)
    {
        return $this->fieldsRepository->find($id);
    }

    public function getAllFields(){
        return $this->fieldsRepository->getAllFields();
    }

    public function getFieldsWithJobCount()
    {
       return $this->fieldsRepository->getFieldsWithJobCount();
    }
}
