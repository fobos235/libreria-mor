<?php 
    include_once("../conexion.php");
    include_once("partials/cabecera.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comentarios de los clientes</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="row">
            <h5><a href="" title="Regresar al panel de administración" class="btn waves-circle"
                    style="padding-left: 8;"><i class="material-icons waves-effect left">arrow_back</i></a> Comentarios
                de los
                clientes</h5>
        </div>
        <!-- Tabla dinámica -->



        <h5>Libros disponibles</h5>
        <table class="striped display" id="tabla">
            <thead>
                <tr>
                    <th>Correo</th>
                    <th>Comentario</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $database = new Conecta();
                $db=$database->open();
                $sql = $db->prepare("SELECT * FROM contacto"); 
                $sql->execute();
                while($fila = $sql->fetch()) {
                    # code...     
            ?>
                <tr>
                    <td><?php echo $fila['correo'];?></td>
                    <td><?php echo $fila['comentario'];?></td>
                    <td><?php echo $fila['status'];?></td>
                    <td>
                        <style>
                        .btn {
                            padding: 0;
                        }
                        </style>
                        <a href="#modal1" class="btn waves-effect waves-circle modal-trigger res"  id="<?php echo $fila['id']; ?>" title="Responder" target=""><i
                                class="material-icons">message</i></a>
                        <a class="waves-effect waves-circle btn modal-trigger red" href="#modal2"  title="Eliminar"><i
                                class="material-icons">delete</i></a>
                    </td>
                </tr>
                <?php
                }
        ?>
            </tbody>
        </table>
        

        <!-- Modal de respuesta -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>Responder a <?php echo $fila['correo']; ?></h4>
                <p>Escribe un mensaje</p>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>

        <!-- Modal de eliminación (no funciona) -->
        <div id="modal2" class="modal">
            <div class="modal-content">
                <h4>Eliminar comentario</h4>
                <p> El comentario será eliminado ¿Deseas continuar?</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-close waves-effect waves-green btn red" style="padding: 3px;"><i
                        class="material-icons right">delete</i> Eliminar </a>
            </div>
        </div>



        <!-- SCRIPTS -->
        <script src="../js/materialize.min.js"></script>
        <script>
        // Inicializacion
        $(document).ready(function() {
            $('.collapsible').collapsible();
            $('.dropdown-trigger').dropdown();
            $('.sidenav').sidenav();
            $('select').formSelect();
            //$('.modal').modal();
            $('#tabla').DataTable({
                "columnDefs": [{
                        // El parametro `data` hace referencia a la informacion de la celda (definida por
                        // la opción `data`, la cual está por defecto en la columna, in
                        // this case `data: 0`.
                        "render": function(data, type, row) {
                            return data /* +' ('+ row[3]+')' */ ;
                        },
                        "targets": 0
                    },
                    {
                        "visible": false,
                        "targets": []
                    }
                ]
            });

            //intento modales
            $('.res').click(function(){
                var id = $(this).attr("id");
                $.ajax({
                    url: "libros/partials/cons.php",
                    method:"POST",
                    data: {id:id},
                    success:function(data){
                        $('.modal-content').html(data);
                    }
                });
                $('#modal1').modal();

            })

        });
        </script>
    </div>
</body>

</html>