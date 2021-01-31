<?php

namespace App\Model;

use Src\AbsctractModel;
use Src\Db;

class BlogModel extends AbsctractModel
{
    public function pushMessage($idUser, $message)
    {
        $db = Db::getInstance();
        $name=$this->checkName();
        $query = 'INSERT INTO `messages`(`id_user`,`name`, `text`, `datetime`)
                VALUES (:idUser,:name,:message,:date);';
        $result = $db->exec($query, __METHOD__, [
            'idUser' => $idUser,
            'name'=> $name,
            'message' => $message,
            'date' => date("Y-m-d H:i:s"),
        ]);
    }

    public function showMessage()
    {
        var_dump($_SESSION);
        $name=$this->checkName();
        $db = Db::getInstance();
        $query = 'SELECT ```name`,`messages` AND FROM `messages` ORDER BY `id` DESC LIMIT 20';
        $posts = $db->fetchAll($query, __METHOD__);
        $userPostsId = array_column($posts, 'id_user');
             /**
             $postUserIds = array_column($posts, 'user_id');
             $userIdsStr = implode(',', array_unique($postUserIds));
             $result = $db->query("SELECT * FROM users WHERE id IN('$userIdsStr')");
             $users = $result->fetchAll(PDO::FETCH_ASSOC);
             $userById = array_combine(array_column($users, 'id'), $users);
              */
         //echo '<pre>';
         //var_dump($posts);

     }

     private function checkName()
     {
         $db =Db::getInstance();
         $id=$_SESSION['id'];
         $query = 'SELECT `Username` FROM `users` WHERE id=:id';
         $result=$db->fetchOne($query,__METHOD__,['id'=>$id]);
         return $result['Username'];

     }
}