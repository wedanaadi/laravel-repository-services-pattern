<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class PostService
{

    /**
     * PostRepository
     *
     * @var mixed
     */
    protected $PostRepository;

    /**
     * __construct
     *
     * @param  mixed $postRep
     * @return void
     */
    public function __construct(PostRepository $postRep)
    {
        $this->PostRepository = $postRep;
    }
    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        $result = $this->PostRepository->getBy();
        return $result;
    }

    public function getById($id)
    {
        $result = $this->PostRepository->getBy('id', $id);
        return $result;
    }

    /**
     * savePostData for update atau delete
     *
     * @param  mixed $data
     * @return void
     */
    public function savePostData($data, $action, $id = null)
    {
        $validator = Validator::make($data, [
            'title' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'Field title kosong!',
            'description.required' => 'Field title kosong!',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();
        try {
            if ($action === 'create') {
                $result = $this->PostRepository->store($data);
            } else {
                $result = $this->PostRepository->update($data, $id);
            }
        } catch (Exception $e) {
            DB::rollback();
            throw new InvalidArgumentException("Unable " . $action . " data - " . $e->getMessage());
        }
        DB::commit();
        return $result;
    }

    public function deletePostData($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->PostRepository->delete($id);
        } catch (Exception $e) {
            DB::rollback();
            throw new InvalidArgumentException("Unable to delete data");
        }
        DB::commit();
        return $result;
    }
}
