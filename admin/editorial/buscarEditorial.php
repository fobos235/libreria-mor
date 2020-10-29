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
            <h5><a href="javascript:window.history.back()"><i class="material-icons small left">arrow_back</i>
			Buscar Editoriales</h5></a>
        </div>
        <!-- Tabla dinámica -->



        <h5>Editorial</h5>
        <table class="striped display" id="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
					<th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php
        $database = new Conecta();
        $db=$database->open();
        try {
        $sql = $db->prepare("SELECT * FROM editorial");
        $sql->execute();
        while($fila = $sql->fetch()) {
            # code...     
            ?>
                <tr>
                    <td><?php echo $fila['idEditorial'];?></td>
                    <td><?php echo $fila['nombre'];?></td>
                    <td><a href="editEditorial?idEdit=<?php echo $fila['idEditorial'];?>" class="btn-flat waves-effect btn">Editar 
					<i class="material-icons right">edit</i></a></td>
                </tr>
        <?php
        }
        } catch(PDOException $e){
            echo "Hay un problema con la conexión: ".$e->getMessage();
        }
            $database->close();
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