<?php

namespace App\Core;

class Template
{
    private $layout = 'layout';
    private $params = [];

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function setParams($params) {
        $this->params = $params;
    }

    public function render($view, $params = [])
    {
        ob_start();
        extract(array_merge($this->params, ['content' => $this->view($view, $params)]));
        include(BASE_PATH . 'resources/views/layouts/' . $this->layout . '.phtml');
        echo ob_get_clean();
    }

    public function json($params = []) {
        header('Content-Type: application/json');
        echo json_encode($params);
    }

    private function view($view, $params = []) {
        ob_start();
        extract($params);
        include(BASE_PATH . 'resources/views/' . $view . '.phtml');
        return ob_get_clean();
    }
}