<?php
namespace App\Controller;

use App\Model\BlogModel;
use App\Model\LoadFile;
use App\Model\UserModel;
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
           $posts=$this->messagesPrint();
           return $this->twig->render(DIRECTORY_SEPARATOR . 'BlogLinks' .DIRECTORY_SEPARATOR . 'blog.twig' ,['messages' => $posts, 'user' => $_SESSION['id']]);
           //return  $this->view->render('BlogLinks'. DIRECTORY_SEPARATOR .'blog.phtml', ['messages' => $messages, 'user'=>$_SESSION['id']]);
       }
    }

    public function pushmessage()
    {

        $message = $_POST['message'];
        if($message !== '') {
            $image=null;
            $idUser = $_SESSION['id'];
            $name=UserModel::where('id','=',$idUser)->first();

            if(isset($_FILES['image']['tmp_name'])) {
                $load=new LoadFile();
                 $image=$load->loadFile($_FILES['image']['tmp_name']);
            }
            if($image === null) {
                $image ='netu';
            }

            $result = [
                'id_user' => $idUser,
                'name'=> $name->Username,
                'text' => $message,
                'datetime' => date("Y-m-d H:i:s"),
                'image' =>$image
            ];
            BlogModel::create($result);
            $posts=$this->messagesPrint();
            return $this->twig->render(DIRECTORY_SEPARATOR . 'BlogLinks' .DIRECTORY_SEPARATOR . 'blog.twig', ['messages'=>$posts, 'user'=>$_SESSION['id']]);

        } else {
            var_dump('Сообщение не может быть пустым');
            $posts=$this->messagesPrint();
            return $this->twig->render(DIRECTORY_SEPARATOR . 'BlogLinks' .DIRECTORY_SEPARATOR . 'blog.twig', ['messages'=>$posts, 'user'=>$_SESSION['id']]);
            //return  $this->view->render('BlogLinks'.DIRECTORY_SEPARATOR.'blog.phtml', ['messages' => $messages, 'user'=>$_SESSION['id']]);
        }
    }

    public function lastmessages()
    {
        $posts=$this->messagesPrint();
        return $this->twig->render(DIRECTORY_SEPARATOR . 'BlogLinks' .DIRECTORY_SEPARATOR . 'blog.twig', ['messages'=>$posts, 'user'=>$_SESSION['id']]);
         //return  $this->view->render('BlogLinks'.DIRECTORY_SEPARATOR.'blog.phtml', ['messages' => $messages, 'user'=>$_SESSION['id']]);
    }

    public function apiformat()
    {
        $id=$_POST['idUser'];

        $postsa=[];

        $messages=BlogModel::where('id_user','=',$id)
        ->orderBy('id', 'DESC')
        ->limit(20)
        ->get();

        foreach ($messages as $posts){
            $postsa[]=[
                'name'=>$posts->name,
                'text'=>$posts->text,
                'image'=>$posts->image];
        }

        if (isset($messages)){
            return json_encode($postsa);
        } else return 'нету данных ';
    }

    public static function messagesPrint()
    {
        $postsa=[];
        $messages = BlogModel::where('id','>',0)
            ->orderBy('id', 'DESC')
            ->limit(20)
            ->get();

        foreach ($messages as $posts){
            $postsa[]=[
                'id'=>$posts->id,
                'id_user'=>$posts->id_user,
                'name'=>$posts->name,
                'text'=>$posts->text,
                'datetime'=>$posts->datetime,
                'image'=>$posts->image];
        }
        return $postsa;
    }
}