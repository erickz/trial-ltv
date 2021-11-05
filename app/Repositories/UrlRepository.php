<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Contracts\UrlRepositoryInterface;
use App\Models\UrlModel as Model;

class UrlRepository implements UrlRepositoryInterface
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

        if (strpos($host, 'http') !== 0) {
            $host = 'http://' .  $host;
        }

        return $host . '/' . $randomString;
    }

    public function store($data = []): Model
    {
        $randomHash = $this->generateRandomString();
        $shortenedUrl = $this->createShortenedUrl($randomHash);

//        dd($randomHash);

        $record = $this->model->create($data + ['shortened_url' => $shortenedUrl, 'random_hash' => $randomHash ]);

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
