<?php
require('../App/Modelos/areasModel.php');
$areas = new Areas();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados| NEXURA INTERNACIONAL.</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   
    <!-- Estilos propios -->
    <link href="../css/index.css" rel="stylesheet" />
    <!-- Icons para importarlos -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="container">
    <h1>Bienvenidos señores| NEXURA INTERNACIONAL.</h1>
     <!-- BOTTON PARA LLAMAR EL MODAL DE REGISTRO-->
    <button type="button" class= "mt-5 mx-5 btn btn-success " data-bs-toggle="modal" data-bs-target="#registrar" ><i class="material-icons">library_add</i>  Registrar Usuario</button><br><br>
    <div class="modal fade" id="registrar" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitle">Registrar Empleados</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close">X</button>
                        </div>
                        <div class="modal-body">
                        <form  id="Registro" >
                        
                            <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="cedula">* Nombre completo:</label>
                                  <input type="text" class="form-control"  name="Cedula" id="Nombre" placeholder="Nombre Completo"  >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                    <label for="nombre">* Correo electrónico:</label>
                                    <input type="email" class="form-control"  id="Correo" placeholder="correo@hotmail.com"  >
                                </div>
                             </div>
                                <div class="form-group col-md-6 p-2">
                                </div>
                              <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                <label for="apellido">* Sexo:</label><br>
                                  <label><input type="radio" id="cbox1" name="sexo" value="M"> Masculino</label><br>
                                  <label><input type="radio" id="cbox1" name="sexo" value="F"> Femenino</label>
                                </div>
                                <div class="form-group col-md-6 p-2">
                                  <label for="direccion">Area:</label>
                                  <select class=" form-control" name="Rol" id="Area" >
                                    <option selected>Selecciona el area </option>
                                    <?php
                                     
                                     
                                     
                                      $area = $areas->Listar_area();
                                    if($area !=null){

                                      foreach($area as $arr){ 
                                    ?>
                                      <option value="<?php echo $arr['id']; ?>"><?php echo $arr['nombre_area']; ?></option>
                                      <?php
                                    }
                                  }
                                    ?>
                                    
                                   
                                  </select>
                                </div>
                                <div class="form-group col-md-6 p-2">
                                <label for="apellido">* Roles:</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="desarrollador"> Desarrollador</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="analista"> Analista</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="tester"> Tester</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="diseñador"> Diseñador</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="profesional PMO"> Profesional PMO</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="profesional de servicios"> Profesional de servicios</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="auxiliar administrativo"> Auxiliar administrativo</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="codirector"> Codirector</label><br>
                                </div>
                                </div>
                            
                                <div class="form-row d-flex">
                                <label for="correo">Descripción:</label>
                                  <textarea name="Descrip" id="Descrip" cols="30" rows="10" class="form-control" placeholder="Descripción"></textarea><br><br>
                                 
                                </div>
                                <label> Deseo recibir boletin informativo</label><br>
                                 <label for=""> <input type="checkbox"  name="boletin" id="cbox1" value="si"> Si</label><br>
                                 <label for=""> <input type="checkbox" name="boletin" id="cbox1" value="no"> No </label><br>
                              <br>
                           
                            <button type="submit" id="registrar" class="btn btn-primary">Registrar usuario</button>
                            <button type="button"  data-bs-dismiss="modal"  class=" btn-close btn btn-warning">Cancelar</button>
                          </form>
                        </div>

                      </div>

                    </div>

                    

                  </div><br>
                   <!-- TABLA PARA LISTAR LOS USUARIOS-->
                  <table class="table table-striped table-bordered table-condensed" style="width:100%" id="tablaUsuarios">
                  <thead class="text-center">
                    <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                      <th>Correo</th>
                      <th>Sexo</th>
                      <th>Area</th>
                       
                      <th>Boletin</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                    <tbody>
                    </tbody>
                  </table>
 <!-- FORMULARIO PARA EDITAR-->
                  <div class="modal fade" id="editar" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitle">Editar Empleados</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close">X</button>
                        </div>
                        <div class="modal-body">
                        <form  id="editar" >
                          <input type="hidden" id="id">
                            <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="cedula">* Nombre completo:</label>
                                  <input type="text" class="form-control"  name="Cedula" id="nombre" placeholder="Nombre Completo"  >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                    <label for="nombre">* Correo electrónico:</label>
                                    <input type="email" class="form-control"  id="correo" placeholder="correo@hotmail.com"  >
                                </div>
                             </div>
                                <div class="form-group col-md-6 p-2">
                                </div>
                              <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                <label for="apellido">* Sexo:</label><br>
                                  <label><input type="radio" id="Sexo" name="Sexo" value="M"> Masculino</label><br>
                                  <label><input type="radio" id="Sexo" name="Sexo" value="F"> Femenino</label>
                                </div>
                                <div class="form-group col-md-6 p-2">
                                  <label for="direccion">Area:</label>
                                  <select class=" form-control" name="Rol" id="area" >
                                    <option selected>Selecciona el area </option>
                                    <?php
                                     
                                     
                                     
                                      $area = $areas->Listar_area();
                                    if($area !=null){

                                      foreach($area as $arr){ 
                                    ?>
                                      <option value="<?php echo $arr['id']; ?>"><?php echo $arr['nombre_area']; ?></option>
                                      <?php
                                    }
                                  }
                                    ?>
                                    
                                   
                                  </select>
                                </div>
                                <div class="form-group col-md-6 p-2">
                                <label for="apellido">* Roles:</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="desarrollador"> Desarrollador</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="analista"> Analista</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="tester"> Tester</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="diseñador"> Diseñador</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="profesional PMO"> Profesional PMO</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="profesional de servicios"> Profesional de servicios</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="auxiliar administrativo"> Auxiliar administrativo</label><br>
                                  <label><input type="checkbox" id="cbox1" name="rol" value="codirector"> Codirector</label><br>
                                </div>
                                </div>
                            
                                <div class="form-row d-flex">
                                <label for="correo">Descripción:</label>
                                  <textarea name="Descrip" id="descrip" cols="30" rows="10" class="form-control" placeholder="Descripción"></textarea><br><br>
                                 
                                </div>
                                <label> Deseo recibir boletin informativo</label><br>
                                 <label for=""> <input type="checkbox"  name="boletin" id="cbox1" value="si"> Si</label><br>
                                 <label for=""> <input type="checkbox" name="boletin" id="cbox1" value="no"> No </label><br>
                              <br>
                           
                            <button type="submit" id="registrar" class="btn btn-primary">Registrar usuario</button>
                            <button type="button"  data-bs-dismiss="modal"  class=" btn-close btn btn-warning">Cancelar</button>
                          </form>
                        </div>

                      </div>

                    </div>

                    

                  </div>

                  </div>
                  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
                  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
     <!-- aqui importamos css local -->
     <!-- jQuery, Popper.js, Bootstrap JS -->
     <script src="../App/Assets/jquery/jquery-3.3.1.min.js"></script>
     <script src="../App/Assets/popper/popper.min.js"></script>
     <script src="../App/Assets/bootstrap/js/bootstrap.min.js"></script>
                    
     <!-- datatables JS -->
     <script type="text/javascript" src="../App/Assets/datatables/datatables.min.js"></script>  
     <!-- sweet alert JS -->
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <!-- Escripts propios-->
     <script src="../js/scripts.js"></script>
</body>
</html>