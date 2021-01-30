<?php
namespace Src;
class Route
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
        $parts=parse_url($_SERVER['REQUEST_URI']);
        $path=$parts['path'];
        $parts=explode('/', $path);

        $this->controllerName=  '\\App\\Controller\\' . ucfirst(strtolower($parts[3]));
        $this->actionName = strtolower($parts[4]);
        $this->flag=true;
    }


}