<?php
    require("partials/cabecera.php");
	require_once("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="../js/validar.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <h3>Editar administrador</h3>
        </div>
        <?php 
			if(isset($_GET['idAdmin'])){
				$database = new Conecta();
				$db = $database->open();
				$query = $db->prepare("SELECT * FROM usuarios WHERE idUsuario = ?");
				$query->bindParam(1, $_GET['idAdmin']);
                $query->execute();
                $admin=$query->fetch();

				$database->close();
		?>
            <form action="" class="col s12" enctype="multipart/form-data" method="POST">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nombre" name="nombre" type="text" value = "<?php echo $admin['nombre'];?>" required>
                        <label class="active" for="nombre">Nombre</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="apellidos" name="apellidos" type="text" value = "<?php echo $admin['apellidos'];?>"  required>
                        <label class="active" for="apellidos">Apellidos</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="email" name="email" type="text" value = "<?php echo $admin['email'];?>"  required>
                        <label class="active" for="email">Correo electrónico</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="tel" name="tel" type="tel" value = "<?php echo $admin['telefono'];?>"  required>
                        <label class="active" for="tel">Teléfono</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="pass" name="pass" type="password"  required>
                        <label class="active" for="pass"  required>Nueva Contraseña</label>
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
                    <button class="btn btn-large waves-effect" name="actualizar" type="submit"><i class="material-icons right">save</i>Actualizar</button>
                </center>      
                </div>
            </form>
        </div>
    </body>
    <?php
		}else{ ?>
			<br>
			<br>
			<br>
			<center>
				<h5>No se recibió ningún dato</h5><br>
				<h6><a href="javascript:window.history.back()">Volver a intentar</a></h6>

			</center>
	<?php
		}
		if(isset($_POST['actualizar'])){
			$db = $database->open();
			$query->execute();
			// nombre, apellidos, telefono, correo, contrasena, idUsuario
			$actu = $db->prepare("UPDATE usuarios set nombre = ?, apellidos = ?, telefono =?, email = ?, contrasena = ? where idUsuario = ?");
			$actu->bindParam(1, $_POST['nombre']);
            $actu->bindParam(2, $_POST['apellidos']);
            $actu->bindParam(3, $_POST['tel']);
            $actu->bindParam(4, $_POST['email']);
            $actu->bindParam(5, $_POST['pass']);
            $actu->bindParam(6, $_GET['idAdmin']);
			if($actu->execute()){
                header('location: buscarAdmin.php');
            } else {
                echo "<script> alert('No se ha registrado el cambio') </script>";
            }
		}

	?>
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
</body>

</html>