<?php
    session_start();
    if(isset($_SESSION['name'])){
        //header("location: index");
        echo "No es posible registrarse en este momento.<br>Cierre sesión e intente más tarde";
    }else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrarme</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="js/validar.js"></script>
</head>
<body>
    <br>
    <div class="row">
    <h4><center>Librería Morelos</center></h4>
        <div class="col s12 m6 offset-m3">
            <div class="card">
                <div class="card-action teal darken-4 white-text">
                    <h4>Crear una cuenta</h4>
                </div>

                <div class="card-content">
                    <form action="" method="POST" onsubmit="return validarRegistro()">
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons  small prefix">person</i>
                                <input id="nombre" name="nombre" type="text">
                                <label class="active" for="nombre">Nombre</label>
                            </div>  
                        
                            <div class="input-field col s6">
                                <i class="material-icons  small prefix">person</i>
                                <input id="apellidos" name="apellidos" type="text" >                                        
                                <label class="active" for="apellidos">Apellidos</label>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons  prefix">mail</i>
                                <input id="email" name="mail" type="text" >                                        
                                <label class="active" for="email">Correo electrónico</label>
                            </div>
                        
                            <div class="input-field col s6">
                                <i class="material-icons  prefix">phone</i>
                                <input id="tel" name="tel" type="tel" >                                        
                                <label class="active" for="tel">Teléfono</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="material-icons  prefix">lock</i>
                                <input id="pass" name="pass" type="password" >                                        
                                <label class="active" for="pass">Contraseña</label>
                            </div>
                        
                            <div class="input-field col s6">
                                <i class="material-icons  prefix">cached</i>
                                <input id="re_pass" name="re_pass" type="password">                                        
                                <label class="active" id="lbl_pass" for="re_pass">Confirmar contraseña</label>
                            </div>
                        </div>
                            <div class="row">
                                <center>
                                <div class="input-field col s12">
                                    <a href="index" class="btn btn-large waves-effect btn-flat">Volver al inicio</a>
                                    <button type="submit" name="signup" class="btn btn-large waves-effect">Registrarme</button>
                                </div>
                                ¿Ya tienes una cuenta? <a href="login">Inicia sesión</a>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    <!-- SCRIPTS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
</body>
    <?php
    
        include_once("conexion.php");
        $database = new Conecta();
        $db = $database->open();
        
        if(isset($_POST['signup'])){
            $query=$db->prepare("SELECT email from usuarios WHERE email = :email");
            $query->execute(array(":email"=>$_POST['mail']));
            $rows = $query->fetch();
            if($rows){
                echo '<script>window.alert("El correo electrónico ya fue registrado")</script>';
            }else{
                $insert = $db->prepare("INSERT INTO usuarios (nombre, apellidos, email, telefono, contrasena) VALUES (:nombre, :ape, :mail, :tel, :pass)");
        
                if($insert->execute(array(':nombre'=>$_POST['nombre'], ':ape'=>$_POST['apellidos'], ':mail'=>$_POST['mail'], ':tel'=>$_POST['tel'], ':pass'=>$_POST['pass']))){
                    header("location: login.php?nmail=".$_POST['mail']."");
                }else{
                    echo '<center>Upps...<br>Algo fue mal</center>';
                }
            $database->close(); }
            }
        }
    ?>
</html>