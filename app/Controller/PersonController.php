<?php

namespace App\Controller;

use App\Core\Template;
use App\Service\PersonService;

class PersonController
{
    /**
     * @var PersonService
     */
    protected $service;

    public function __construct()
    {
        $this->service = new PersonService();
    }

    public function index()
    {
        $view = new Template();
        $view->json(['data' => $this->service->index()]);
    }

    public function store()
    {
        $view = new Template();

        $data = [];
        foreach(array_keys($_POST) as $key)
        {
            $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        $view->json(['data' => $this->service->store($data)]);
    }

    public function update()
    {
        $view = new Template();

        $data = [];
        foreach(array_keys($_POST) as $key)
        {
            $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        $view->json(['data' => $this->service->update($data['id'], $data)]);
    }

    public function destroy($id)
    {
        $view = new Template();
        $view->json(['data' => $this->service->destroy($id)]);
    }
}