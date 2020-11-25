<?php


namespace App\Interfaces;


interface BaseInterface
{

    public function all();

    public function create($data);

    public function find($id);

    public function update($id, $data);

    public function delete($id);
}
