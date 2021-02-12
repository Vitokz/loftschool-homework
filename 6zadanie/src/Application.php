<?php
namespace Src;

use App\Model\UserModel;

class Application
{
    private $route;
    private $controller;
    private $action;

    public function __construct()
    {
        $this->route= new Route();
    }

    public function run()
    {
        try {
            session_start();
            $this->getController();
            $this->getAction();

            $view= new View();
            $this->controller->setView($view);
            $this->currentUser();

            $content=$this->controller->{$this->action}();
            echo $content;
        } catch(RedirectException $e) {
            header('Location: ' . $e->getUrl());
            die;
        } catch(RouteException $e){
            header('HTTP/1.0 404 Not Found');
            echo $e->getMessage();
        }

    }

    private  function currentUser()
    {
        $id=$_SESSION['id'] ?? null;
        if (isset($id)) {
            $data=UserModel::find($id);
            if (isset($data)){
                $this->controller->setCurrentUser($data);
            }
        }
    }
    private function  getController()
    {
        $controller=$this->route->getControllerName();
        if (!class_exists($controller)) {
            throw new RouteException('Controller not find' .  $controller);

        }
        $this->controller=new $controller();
    }

    private function  getAction()
    {
        $action=$this->route->getActionName();
           if(!method_exists($this->controller, $action)){
               throw new RouteException('Action not find' . $action);
           }
        return $this->action = $action;
    }
}