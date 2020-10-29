<?php
    require_once("partials/cabecera.php");
    if(isset($_SESSION['logedin']) == true){
        header("location: index");
    }
    
    if(isset($_GET['email'])){
        $email=$_GET['email'];
    }else{
        $email = "null";
    }

    include("conexion.php");
    $database = new Conecta();
    $db = $database->open();
    $query = $db->prepare("SELECT * FROM usuarios WHERE email = :email");
    $query->execute(array(':email'=>$email));
    $result = $query->fetch();
    if(!$result){ echo $result['nombre'];?>
        
        <br><br><br><br><br>
        <div class="row">
            <div class="col s12 m4 m4 offset-m4">
                <div class="card-panel ">
                    <span>
                        <h6>No se encontró el usuario</h6><br>
                        Al parecer el correo <?php $email; ?> no está registrado, te invitamos a verificar
                        tu correo electrónico. <br><br>
                        
                        Si crees que se trata de un error <a href="contacto">contáctanos</a>. <br><br>
                        <center>
                            <a href="<?=BASE_URL;?>index">Volver a inicio </a>o <a href="login">Inicia sesión</a> <br><br>
                            <li class="divider"></li><br>
                            ¿No tienes cuenta? <a href="signup">Regístrate</a>
                        </center>
                    </span>
                </div>
            </div>
        </div>
<?php }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email de recuperación</title>
    <link rel="stylesheet" href="css/materialize.min.css">

</head>
<body>
    <?php
        $to = $email;
        $from = 'recuperación@libreria-morelos.com';
        $subject = 'Recuperación de cuentas - Librería Morelos';
        $msg = '<html><style> *{ font-familý: Arial;}</style><body>';
        $msg .= '<h5> Hola '.$result['nombre'] .' </h4>';
        $msg .= '<p><b>Email de prueba</p><br>';
        $msg .= '<h6> Hemos recibido tu solicitud de recuperación de tu cuenta: </h6>';
        $msg .= '<p> Tus datos son: <br>';
        $msg .= '<p><b>Correo electrónico: </b>'.$result['email'].'</p>';
        $msg .= '<p><b>Contraseña: </b>'.$result['contrasena'].'</p><br><br><br>';
        $msg .= '<p>====================================================================</p>';
        $msg .= '<p><b>Este es un correo de prueba. Si te ha llegado este correo sin razon aparente<br>';
        $msg .= 'la razón es que hemos escrito correos al azar sin estar conscientes de su existencia <br>';
        $msg .= 'sólo para hacer pruebas en nuestro proyecto universitario. Si deseas información <br>';
        $msg .= 'o dejar de recibir estos correos escribe por favor a arturoandradm@gmail.com con el asunto ';
        $msg .= '<b>Dejar de recibir correos</b> y dejaremos de provocarte estas molestias. Si deseas conocer nuestro proyecto <br>';
        $msg .= 'Visita: arturo-andrade@000webhostapp.com/alpha-lib/ </p>';
        $msg .= '<center>Atentamente<br>El equipo de Librería Morelos</body></html>';

        $headers = "From: recuperacion@libreria.net";
        $headers .= 'MMIME-Version: 1.0 \r\n';
        $headers .= 'Content-type: text/html; charset=utf-8 \r\n';
        $send = mail($to, $subject, $msg, $headers);
        if($send){
           
    ?>
    <br><br><br><br><br>
        <div class="row">
            <div class="col s12 m6 m3 offset-m3">
                <div class="card-panel ">
                    <span>
                        <h6>¡Listo!</h6><br>
                        Se ha enviado un correo a <b><?php echo $email;?></b> con tu información de inicio de sesisón. El correo puede demorarse unos minutos, te pedimos de favor ser paciente.
                        Si tienes algún poblema <a href="/alpha-lib/contacto">contáctanos</a>. <br><br>
                        Si no puedes ver nuestro correo revisa tu bandeja de SPAM <br><br>
                        <center>
                            <a href="/alpha-lib/index">Volver a inicio </a>o <a href="/alpha-lib/login">Inicia sesión</a> <br><br>
                            <li class="divider"></li><br>
                            ¿No tienes cuenta? <a href="/alpha-lib/signup">Regístrate</a>
                        </center>
                    </span>
                </div>
            </div>
        </div>
        <?php }else{ ?>
            <br><br><br><br><br>
        <div class="row">
            <div class="col s12 m4 m4 offset-m4">
                <div class="card-panel ">
                    <span>
                        <h6>¡Ha ocurrido un error!</h6><br>
                        Al parecer el servicio de correo electrónico no está disponible en este momento, te invitamos a intentar de nuevo más tarde. <br><br>
                        
                        Si el problema sigue por favor <a href="contacto">contáctanos</a>. <br><br>
                        <center>
                            <a href="index">Volver a inicio </a>o <a href="login">Inicia sesión</a> <br><br>
                            <li class="divider"></li><br>
                            ¿No tienes cuenta? <a href="signup">Regístrate</a>
                        </center>
                    </span>
                </div>
            </div>
        </div>
        <?php } ?>

    <!-- SCRIPTS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){

        });
    </script>
</body>
</html>