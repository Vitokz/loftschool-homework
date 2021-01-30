<?php
namespace App\Model;
use Src\AbsctractModel;
use Src\Db;

class UserModel extends AbsctractModel
{
   private $name;
   private $email;
   private $password;

   public function __construct()
   {
   }


    public function setName($name): void
    {
        $this->name = $name;
    }


    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $this->getPasswordHash($password);
    }


   public function saveUser()
   {
       $db=Db::getInstance();
       $query="INSERT INTO `users`(`Username`, `email`, `password`, `date`)
                VALUES (:Username, :email, :password, :date)";
       $db->exec($query,__METHOD__,[
           'Username'=>$this->name,
            'email'=>$this->email,
             'password'=>$this->password,
              'date' => date("Y-m-d H:i:s")
       ]);
       $id=$db->lastInsertId();
       return $id;
   }

   public function getPasswordHash(string $password) : string
   {
       return md5($password . 'aabbcc55');
   }

   public function getByID($id)
   {
       $db=Db::getInstance();
       $query="SELECT * FROM `users` WHERE id=:id";
       $data = $db->fetchOne($query,__METHOD__,['id'=>$id]);
       if (empty($data)) {
           return 'error: User not found';
       }
       return $data;

   }

    public function getByEmailAndPassword($email, $password)
    {
        $db=Db::getInstance();
        $query="SELECT * FROM `users` WHERE email=:email AND password=:password";
        $data = $db->fetchOne($query,__METHOD__,['email'=>$email, 'password'=>$this->getPasswordHash($password)]);
        if (empty($data)) {
            return 'error: User not found';
        }
        return $data;

    }
}