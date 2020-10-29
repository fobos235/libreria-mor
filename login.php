<?php
    session_start();
    $database="";
    if(isset($_GET['nmail'])){
        $nmail=$_GET['nmail'];
        $nmsg = $_GET['msg'];
        echo "<br><center><h5 style=color:red;>$nmsg</h5></center>";
    }else{
        $nmail = "";
    }
    
    if(isset($_SESSION['nombre']) != ""){
        if(isset($_SESSION['rol']) == 2){
            header("location: index");
        }else if(isset($_POST['rol'])== 1){
            header("location: admin/");
        }else{
            echo "Error con los roles de usuario";
        }
    }
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Iniciar sesión</title>
            <link rel="stylesheet" href="css/materialize.min.css">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <script src="js/validar.js"></script>
        </head>
        <body>
            <br>
            <div class="row">
                <h4><center>Librería Morelos</center></h4>
                <div class="col s12 m4 offset-m4">
                    <div class="card">
                        <div class="card-action teal darken-4 white-text">
                            <h4>Iniciar sesión</h4>
                        </div>

                        <div class="card-content">
                            <form action="" method="POST" onsubmit="return validar()">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="email" value="<?php echo $nmail;?>"name="mail" type="text">
                                        <label class="active" for="email">Correo electrónico</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">lock</i>
                                        <input id="pass" name="pass" type="password" >
                                        <label class="active" for="pass">Contraseña</label>
                                    </div>
                                </div>
                                <p align="center"><a href="recupera">¿Olvidaste tu contraseña?</a></p>
                                <div class="row">
                                    <center>
                                    <div class="input-field col s12">
                                        <a href="index" class="btn btn-large waves-effect btn-flat">Volver</a>
                                        <input type="submit" name="log_in"  value="Iniciar sesión" class="btn btn-large waves-effect white-text">
                                    </div>
                                    <a href="signup">Regístrate</a>
                                    </center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                if(isset($_POST['log_in'])){
                    $mail = $_POST['mail'];
                    $pass = $_POST['pass'];

                    include_once("conexion.php");
                    $database = new Conecta();
                    $db = $database->open();

                    $login = $db->prepare("SELECT nombre, apellidos, rol FROM  usuarios WHERE email = :mail AND contrasena = :pass");
                    $login->execute(array(':mail'=>$mail, ':pass'=>$pass));

                    $result = $login->fetch();

                    if($result){
                        $_SESSION['nombre'] = $result['nombre'];
                        $_SESSION['rol'] = $result['rol'];
                        $_SESSION['mail'] = $_POST['mail'];
                        $_SESSION['ape'] = $result['apellidos'];
                        $_SESSION['logedin'] = true;
                        if($_SESSION['rol'] == 1){
                            header("location: admin/");
                        }else{
                            header("location: index"); //cambiar por redireccion a la pagina anterior
                        }
                    }else{
                        echo "<center>Usuario y/o contraseña incorrectos</center>";
                        $msg ="Usuario o contraseña incorrectos.";
                        sleep(1);
                        header("location: login?nmail=$mail&msg=$msg");
                    }
                    $db = $database->close();
                }
                
            ?>

            <!-- SCRIPTS -->
            <script src="js/jquery-3.3.1.min.js"></script>
            <script src="js/materialize.min.js"></script>
            <script>
                //inicializaciones
                $(document).ready(function(){
                    M.updateTextFields();
                });
            </script>
        </body>
        </html>

    <?php
    
?>