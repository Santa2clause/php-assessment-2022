<?php

class ConnectDb {

    // Hold the class instance.
    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $name = 'assessment';

    private function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};
            dbname={$this->name}",
            $this->user,$this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            unset($this->name,$this->pass);

            //echo 'Connection Success';
        } catch (PDOException $e) {
            //echo 'Connection failed';
            echo "No Active Connection Available";
            exit();
        }
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new ConnectDb();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

$instance = ConnectDb::getInstance();
$con = $instance->getConnection();