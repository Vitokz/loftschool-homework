<?php

namespace App\Controller;

use Src;
use App\Model\UserModel;
use Src\AbstractController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class User extends AbstractController
{
    private $twig;
    public function __construct()
    {
        $loader = new FilesystemLoader(PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'View');
        $this->twig = new Environment($loader, ['debug' => true]);
    }

    public function user()
    {
        if(isset($_SESSION['id'])){
            $this->redirect(DIRECTORY_SEPARATOR.'Blog'.DIRECTORY_SEPARATOR.'blog');
        } else {
            return $this->twig->render(  DIRECTORY_SEPARATOR . 'UserLinks' .DIRECTORY_SEPARATOR . 'regAndAuth.twig', []);
            //return $this->view->render('UserLinks'.DIRECTORY_SEPARATOR.'regAndAuth.phtml', []);
        }
    }

    public function registration()
    {
       if(!isset($_SESSION['id'])) {
           $name = $_POST['name'];
           $email = $_POST['email'];
           $password1 = $_POST['password1'];
           $password2 = $_POST['password2'];

           $check = true;

           if (empty($name)) {
               $data = ['error1' => 'Поле имя не может быть пустым'];
               $check = false;
           }
           if (empty($email)) {
               $data = ['error2' => 'Поле email не может быть пустым'];
               $check = false;
           }
           if ((mb_strlen($password1) < 4) || (mb_strlen($password2) < 4)) {
               $data = ['error' => 'Длинна пароля должна быть не меньше 4 символов'];
               $check = false;
           } elseif ($password1 !== $password2) {
               $data = ['error' => 'Пароли должны совпадать'];
               $check = false;
           }

           if ($check === true) {
               $userModel = new UserModel();
               $userModel->setName($name);
               $userModel->setEmail($email);
               $userModel->setPassword($password1);
               $id = $userModel->saveUser();
               $_SESSION['id'] = $id;
               $this->setCurrentUser($id);

               $this->redirect(DIRECTORY_SEPARATOR . 'Blog' . DIRECTORY_SEPARATOR . 'blog');
           } else{
               return $this->twig->render(DIRECTORY_SEPARATOR . 'UserLinks' .DIRECTORY_SEPARATOR . 'regAndAuth.twig', []);
           }
       }
        $this->redirect(DIRECTORY_SEPARATOR.'Blog'.DIRECTORY_SEPARATOR.'blog');
        //return $this->view->render('UserLinks'.DIRECTORY_SEPARATOR.'regAndAuth.phtml', ['errors'=>$data]);


    }

    public function dataprofile()
    {
        if(isset($this->currentUser)) {
            $id = $_SESSION['id'];
            $userModel = new UserModel();
            $userInfo = $userModel->getByID($id);
            return $this->twig->render(DIRECTORY_SEPARATOR . 'UserLinks' .DIRECTORY_SEPARATOR . 'ProfileData.twig', [
                'id'=>$userInfo['id'],
                'name'=>$userInfo['Username'],
                'email'=>$userInfo['email'],
                'regDate'=>$userInfo["date"]]);
            /**return $this->view->render('UserLinks'.DIRECTORY_SEPARATOR.'ProfileData.phtml', [
                'id'=>$userInfo['id'],
                'name'=>$userInfo['Username'],
                'email'=>$userInfo['email'],
                'regDate'=>$userInfo["date"]
                ]);
             */
        } else {
            $this->redirect(DIRECTORY_SEPARATOR.'User'.DIRECTORY_SEPARATOR.'user');
        }
    }

    public function authorization()
    {
        $email = $_POST['email'];
        if (isset($email)) {
            $password = $_POST['password'];

            $userModel = new UserModel();
            $check = $userModel->getByEmailAndPassword($email, $password);
            if ($check === 'error: User not found') {
                $data = ['error1' => 'Неверная почта или пароль'];
            } else if (isset($check)) {
                $_SESSION['id'] = $check['id'];
                $this->redirect(DIRECTORY_SEPARATOR.'Blog'.DIRECTORY_SEPARATOR.'blog');
            }
        }
        return $this->twig->render(DIRECTORY_SEPARATOR . 'UserLinks' .DIRECTORY_SEPARATOR . 'regAndAuth.twig', ['errors' => $data]);
        //return $this->view->render('UserLinks'.DIRECTORY_SEPARATOR.'regAndAuth.phtml', ['errors'=>$data]);

    }
}