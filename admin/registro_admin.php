<?php
    include_once("partials/cabecera.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="js/validar.js"></script>
</head>

<body>
    
        
        <div class="container">
                <div class="row">
                    <h3>Registrar administrador</h3>
                </div>
                
                    <form action="" class="col s12" enctype="multipart/form-data" method="POST">
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="nombre" name="nombre" type="text">
                                <label class="active" for="nombre">Nombre</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="apellidos" name="apellidos" type="text">
                                <label class="active" for="apellidos">Apellidos</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="email" name="email" type="text">
                                <label class="active" for="email">Correo electrónico</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="tel" name="tel" type="tel">
                                <label class="active" for="tel">Teléfono</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="pass" name="pass" type="password">
                                <label class="active" for="pass">Contraseña</label>
                            </div>

                            <div class="input-field col s6">
                                <input id="re_pass" name="re_pass" type="password">
                                <label class="active" id="lbl_pass" for="re_pass">Confirmar contraseña</label>
                            </div>
                        </div>
                        <div class="row">
                        <center>
                            <a href="javascript:window.history.back()" class="btn btn-flat btn-large "><i class="material-icons left">reply</i>Volver</a>
                            <button class="btn-flat btn-large waves-effect" type="reset"><i class="material-icons left">clear_all</i>Limpiar</button>
                            <button class="btn btn-large waves-effect" name="add" type="submit"><i class="material-icons right">add</i>Registrar</button>
                        </center>
                            
                        </div>
                    </form>
        </div>
    
    <!-- SCRIPTS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
    //inicializaciones
        $(document).ready(function(){
            $('.collapsible').collapsible();
            $('.dropdown').dropdown();
            $('.sidenav').sidenav();
        });
    </script>

<?php
    include_once("conexion.php");
    $database = new Conecta();
    $db = $database->open();
    if(isset($_POST['add'])){
        $insert = $db->prepare("INSERT INTO usuarios (nombre, apellidos, telefono, correo, contrasena, rol) values(?,?,?,?,?,1)");
        $insert->bindParam(1, $_POST['nombre']);
        $insert->bindParam(2, $_POST['apellidos']);
        $insert->bindParam(3, $_POST['tel']);
        $insert->bindParam(4, $_POST['email']);
        $insert->bindParam(5, $_POST['pass']);
        if($insert->execute()){
            header('location: buscarAdmin.php');
        } else {
            echo "<script>alert('No se ha registrado el usuario')</script>";
        }
    }
    $database->close();

    ?>
</body>

</html>