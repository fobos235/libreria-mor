<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración - Agregar Categoria</title>
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php
        include_once("../../conexion.php");
        include_once("partials/cabecera.php");
    ?>
        <div class="container">
            <div class="row">
                <h3>Agregar Categoria</h3>
            </div>
            <form action="" class="col s12" enctype="multipart/form-data" method="POST" >
               
                <div class="row">
                    <div class="input-field col s4">
                        <input id="categoria" name="categoria" type="text" placeholder="categoria">
                        <label for="categoria">Categoria</label>
                    </div>
                </div>
                <center>
                <a href="javascript:window.history.back()" class="btn btn-flat btn-large "><i class="material-icons left">reply</i>Volver</a>
                <button class="btn-flat btn-large waves-effect" type="reset"><i class="material-icons left">clear_all</i>Limpiar</button>
                <button class="btn btn-large waves-effect" name="add" type="submit"><i class="material-icons right">add</i>Agregar</button>
                </center>
            </form>
        </div>
</body>
<!-- SCRIPTS -->
<script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/materialize.min.js"></script>
    <script>
        //inicialización
        $(document).ready(function(){
            $(".dropdown-trigger").dropdown();
            $(".sidenav").sidenav();
            $('select').formSelect();
 
        });
    </script>

    <?php
        $database = new Conecta();
        $db = $database->open();

        if(isset($_POST['add'])){
            $insert = $db->prepare("INSERT INTO categoria (nombre) values(?)");
            $insert->bindParam(1, $_POST['categoria']);
            if($insert->execute()){
                header('location: buscarCategoria.php');
            } else {
                echo "<script>alert('No se ha registrado el cambio')</script>";
            }
        }
    ?>