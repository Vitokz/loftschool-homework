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
           $this->redirect(DIRECTORY_SEPARATOR.'User');
       }
        $blogModel=new BlogModel();
        $messages=$blogModel->showMessage();
        return  $this->view->render('BlogLinks'. DIRECTORY_SEPARATOR .'blog.phtml', ['messages' => $messages, 'user'=>$_SESSION['id']]);

    }

    public function pushmessage()
    {
        $message=$_POST['message'];
        if($message !== '') {
            $idUser = $_SESSION['id'];
            $blogModel = new BlogModel();

            if(isset($_FILES['image']['tmp_name'])) {
                $blogModel->loadFile($_FILES['image']['tmp_name']);
            }

            $blogModel->pushMessage($idUser, $message,);
            $blogModel=new BlogModel();
            $messages=$blogModel->showMessage();
            return $this->view->render('BlogLinks'.DIRECTORY_SEPARATOR.'blog.phtml', ['messages' => $messages, 'user'=>$_SESSION['id']]);
        } else {
            var_dump('Сообщение не может быть пустым');
            $blogModel=new BlogModel();
            $messages=$blogModel->showMessage();
            return  $this->view->render('BlogLinks'.DIRECTORY_SEPARATOR.'blog.phtml', ['messages' => $messages, 'user'=>$_SESSION['id']]);
        }
    }

    public function lastmessages()
    {
         $blogModel=new BlogModel();
         $messages=$blogModel->showMessage();
         return  $this->view->render('BlogLinks'.DIRECTORY_SEPARATOR.'blog.phtml', ['messages' => $messages, 'user'=>$_SESSION['id']]);
    }

    public function apiformat()
    {
        $id=$_POST['idUser'];
        $blogModel=new BlogModel();
        $messages=$blogModel->userMessages($id);
        if (isset($messages)){
            header('Content-type: application'.DIRECTORY_SEPARATOR.'json');
            return json_encode($messages);
        } else return 'нету данных ';
    }
}