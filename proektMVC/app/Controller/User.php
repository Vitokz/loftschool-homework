<?php

namespace App\Controller;
use Src;
use App\Model\UserModel;
use Src\AbstractController;

class User extends AbstractController
{

    public function registration()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        $check = true;

        if (empty($name)) {
            $data=['error1'=>'Поле имя не может быть пустым'];
            $check = false;
        }
        if (empty($email)) {
            $data=['error2' => 'Поле email не может быть пустым'];
            $check = false;
        }
        if ((mb_strlen($password1) < 4) || (mb_strlen($password2) < 4)) {
            $data=['error' =>'Длинна пароля должна быть не меньше 4 символов'];
            $check = false;
        } elseif ($password1 !== $password2) {
            $data=['error'=>'Пароли должны совпадать'];
            $check = false;
        }

        if ($check === true) {
            $userModel = new UserModel();
            $userModel->setName($name);
            $userModel->setEmail($email);
            $userModel->setPassword($password1);
            $id = $userModel->saveUser();
            $_SESSION['id']=$id;
            $this->setCurrentUser($id);
            $this->redirect('..\html\..\Blog\blog');
        }
        return $this->view->render('test.phtml', [$data]);
    }

    public function dataprofile()
    {
        $id =//$_POST['idUser'];
        $userModel = new UserModel();
        $userInfo = $userModel->getByID($id);
        var_dump($userInfo);
    }

    public function authorization()
    {
        $email = 'Vito@mail.ru';//$_POST['email'];
        if (isset($email)) {
            $password = 12345;//$_POST['password'];

            $userModel = new UserModel();
            $check = $userModel->getByEmailAndPassword($email, $password);
            if ($check === 'error: User not found') {
                $this->view->assign('error', 'Неверный логин или пароль');
            } else if (isset($check)) {
                $_SESSION['id'] = $check['id'];
                $this->redirect('..\html\..\Blog\blog');
            }
        }
        return $this->view->render('test.phtml');

    }
}