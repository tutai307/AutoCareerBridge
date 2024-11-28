<?php 

namespace App\Repositories\Fields;

use App\Models\Fields;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Fields\FieldsRepositoryInterface;

class FieldsRepository extends BaseRepository implements FieldsRepositoryInterface {
    public function getModel() {
        return Fields::class;
    }

    public function getFields() {
        return $this->model->orderBy('id', 'desc')->paginate(LIMIT_10);
    }
    public function getFieldsPropose() {
        return $this->model->orderBy('id', 'desc')->where('status', 0)->paginate(LIMIT_10);
    }
    public function getFieldsReject() {
        return $this->model->orderBy('id', 'desc')->where('status', 2)->paginate(LIMIT_10);
    }
}
