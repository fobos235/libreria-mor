<?php
    require_once("partials/cabecera.php");
    if(isset($_SESSION['nombre']) != ""){
        if(isset($_SESSION['rol']) == 2){
            header("location: index");
        }else if(isset($_SESSION['rol'])== 1){
            header("location: admin/");
        }else{
            echo "Error con los roles de usuario";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="js/validar.js"></script>
</head>

<body>
    <div class="row">
        <h4>
            <center>Librería Morelos</center>
        </h4>
        <div class="col s12 m4 offset-m4">
            <div class="card">
                <div class="card-action">
                    <h5>Recupera tu cuenta</h5>
                </div>

                <div class="card-content">
                    <form action="enviar.php" onsubmit="return valRecuperacion()">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">email</i>
                                <input id="email" name="email" type="text">
                                <label class="active" for="email">Correo electrónico</label>
                            </div>
                        </div>
                        <div class="row">
                            <center>
                                <div class="input-field col s12">
                                    <a href="javascript:window.history.back()"
                                        class="btn btn-large waves-effect btn-flat">Volver</a>
                                    <button type="submit" class="btn btn-large waves-effect">
                                        Recuperar
                                    </button>
                                </div>
                                <a href="login">Inicia sesion</a>
                                o
                                <a href="signup">Regístrate</a>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Scrips -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".sidenav").sidenav();
        M.updateTextFields();
    });
    </script>
</body>

</html>