<?php
namespace App\Controller;

use App\Model\BlogModel;
use App\Model\LoadFile;
use Src\AbstractController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Blog extends AbstractController
{
    private $twig;
    public function __construct()
    {
        $loader = new FilesystemLoader(PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'View');
        $this->twig = new Environment($loader, ['debug' => true]);
    }
    public function blog()
    {
       if($this->currentUser == '') {
           $this->redirect(DIRECTORY_SEPARATOR.'User'.DIRECTORY_SEPARATOR.'user');
       }else {
           $blogModel = new BlogModel();
           $messages = $blogModel->showMessage();
           return $this->twig->render(DIRECTORY_SEPARATOR . 'BlogLinks' .DIRECTORY_SEPARATOR . 'blog.twig', ['messages' => $messages, 'user' => $_SESSION['id']]);
           //return  $this->view->render('BlogLinks'. DIRECTORY_SEPARATOR .'blog.phtml', ['messages' => $messages, 'user'=>$_SESSION['id']]);
       }
    }

    public function pushmessage()
    {
        $message=$_POST['message'];
        if($message !== '') {
            $idUser = $_SESSION['id'];
            $blogModel = new BlogModel();

            if(isset($_FILES['image']['tmp_name'])) {
                $load=new LoadFile();
                 $image=$load->loadFile($_FILES['image']['tmp_name']);
            }

            $blogModel->pushMessage($idUser, $message,$image);
            $blogModel=new BlogModel();
            $messages=$blogModel->showMessage();
            return $this->twig->render(DIRECTORY_SEPARATOR . 'BlogLinks' .DIRECTORY_SEPARATOR . 'blog.twig', ['messages'=>$messages, 'user'=>$_SESSION['id']]);
            //return $this->view->render('BlogLinks'.DIRECTORY_SEPARATOR.'blog.phtml', ['messages' => $messages, 'user'=>$_SESSION['id']]);
        } else {
            var_dump('Сообщение не может быть пустым');
            $blogModel=new BlogModel();
            $messages=$blogModel->showMessage();
            return $this->twig->render(DIRECTORY_SEPARATOR . 'BlogLinks' .DIRECTORY_SEPARATOR . 'blog.twig', ['messages'=>$messages, 'user'=>$_SESSION['id']]);
            //return  $this->view->render('BlogLinks'.DIRECTORY_SEPARATOR.'blog.phtml', ['messages' => $messages, 'user'=>$_SESSION['id']]);
        }
    }

    public function lastmessages()
    {
         $blogModel=new BlogModel();
         $messages=$blogModel->showMessage();
        return $this->twig->render(DIRECTORY_SEPARATOR . 'BlogLinks' .DIRECTORY_SEPARATOR . 'blog.twig', ['messages'=>$messages, 'user'=>$_SESSION['id']]);
         //return  $this->view->render('BlogLinks'.DIRECTORY_SEPARATOR.'blog.phtml', ['messages' => $messages, 'user'=>$_SESSION['id']]);
    }

    public function apiformat()
    {
        $id=$_POST['idUser'];
        $blogModel=new BlogModel();
        $messages=$blogModel->userMessages($id);
        if (isset($messages)){
            return json_encode($messages);
        } else return 'нету данных ';
    }
}