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
    public function getFieldsPropose()
    {
        return $this->fieldsRepository->getFieldsPropose();
    }

    public function createFields($request)
    {
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status ?? 0
        ];
        return $this->fieldsRepository->create($data);
    }
    public function updateFields($request, $id)
    {
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status ?? 0
        ];

        $fiels = $this->fieldsRepository->find($id);
        if (empty($fiels)) {
            return null;
        }

        return $fiels->update($data);
    }

    public function fieldsFirst($id)
    {
        return $this->fieldsRepository->find($id);
    }
}
