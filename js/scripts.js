$(document).ready(function(){
    Listar_usuarios();
})
//Registrar empleados
$('#Registro').submit(function(e){
    e.preventDefault();
    var Nombre = $('#Nombre').val();
    var Correo = $('#Correo').val();
    var Sexo = $('input[name=sexo]:checked').val();
    var Area = $('#Area').val();
    var Rol = $('input[name=rol]:checked').val();
    var Boletin = $('input[name=boletin]:checked').val();
    var Descrip = $('#Descrip').val();
    var action = "registrar";

    if(Nombre == "" || Correo == "" || Sexo == "" || Area == "" || Rol == "" || Boletin == "" || Descrip == ""){
        Swal.fire({
            icon: 'error',
            title: 'Debes completar los campos!!',
            timer: 2000,
            showConfirmButton: false
          })
    }else{
        $.ajax({
            url:'../App/Controladores/usuariosController.php',
            method:'POST',
            async:true,
            data:{action:action, Nombre:Nombre, Correo:Correo, Sexo:Sexo, Area:Area, Rol:Rol,
                Descrip:Descrip, Boletin:Boletin},
            success:function(response){
                tablaUsuarios.ajax.reload(null, false);
                Swal.fire({
               
                    icon: 'success',
                    title: 'Registrado Exítosamente!!',
                    showConfirmButton: false,
                    timer: 1500
                    
                  }).then((result) => {
                    if (result.isConfirmed) {
                        
                        tablaUsuarios.ajax.reload(null, false);
                    }
                    $('#registrar').modal('hide');
                    $('#Registro').trigger('reset');
                })
            }
    
    });

    }

   



})
//Listar empleados

function Listar_usuarios(){
    var action = 'listar';
    tablaUsuarios = $('#tablaUsuarios').DataTable({
        "language": {

            "lengthMenu": "Mostrar "+ 
                                  `   <select class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value= "10">10</option>
                                        <option value= "25">25</option>
                                        <option value= "50">50</option>
                                        <option value= "100">100</option>
                                        <option value= "-1">Todos</option>
                                    </select> `+
                                    " registros por pagina",
            "zeroRecords": "Registro no encontrado",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtrado de _MAX_ total registros)",
            "search": "Buscar:",
            "paginate":{
                "next":"Siguiente",
                "previous": "Anterior"
            }
        },
        "ajax":{
            "url":'../App/Controladores/usuariosController.php',
            "method":'POST',
            "data":{action:action},
            "dataSrc":""

        },
        "columns":[
           
            {"data":"id_usuario"},
            {"data":"nombre"},
            {"data":"email"},
            {"data":"sexo"},
            {"data":"nombre_area"},
            {"data":"boletin"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button  class='btn btn-warning btn-sm btnEditar'><i class='material-icons'>edit</i>Editar</button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i>Eliminar</button></div></div>"}
        ]  
    });
}
//editar usuarios

$(document).on('click',".btnEditar", function(e){
    e.preventDefault();
    var action ="editar";
        fila = $(this).closest('tr');
   var  Id = parseInt(fila.find('td:eq(0)').text());
   $.ajax({
    url:'../App/Controladores/usuariosController.php',
    method:'POST',
    async:true,
    data:{action:action, Id:Id},
    success:function(response){
        const usuario = JSON.parse(response);
        $('#id').val(usuario.id_usuario);
        $('#nombre').val(usuario.nombre);
        $('#correo').val(usuario.email);
        $('#Sexo').val(usuario.sexo);
        $('#area').val(usuario.nombre_area);
        $('#cbox1').val(usuario.boletin);
        $('#descrip').val(usuario.descripcion);
        $('#editar').modal('show');
       
    }
}); 

$('#editar').submit(function(e){
    e.preventDefault();
    var Id = $('#id').val();
    var Nombre = $('#nombre').val();
    var Correo = $('#correo').val();
    console.log(Id);
    var action = 'actualizar';
    if(Nombre == "" || Correo == "" ){
        Swal.fire({
            icon: 'error',
            title: 'Debes completar los campos!!',
            timer: 2000,
            showConfirmButton: false
          })
    }else{
        $.ajax({
            url:'../App/Controladores/usuariosController.php',
            method:'POST',
            async:true,
            data:{action:action, Id:Id, Nombre:Nombre, Correo:Correo},
            success:function(response){
                tablaUsuarios.ajax.reload(null, false);
                Swal.fire({
                    icon: 'success',
                    title: 'Editado Exítosamente!!',
                    showConfirmButton: false,
                    timer: 1800
                    
                  });
            }
        });
    }
    
    $('#editar').modal('hide'); 
}); 
});


$(document).on('click', '.btnBorrar', function(e){
    e.preventDefault();
    fila = $(this).closest("tr");
  var  Id = parseInt(fila.find('td:eq(0)').text());

    Swal.fire({
        title: 'Estas seguro?',
        text: "Esta actividad no tiene regreso!",
        icon: 'warning',
        showCancelButton: 'cancelar         ',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if(result.isConfirmed){
           var action = 'eliminar';
           $.ajax({
            url:'../App/Controladores/usuariosController.php',
            method: 'POST',
            async:true,
            data:{action:action, Id:Id,},

            success: function(response){
                tablaUsuarios.ajax.reload(null, false);
                console.log(response);

            }
            

           })
           Swal.fire({ 
            icon: 'success',
            title: 'Eliminado Exítosamente!!',
            showConfirmButton: false,
            timer: 1500
    })

        }
    });

})