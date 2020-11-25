<?php


namespace App\Services;

use App\Interfaces\BaseInterface;

class BaseService implements BaseInterface
{


    /**
     * get all data
     */
    public function all()
    {
        return $this->query();
    }

    /**
     * insert data on table
     * @param $data
     */
    public function create($data)
    {
        return $this->model()->create($data);
    }

    /**
     * find row in table
     * @param $id
     */
    public function find($id)
    {
        return $this->model()->findOrFail($id);
    }

    /**
     * update data on model
     * @param $data
     * @param $id
     */
    public function update($id, $data)
    {
        return $this->find($id)->update($data);
    }

    /**
     * delete data from model
     * @param $id
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * get model
     */
    public function model()
    {
        return new static::$model;
    }

    /**
     * get model
     */
    public function query()
    {
        return new static::$model;
    }
}
