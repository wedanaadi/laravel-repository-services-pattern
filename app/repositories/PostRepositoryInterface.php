<?php

namespace App\Repositories;

/**
 * Interface PostRepositoryInterface
 */
interface PostRepositoryInterface
{
    /**
     * getBy : ini untuk select semua data post
     *
     * @return void
     */
    public function getBy($type = null, $params = null);
    public function store($data);
    public function update($data, $id);
    public function delete($id);
}
