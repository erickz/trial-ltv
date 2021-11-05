<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Contracts\TopUrlRepositoryInterface;
use App\Models\TopUrl as Model;

class TopUrlRepository implements TopUrlRepositoryInterface
{
    private $model;
    private $rowsPerPage = 20;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get(Array $filters = []): Collection
    {
        return $this->model->get();
    }

    public function getTop100()
    {
        return $this->model->take(100)->order_by('access_count', 'DESC')->get();
    }

    public function paginate(Array $filters = []): LengthAwarePaginator
    {
        return $this->model->paginate($this->rowsPerPage);
    }

    public function find($id = 0): Model
    {
        return $this->model->find($id);
    }

    public function generateRandomString($limit = 6)
    {
        return bin2hex(random_bytes($limit));
    }

    public function createShortenedUrl($randomString)
    {
        $host = request()->getHttpHost();

        return $host . '/' . $randomString;
    }

    public function store($data = []): Model
    {
        $record = $this->model->create($data);
        $record->random_hash = $this->generateRandomString();
        $record->shortened_url = $this->createShortenedUrl();

        $record->save();

        return $record;
    }

    public function update($id, $data): Bool
    {
        $record = $this->find($id);

        if (! $record){
            return false;
        }

        $updated = $record->update($data);

        return $updated;
    }

    public function delete($ids): Bool
    {
        return $this->model->destroy($ids);
    }
}
