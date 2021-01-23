<?php

class Burgers
{
    public function checkUsersEmail( string $email)
    {
        $db = Db::getInstance();
        $query = "SELECT * FROM emails WHERE email = :email";
        $result = $db->fetchOne($query, __METHOD__,[':email' => $email]);
        return $result;
    }

    public function incOrders( int $userID)
    {
        $db = Db::getInstance();
        $query = "UPDATE emails SET countOrders=countOrders + 1 where id = $userID";
        $result = $db->exec($query, __METHOD__);
    }

    public function createUser( string $email)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO emails(email, countOrders) VALUES (:email, 1)";
        $result = $db->exec($query, __METHOD__, ['email' => $email]);
        if (!$result) {
            return false;
        }

        return $db->lastInsertId();
    }

    public function addOrder(int $userID, $orderInfo)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO orderdetails(`idUser`, `orderDate`, `adressOrder`) VALUES (:idUser, :created_at , :address)";
        $result = $db->exec(
            $query,
            __METHOD__,
            [
                ':idUser' => $userID,
                ':created_at' => date('Y-m-d H:i:s'),
                ':address' => $orderInfo,
            ]
        );
        if(!$result) {
            return false;
        }
        return $db->lastInsertId();
    }

}