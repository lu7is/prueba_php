<?php
require_once("../Modelos/usuariosModel.php");

//registrar usuarios
if($_POST['action'] == 'registrar'){

    $control = new Usuarios();

    
     $Nombre = $_POST['Nombre'];
     $Correo = $_POST['Correo'];
     $Sexo = $_POST['Sexo'];
     $Area = $_POST['Area'];
     $Rol = $_POST['Rol'];
     $Boletin = $_POST['Boletin'];
     $Descrip = $_POST['Descrip'];
     

    $control->Registrar( $Nombre, $Correo, $Sexo, $Area, $Rol, $Boletin, $Descrip );
    
}
//listar usuarios
if($_POST['action'] == 'listar'){
    $listar = new Usuarios();
    $listar->Listar();
}

//BUSCAMOS EL USUARIO POR ID
if($_POST['action'] == 'editar'){
   
    $Editar = new Usuarios();
    $Id = $_POST['Id'];
    $Editar->Listar_id($Id);
 }

//EDITAR USUARIOS
if($_POST['action'] == 'actualizar'){
    $Editar = new Usuarios();

    $Id = $_POST['Id'];
    $Nombre = $_POST['Nombre'];
    $Correo =  $_POST['Correo'];

    $Editar->Actualizar($Id, $Nombre,$Correo);
}

if($_POST['action'] == 'eliminar'){
    $Eliminar = new Usuarios();

    $Id = $_POST['Id'];

    $Eliminar->Eliminar($Id);
}
?>