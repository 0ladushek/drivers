<?php

namespace App;

use \App\View;

abstract class Controller
{
    protected $view;

    public function  __construct()
    {
        $this->view = new View;
    }

    protected function access()
    {
        return true;
    }

    public function action($name)
    {
        $methodName = 'action'. $name;
        if ($this->access()) {
            return $this->$methodName();
        }
        else {
            header("HTTP/1.0 401 Forbidden");
            die('Доступ закрыт');
        }
    }
}