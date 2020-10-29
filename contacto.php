<?php
    session_start();
    $tipo = "";
    $msg="Escribe un comentario";
    if(isset($_SESSION['mail']) && isset($_SESSION['rol']) == 2){
        $email = $_SESSION['mail'];
        $nombre = $_SESSION['nombre'];
        $ape = $_SESSION['ape'];
        if(isset($_GET['tipo'])){
            $tipo = $_GET['tipo']; // -> Tipo de comentario a emitir
        }else{
            $msg = "¿En qué podemos ayudarte?";
        }
        
    }else {
        $email = "";
        $nombre = "";
        $ape = "";
        
    }
    if(isset($_SESSION['rol']) && $_SESSION['rol'] = 1){
        //header("location: admin/");
        echo "<center>Un administrador no puede hacer comentarios</center>";
    }else{

    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contactanos</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <script>
    var expresion = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i; //formato de email
    function valComentario(e) {
        var tecla = (document.all) ? e.keyCode : e.which;
        var long = document.getElementById("textarea").value;
        var res = 140 - (long.length) - 1;

        if (tecla != 8 || tecla == 8) {
            ;
            if (long.length < 140) {
                if (tecla == 8) {
                    res = res + 1;
                    document.getElementById("lblTxtAr1").innerHTML = "Comentario: - Restantes: " + res;
                }
                document.getElementById("lblTxtAr1").innerHTML = "Comentario: - Restantes: " + res;
            } else if (long.length > 139) {
                if (tecla == 8) {
                    console.log("SE PRESIONÓ")
                } else {
                    return false;
                }
            } else if (long.length < 1) {
                document.getElementById("lblTxtAr1").innerHTML = "Comentario (Max: 140):";
            }

        }

    }

    function valCont() {
        var com = document.getElementById("textarea").value;
        var mail = document.getElementByid("email").value;
        if(com == ""){
            window.alert("Tu comentario no puede estar vacío.");
            return false;
        }else if(mail == ""){
            window.alert("Tu email no puede estar vacío.");
            return false;
        }else if(!expresion.test(mail)){
            window.alert("El correo debe tener el siguiente formato: \n ejemplo@email.com");
            return false;
        }
    }
    </script>
</head>

<body>
    <?php include_once("partials/cabecera.php");?>
    <div class="container">
        <div class="row">
            <h4>Cuéntanos</h4>

            <?php
            if($tipo == "libro"){ $msg = "¿Qué libro necesitas? (Máximo 140 caracteres)";?>
            <form action="" onsubmit="valCont()" method="POST">

                <div class="input-field col s6">
                    <input type="email" name="email" id="email" class="validate">
                    <label for="email" data-error="wrong" data-success="right">Email*</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="textarea" name="comentario" onkeydown="return valComentario(event);"
                        class="materialize-textarea"></textarea>
                    <label id="lblTxtAr1" for="textarea"><?php echo $msg; ?></label>
                </div>
                <div class="col s12 center">
                    <a href="javascript:window.history.back();" class=" btn btn-flat waves-effect"><i
                            class="material-icons right">arrow_back</i>Volver</a>
                    <button type="submit" class="waves-effect btn blue-gray offset">Enviar <i
                            class="material-icons right">send</i></button>
                </div>
            </form>
            <?php }else{ ?>
            <form action="" onsubmit="valCont()" method="POST">

                <div class="input-field col s6">
                    <input type="email" name="email" id="email" class="validate" required>
                    <label for="email" data-error="wrong" data-success="right">Email*</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="textarea" name="comentario" onkeydown="return valComentario(event);"
                        class="materialize-textarea"></textarea>
                    <label id="lblTxtAr1" for="textarea"><?php echo $msg; ?></label>
                </div>
                <div class="col s12 center">
                    <a href="javascript:window.history.back();" class=" btn btn-large btn-flat waves-effect"><i
                            class="material-icons right">arrow_back</i>Volver</a>
                    <button type="submit" name="enviar" class="waves-effect btn btn-large blue-gray offset">Enviar <i
                            class="material-icons right">send</i></button>
                </div>
            </form> <?php
            }
            
            if(isset($_POST['enviar'])){
                include_once("conexion.php");
                $database = new Conecta();

                $correo = $_POST['email'];
                $comentario = $_POST['comentario'];
                $db = $database->open();
                $contact = $db->prepare("INSERT INTO contacto (correo, comentario) values (?, ?)");
                $contact->bindParam(1, $correo);
                $contact->bindParam(2, $comentario);
                if($contact->execute()){
                    echo "Se envió tu comentario";
                }else{
                    echo "Error al enviar tu comentario";
                }
                
            }
            
            ?>
        </div>
    </div>




    <?php include_once("partials/footer.php"); ?>
    <!-- SCRIPTS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
        $(".dropdown-trigger").dropdown();
    });
    </script>


</body>

</html>