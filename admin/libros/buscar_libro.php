<?php
    require("partials/cabecera.php");
    require_once("../../conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración</title>
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <h5><a href="javascript:window.history.back()"><i class="material-icons small left">arrow_back</i>Busqueda
                    de libros</h5></a>
        </div>
        <!-- Tabla dinámica -->



        <h5>Libros disponibles</h5>
        <table class="striped display" id="tabla">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Precio</th>
                    <th>Existencia</th>
                    <th>Categoria</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php
        $database = new Conecta();
        $db=$database->open();
        $sql = $db->prepare("SELECT * FROM inf_libro"); 
        $sql->execute();
        while($fila = $sql->fetch()) {
            # code...     
            ?>
                <tr>
                    <td><?php echo $fila['titulo'];?></td>
                    <td><?php echo $fila['autor'];?></td>
                    <td><?php echo $fila['precio'];?></td>
                    <td><?php echo $fila['existencia'];?></td>
                    <td><?php echo $fila['categoria'];?></td>
                    <td><a href="editar_libro?idLibro=<?php echo $fila['idlibro'];?>" class="btn-flat waves-effect btn">Editar <i class="material-icons right">edit</i></a></td>
                </tr>
                <?php
        }
        ?>
            </tbody>
        </table>



        <!-- SCRIPTS -->
        <script src="../js/materialize.min.js"></script>
        <script>
        // Inicializacion
        $(document).ready(function() {
            $('.collapsible').collapsible();
            $('.dropdown-trigger').dropdown();
            $('.sidenav').sidenav();
            $('select').formSelect();
            $('#tabla').DataTable({
                "columnDefs": [{
                        // El parametro `data` hace referencia a la informacion de la celda (definida por
                        // la opción `data`, la cual está por defecto en la columna, in
                        // this case `data: 0`.
                        "render": function(data, type, row) {
                            return data /*+' ('+ row[3]+')'*/ ;
                        },
                        "targets": 0
                    },
                    {
                        "visible": false,
                        "targets": [3]
                    }
                ]
            });
        });
        </script>
</body>

</html>