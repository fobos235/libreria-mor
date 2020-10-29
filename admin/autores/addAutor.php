<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración - Agregar - Autores</title>
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php
        include_once("partials/cabecera.php");
    ?>
        <div class="container">
            <div class="row">
                <h3>Agregar Autor</h3>
            </div>
            <form action="" class="col s12" enctype="multipart/form-data" >
               
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nombre" name="nombre" type="text" placeholder="nombre">
                        <label for="nombre">Nombre</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="pais" name="pais" type="text" placeholder="Pais">
                        <label for="pais">Pais</label>
                    </div>
                </div>
                <center>
                <a href="javascript:window.history.back()" class="btn btn-flat btn-large "><i class="material-icons left">reply</i>Volver</a>
                <button class="btn-flat btn-large waves-effect" type="reset"><i class="material-icons left">clear_all</i>Limpiar</button>
                <button class="btn btn-large waves-effect" name="add" type="submit"><i class="material-icons right">add</i>Agregar</button>
                </center>
            </form>

            <?php 
                include_once("../../conexion.php");
                $database = new Conecta();
                $db = $database->open();
                if(isset($_GET['add'])){
                    $insert = $db->prepare ("INSERT INTO autor (nombre, pais) VALUES (?, ?)");
                    $insert->bindParam(1, $_GET['nombre']);
                    $insert->bindParam(2, $_GET['pais']);
                    if($insert->execute()){
                        echo "<script> alert('Se agregó el autor');</script>";
                    }else{
                        echo "<script> alert('No se pudo agregar el autor');</script>";
                    }
                }
            ?>
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