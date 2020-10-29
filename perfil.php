<?php
    session_start();
    if(isset($_SESSION['mail'])){
        $mail = $_SESSION['mail'];
        $nomb = $_SESSION['nombre'];
        include_once("conexion.php");
        $database = new Conecta();
        $db = $database->open();
        $query = $db->prepare("SELECT * FROM usuarios WHERE email = '$mail'");
        $query->execute();
        $res = $query->fetch();
        if($res){
            
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Perfil</title>
        <link rel="stylesheet" href="css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="js/validar.js"></script>
        <style>
 

        </style>
    </head>
    <body>
        <!-- Cabecera  -->
        <?php include_once("partials/cabecera.php"); ?>
        <br>
        <div class="container">
            <div class="col sm3 left botones center-on-small-only" style="margin-right: 20px;">
                <div class="row">
                    <div style="float: left; padding-right: 20px; ">
                        <!--<i class="material-icons medium"> account_circle</i> -->
                    </div>
                    <div style="float: left; ">
                        <h5><?php echo $res['nombre'] . " " . $res['apellidos']; ?></h5>
                    </div>
                </div>
                <table>
                    <h6>
                    <tr>
                        <td><b>Numero de usuario: </b></td>
                        <td class="right"><?php echo $res['idUsuario'];?></td>
                    </tr>

                    <tr>
                        <td><b>Nombre: </b></td>
                        <td class="right"><?php echo $res['nombre'] . " " . $res['apellidos']; ?></td>
                    </tr>
                    <tr>
                        <td><b>email: </b></td>
                        <td class="right"><?php echo $res['email']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Teléfono: </b></td>
                        <td class="right"><?php echo $res['telefono']; ?></td>
                    </tr>

                    <tr>
                        <td><b>Tipo de usuario: </b></td>
                        <td class="right"> <?php
                            if($res['rol'] == 1){
                                echo "Administrador";
                            }else{
                                echo "Cliente";
                            }
                        ?></td>
                    </tr>

                    <tr>
                        <td><b>Contrasena: </b></td>
                        <td class="right"><a href="#cambiar" class="modal-trigger">Cambiar</a></td>
                    </tr>
                    </h6>
                </table>
                <!-- ESTRUCTURA DEL MODAL -->
                <div id="cambiar" class="modal">
                    <div class="modal-content">
                    <h5>Cambiar contraseña</h5>
                    <div class="container">
                        <form action="" method="post" >
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">lock</i>
                                    <input id="old_pass" name="old_pass" type="password">
                                    <label class="active" for="old_pass">Contraseña actual</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">lock</i>
                                    <input id="pass" name="pass" type="password" >
                                    <label class="active" for="pass">Nueva contraseña</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">lock</i>
                                    <input id="re_pass" name="re_pass" type="password" >
                                    <label class="active" for="re_pass">Confirmar contraseña</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="cambiar" class="btn btn-large btnAction right">Continuar</button>
                            </div>
                        </form>
                    </div>
                    </div>
                    
                </div>
                 
            </div>
            <div class="col sm9">
                <div class="row">
                <center>
                <div class="row">
                    <?php
                    if($_SESSION['rol'] == 1){ ?>
                        <div class="col m3 pull-s5 blue-grey white-text waves-effect" style="border-radius: 3px; padding: 20px; margin: 20px;">
                        <span class="flow-text">
                            Eliminar cuenta<!-- <i class="material-icons small">local_grocery_store</i> -->
                        </span>
                    </div>
                    <div class="col m3 pull-s5 blue-grey white-text waves-effect" style="border-radius: 3px; padding: 20px; margin: 20px;">
                        <span class="flow-text">
                            Cambiar info <!-- <i class="material-icons small">local_grocery_store</i> -->
                        </span>
                    </div>
                <?php }else{ ?>

                    <div class="col m3 push-s5 blue-grey white-text waves-effect" style="border-radius: 3px; padding: 20px; margin: 20px;">
                        <span class="flow-text">
                            Mis libros <!--<i class="material-icons small">book</i> -->
                        </span>
                    </div>
                    <a href="usr/carrito"><div class="col m3 pull-s5 blue-grey white-text waves-effect" style="border-radius: 3px; padding: 20px; margin: 20px;">
                        <span class="flow-text">
                            Ver carrito 
                        </span>
                    </div></a>
                    <div class="col m3 pull-s5 blue-grey white-text waves-effect" style="border-radius: 3px; padding: 20px; margin: 20px;">
                        <span class="flow-text">
                            Eliminar cuenta<!-- <i class="material-icons small">local_grocery_store</i> -->
                        </span>
                    </div>
                    <div class="col m3 pull-s5 blue-grey white-text waves-effect" style="border-radius: 3px; padding: 20px; margin: 20px;">
                        <span class="flow-text">
                            Cambiar info <!-- <i class="material-icons small">local_grocery_store</i> -->
                        </span>
                    </div>
                </div>
                <?php } ?>
                </center>
                </div>
            </div>
        </div>
        
        <!-- Pie de página -->
        <?php include_once("partials/footer.php"); ?>

        <!-- SCRIPST -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/materialize.min.js"></script>
        <script>
            //inicializaciones
            $(document).ready(function(){
                $('.sidenav').sidenav();
                $('.modal').modal();
                $(".dropdown-trigger").dropdown();
            });

            // validación de contraseñas
            $(function(){
                var old_pass, pass, re_pass;
                $('.btnAction').on('click', function(){
                    old_pass = $("#old_pass").val();
                    pass = $('#pass').val();
                    re_pass = $('#re_pass').val();

                    if(old_pass.length == 0 || pass.length == 0 || re_pass == 0){
                        alert("No puede dejar campos vacíos");
                        return false;
                    }else if(pass.length < 8){
                        alert("La nueva contraseña debe tener al menos 8 caracteres");
                        return false;
                    }else if(pass != re_pass){
                        alert("Las contraseñas no coinciden");
                        return false;
                    }
                });
            });
        </script>
    </body>
    </html>
    
    
    <?php
        $cons = $db->prepare("SELECT contrasena FROM usuarios WHERE email = :email");
        $cons->execute(array(':email' => $_SESSION['mail']));
        $pass = $cons->fetch();

        if(isset($_POST['cambiar'])){
            
            if($pass['contrasena'] == $_POST['old_pass']){
                $actu = $db->prepare("UPDATE usuarios SET contrasena = :pass WHERE email = :email AND :old_pass");
                if($actu->execute(array(':pass' => $_POST['pass'], ':email' => $_SESSION['mail'], ':old_pass' => $_POST['old_pass']))){
                    echo "<script>alert('Se actualizó la contraseña correctamente');</script>";
                }else{
                    echo "<script>alert('Error al actualizar la contraseña');</script>";
                }
                
            }else{
                echo "<script>alert('La contraseña actual no es correcta');</script>";
            }
        }
        }else{
            echo "Ocurrió un error en la consulta del perfil";
            $database->close();
        }
    }else{
        echo $_SESSION['mail'];
        echo $_SESSION['nombre'];
        header("location: login?registred=false");
    }
    
?>