<?php

namespace App\Core;

class Application
{
    /**
     * @var string
     */
    private $controller = 'home';

    /**
     * @var string
     */
    private $action = 'index';

    /**
     * @var array
     */
    private $params = [];

    public function run()
    {
        $this->parseRoute();

        $controllerName = '\\App\\Controller\\' . ucfirst($this->controller) . 'Controller';
        if (class_exists($controllerName)) {
            $controller = new $controllerName();

            if (method_exists($controller, $this->action) && is_callable([$controller, $this->action])) {
                if (!empty($this->params)) {
                    call_user_func_array([$controller, $this->action], $this->params);
                } else {
                    $controller->{$this->action}();
                }
            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(404);
        }
    }

    private function parseRoute()
    {
        if (isset($_GET['url'])) {
            $url = explode('/', filter_var(trim($_GET['url']), FILTER_SANITIZE_URL));

            if (isset($url[0]) && $url[0]) {
                $this->controller = $url[0];
            }

            if (isset($url[1]) && $url[1]) {
                $this->action = $url[1];
            }

            unset($url[0], $url[1]);
            $this->params = array_values($url);
        }
    }

}