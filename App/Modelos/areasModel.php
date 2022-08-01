<?php
require_once("conexion.php");


class Areas extends BD{

    public function __construct(){
        $this->db = parent::__construct();
    }

    public function Listar_area(){
        
        
        $rows = null;
        $statement = $this->db->prepare("SELECT *
                                        FROM areas");
        $statement->execute();
        while($result = $statement->fetch()){
            $rows[] = $result;
        }
        return $rows;
    }




    public function List_Clientes(){
        
    }

}

