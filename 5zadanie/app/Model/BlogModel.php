<?php

namespace App\Model;

use Src\AbsctractModel;
use Src\Db;

class BlogModel extends AbsctractModel
{
    public function pushMessage($idUser, $message, $image = null)
    {
        $db = Db::getInstance();
        $name=$this->checkName();
        $load=new LoadFile();
        $query = 'INSERT INTO `messages`(`id_user`,`name`, `text`, `datetime`, `image`)
                VALUES (:idUser,:name,:message,:date,:image);';
        if($image === null) {
            $image ='netu';
        }
        $result = $db->exec($query, __METHOD__, [
            'idUser' => $idUser,
            'name'=> $name,
            'message' => $message,
            'date' => date("Y-m-d H:i:s"),
            'image' =>$image
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