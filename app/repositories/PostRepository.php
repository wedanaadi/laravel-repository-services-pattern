<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{

    protected $table;
    /**
     * __construct
     *
     * @param  mixed $post
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->table = $post;
    }

    /**
     * store
     *
     * @param  mixed $data
     * @return void
     */
    public function store($data)
    {
        $post = $this->table->create($data);
        return $post->fresh();
    }

    /**
     * getBy
     *
     * @param  mixed $key
     * @param  mixed $params
     * @return void
     */
    public function getBy($key = null, $params = null)
    {
        if ($key !== null or $params !== null) {
            return $this->table->where($key, $params)->first();
        } else {
            return $this->table->get();
        }
    }

    /**
     * update
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function update($data, $id)
    {
        $post = $this->table->findOrFail($id);
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->table->findOrFail($id);
        $post->delete();
        return 'delete success';
    }
}
