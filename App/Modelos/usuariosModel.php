<?php
require_once("../Bd/conexion.php");


class Usuarios extends BD{
    public function __construct(){
        $this->db = parent::__construct();
    }

    public function Registrar( $Nombre, $Correo, $Sexo, $Area, $Rol, $Boletin, $Descrip ){
        $statement = $this->db->prepare("INSERT INTO empleado ( nombre, email, sexo, area_id, rol, boletin, descripcion)
                                        VALUE (:Nombre, :Correo, :Sexo, :Area, :Rol, :Boletin, :Descrip)");
        $statement->bindParam(':Nombre',$Nombre);
        $statement->bindParam(':Correo',$Correo);
        $statement->bindParam(':Sexo',$Sexo);
        $statement->bindParam(':Area',$Area);
        $statement->bindParam(':Rol',$Rol);
        $statement->bindParam(':Boletin',$Boletin);
        $statement->bindParam(':Descrip',$Descrip);

        $statement->execute();
    }
    public function Actualizar($Id, $Nombre, $Correo){
        $statement = $this->db->prepare("UPDATE empleado SET  nombre =:Nombre, email = :Correo WHERE id_usuario = :Id");
        $statement->bindParam(':Id',$Id);
        $statement->bindParam(':Nombre',$Nombre);
        $statement->bindParam(':Correo',$Correo);
        $statement->execute();
            
        
    }
    //listamos los usuarios poor id
    public function Listar_id($Id){
        // $rows = null;
         $statement = $this->db->prepare("SELECT *  FROM empleado WHERE id_usuario = :Id ");
         $statement->bindParam(':Id', $Id);
         $statement->execute();
 
         $json= array();
         while($row = $statement->fetch()){  
           $json[]  = array( 
            'id_usuario' => $row['id_usuario'],
                'nombre' => $row['nombre'],
                'email' => $row['email'],
                'sexo' => $row['sexo'], 
                'rol' => $row['rol'],
                'boletin' => $row['boletin'],
                'descripcion' => $row['descripcion'],
           );
         }
         $jsonstring = json_encode($json[0]);
          echo $jsonstring;
     }

     public function Eliminar($Id){
        $statement = $this->db->prepare("DELETE FROM empleado  WHERE id_usuario = :Id");
        $statement->bindParam(':Id', $Id);
        $statement->execute();
    }

    public function Listar(){
        $statement = $this->db->prepare("SELECT *
                                        FROM empleado
                                        INNER JOIN areas
                                        WHERE empleado.area_id = areas.id");
        $statement->execute();
        $json = array();
        while($row = $statement->fetch()){
            $json[] = array(
                
                'id_usuario' => $row['id_usuario'],
                'nombre' => $row['nombre'],
                'email' => $row['email'],
                'sexo' => $row['sexo'],
                'nombre_area' => $row['nombre_area'],
                'boletin' => $row['boletin'],
                'descripcion' => $row['descripcion'],
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
}


?>