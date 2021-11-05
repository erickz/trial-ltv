<?php

namespace App\Repositories\Contracts;

interface UrlRepositoryInterface
{
    public function get();
    public function paginate();
    public function find($id);
    public function store($data);
    public function update($id, $data);
    public function delete($ids);
}
