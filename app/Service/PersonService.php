<?php

namespace App\Service;

use App\Model\Person;

class PersonService
{
    /**
     * @var Person
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Person();
    }

    public function index()
    {
        return $this->model->all();
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function store(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        return $this->model->update($id, $attributes);
    }

    public function destroy($id)
    {
        return $this->model->delete($id);
    }
}