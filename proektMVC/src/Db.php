<?php
namespace Src;
include PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . '\database\SQLhost.php';

class Db
{
    private static $instance;
    private $pdo;
    private $log= [];

    private function __construct()
    {

    }

    private function __clone()
    {

    }


    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect()
    {
        if (!$this->pdo) {
            $this->pdo = new \PDO("mysql:host=" .HOST_ID .";dbname=" . DATABASE_NAME , USERNAME_SQL, PASSWORD_SQL);
        }
        return $this->pdo;
    }


    public function exec(string $query, string $method = '', array $params = [])
    {
        $this->connect();
        $t = microtime(1);
        $query = $this->pdo->prepare($query);
        $ret = $query->execute($params);
        $t=  microtime(1) - $t;

        if (!$ret) {
            if ($query->errorCode()) {
                trigger_error(json_encode($query->errorInfo()));
            }
            return false;
        }

        $affectedRows = $query->rowCount();
        $this->log[]= [$query, $t ,$method, $affectedRows];

        return $affectedRows;
    }


    public function lastInsertId()
    {
        $this->connect();
           return $this->pdo->lastInsertId();
    }

    public function getLog()
    {
        return $this->log;
    }

    public function fetchAll(string $query, $method = '', array $params = [])
    {
        $this->connect();
        $t = microtime(1);
        $query = $this->pdo->prepare($query);
        $ret = $query->execute($params);
        $t=  microtime(1) - $t;

        if (!$ret) {
            if ($query->errorCode()) {
                trigger_error(json_encode($query->errorInfo()));
            }
            return false;
        }

        $data = $query->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $query->rowCount();
        $this->log[]= [$query, $t ,$method, $affectedRows];

        return $data;
    }

    public function fetchOne(string $query, string $method = '',array $params = [])
    {
        $this->connect();
        $t = microtime(1);
        $query = $this->pdo->prepare($query);
        $ret = $query->execute($params);
        $t=  microtime(1) - $t;

        if (!$ret) {
            if ($query->errorCode()) {
                trigger_error(json_encode($query->errorInfo()));
            }
            return false;
        }

        $data = $query->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $query->rowCount();
        $this->log[]= [$query, $t ,$method, $affectedRows];
        if (!$data) {
            return false;
        }
        return reset($data);
    }

}
