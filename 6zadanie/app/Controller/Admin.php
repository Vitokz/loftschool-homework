<?php
namespace App\Controller;

use App\Model\BlogModel;
use App\Model\UserModel;
use Src\AbstractController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Admin extends AbstractController
{
    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'View');
        $this->twig = new Environment($loader, ['debug' => true]);
    }

    public function deletemessage()
    {
        if($_SESSION['id']=== ADMIN_ID) {
            $id = $_GET['id'];
            $post=BlogModel::find($id);
            $post->delete();
            $this->redirect(DIRECTORY_SEPARATOR .'Blog'.DIRECTORY_SEPARATOR.'blog');
        }else{$this->redirect(DIRECTORY_SEPARATOR .'Blog'.DIRECTORY_SEPARATOR.'blog');}
    }

    public function createuser()
    {
        $name=$_POST['name'];
        if($name !== null) {
            $email = $_POST['email'];
            if ($email !== null) {
                $password = $_POST['password'];
                if (mb_strlen($password) >= 4) {
                    $attributes = [
                        'Username' => $name,
                        'email' => $email,
                        'password' => UserModel::getPasswordHash($password),
                        'date' => date("Y-m-d H:i:s")
                    ];
                    UserModel::create($attributes);
                    $this->redirect(DIRECTORY_SEPARATOR .'Blog'.DIRECTORY_SEPARATOR.'blog');
                }
            }
        } else {
            $this->redirect(DIRECTORY_SEPARATOR .'Blog'.DIRECTORY_SEPARATOR.'blog');
        }
    }

    public function editor()
    {  $users=[];
        $all = UserModel::where('id','>',0)
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($all as $data){
            $users[]=[
                'id'=>$data->id,
                'Username'=>$data->Username,
                'email'=>$data->email,
                'password'=>$data->password,
                'date'=>$data->date,
                ];
        }
        return $this->twig->render(DIRECTORY_SEPARATOR . 'EditorUser' .DIRECTORY_SEPARATOR . 'editorUser.twig' ,['userData' => $users, 'user' => $_SESSION['id']]);
    }
    public function editting()
    {
        $id = $_GET['id'];
        $data=UserModel::find($id);

        return $this->twig->render(DIRECTORY_SEPARATOR . 'EditorUser' .DIRECTORY_SEPARATOR . 'editting.twig' ,['profile' => $data, 'user' => $_SESSION['id']]);
    }

    public function endedit()
    {
          $id=$_POST['id'];
          $name=$_POST['name'];
          if($name !== null) {
              $email = $_POST['email'];
              if ($email !== null) {
                  $password = $_POST['password'];
                  if ($password !== null) {

                      $date = date("Y-m-d H:i:s");
                      $password = UserModel::getPasswordHash($_POST['password']);
                      $user = UserModel::find($id);

                      $user->Username = $name;
                      $user->email = $email;
                      $user->password = $password;
                      $user->date = $date;

                      $user->save();
                      $this->redirect(DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'editor');
                  }
              }
          }
    }
}
