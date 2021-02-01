<?php

namespace App\Model;

use Src\AbsctractModel;
use Src\Db;

class BlogModel extends AbsctractModel
{
    private $image;
    public function pushMessage($idUser, $message)
    {
        $db = Db::getInstance();
        $name=$this->checkName();
        $query = 'INSERT INTO `messages`(`id_user`,`name`, `text`, `datetime`, `image`)
                VALUES (:idUser,:name,:message,:date,:image);';
        if($this->image === null) {
            $this->image ='netu';
        }
        $result = $db->exec($query, __METHOD__, [
            'idUser' => $idUser,
            'name'=> $name,
            'message' => $message,
            'date' => date("Y-m-d H:i:s"),
            'image' =>$this->image
            ]);
    }

    public function showMessage()
    {
        $name=$this->checkName();
        $db = Db::getInstance();
        $query = 'SELECT `name`,`text`,`id`,`image`  FROM `messages` ORDER BY `id` DESC LIMIT 20';
        $posts = $db->fetchAll($query, __METHOD__);
        return $posts;
     }

     private function checkName()
     {
         $db =Db::getInstance();
         $id=$_SESSION['id'];
         $query = 'SELECT `Username` FROM `users` WHERE id=:id';
         $result=$db->fetchOne($query,__METHOD__,['id'=>$id]);
         return $result['Username'];

     }

     public function loadFile($file)
     {
           if(file_exists($file)){
               $this->image = $this->genImageName();
               move_uploaded_file( $file , getcwd() . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . $this->image);
           }
     }

     public function genImageName()
     {
         return sha1(mt_rand(1,10000)) . '.jpg';
     }

     public function userMessages($id)
     {
         $db = Db::getInstance();
         $query = 'SELECT `datetime`,`text`,`image`  FROM `messages` WHERE `id_user`=:id ORDER BY `id` DESC LIMIT 20';
         $posts = $db->fetchAll($query, __METHOD__,['id'=>$id]);
         return $posts;
     }

     public function deleteMessages($id)
     {
         $db=Db::getInstance();
         $query = 'DELETE FROM `messages` WHERE id=:id';
         $db->exec($query,__METHOD__,['id'=>$id]);
     }

}