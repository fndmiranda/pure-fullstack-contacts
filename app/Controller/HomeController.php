<?php

namespace App\Controller;

use App\Core\Template;

class HomeController
{
    public function index()
    {
        $view = new Template();
        $view->setLayout('layout');
        $view->setParams([
            'title' => 'A pure full-stack contacts project'
        ]);

        $view->render('home/index', []);
    }
}