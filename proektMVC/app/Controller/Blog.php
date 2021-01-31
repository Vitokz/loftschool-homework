<?php
namespace App\Controller;

use App\Model\BlogModel;
use Src\AbstractController;
use Src\Db;

class Blog extends AbstractController
{
    public function blog()
    {
       if(!$this->currentUser) {
           $this->redirect('..\html\..\User\registration');
       }
       return $this->view->render('BlogLinks\blog.phtml', []);
    }

    public function pushmessage()
    {
        $message='арсений';//$_POST['message'];
        if(isset($message)) {
            $idUser = $_SESSION['id'];
            $blogModel = new BlogModel();
            $blogModel->pushMessage($idUser, $message);
            return $this->view->render('BlogLinks\blog.phtml', []);
        }
    }

    public function lastmessages()
    {
         $blogModel=new BlogModel();
         $blogModel->showMessage();
    }

}