<?php
    if(isset($_POST['id'])){
        $output = '';
        include_once("../../../conexion.php");
        $database = new Conecta();
        $db = $database->open();
        $query = $db->prepare("SELECT * FROM contacto WHERE id = ?");
        $query->bindParam(1, $_POST['id']);
        $query->execute();
        $res = $query->fetch();
        $output .= ' <div class="container">
            <h5>Responer mensaje</h5>
            <form action="" method="POST">
                <div class="input-field col s12">
                    <input type="text" name="correo" id="correo" value=" '.$res['correo'].'" >
                    <label for="titulo">Correo electrónico</label><br>
                    <input type="text" name="respuesta" placeholder="Respuesta" id="res">
                </div>

                <div class="row">
                    <button type="submit" name="enviar" class="btn right waves-effect"><i class="material-icons right">send</i>Enviar</button>
                </div>
            </form>
        </div>
            
        ';
        echo $output;

        if(isset($_POST['enviar'])){
            $to = $_POST['correo'];
            $subject = 'Respuesta a comentario - Librería Morelos';

            $msg = $_POST['respuesta'];
            $msg .= "Mensaje respondido por un administrador desde arturo-andrade.000webhostapp.com/alpha-lib/
                Si crees que es un error por favor ignora este mensaje.
                
                En Librería Morelos estamos para ayudarte.";
            $headers = "From: recuperacion@libreria.net";
            $headers .= 'MMIME-Version: 1.0 \r\n';
            $headers .= 'Content-type: text/html; charset=utf-8 \r\n';
            $send = mail($to, $subject, $msg, $headers);
            if($send){
                echo "<script>alert('Respuesta enviada correctamente');</script>";
                $query = $db->prepare("UPDATE contacto SET status = 'atendido' WHERE id = ?");
                $query->bindParam(1, $_POST['id']);
                $query->execute();
            }else{
                echo "<script>alert('No se pudo enviar la respuesta.');</script>";
            }
        }

    }