<?php
class BD{

    protected $db;
    private $driver = "mysql";
    private $host = "localhost";
    private $bd = "desarrollo_php";
    private $usuario = "root";
    private $password = "";


    public function __construct(){
        try{
            $db = new PDO("{$this->driver}:host={$this->host};dbname={$this->bd}", $this->usuario, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }catch(PDOException $e){
            echo" Error no Conecto".$e->getMessage();
        }
    }
}

 
?>