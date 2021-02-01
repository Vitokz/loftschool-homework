<?php

namespace Src;
use Src\AbstractController;
class Route extends AbstractController
{
    private $controllerName;
    private $actionName;
    private $flag = false;

    public function getControllerName()
    {
        if (!$this->flag) {
            $this->getNames();
        }
        return $this->controllerName;
    }

    public function getActionName()
    {
        if (!$this->flag) {
            $this->getNames();
        }
        return $this->actionName;
    }

    public function getNames()
    {
        $parts = parse_url($_SERVER['REQUEST_URI']);
        $path = $parts['path'];
        $parts = explode('/', $path);
        if($parts[1]== ""){
            $this->controllerName= '\\App\\Controller\\' . 'User';
        } else {
            $this->controllerName = '\\App\\Controller\\' . ucfirst(strtolower($parts[1]));
        }
        if($parts[2]== ""){
            $this->actionName= strtolower($parts[1]);
            $this->flag = true;
        } else {
            $this->actionName = strtolower($parts[2]);
            $this->flag = true;
        }
    }


}


