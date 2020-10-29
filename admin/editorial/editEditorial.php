<?php
	require("partials/cabecera.php");
	require_once("../../conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración - Modificar Editorial</title>
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
        <div class="container">
        <div class="row">
			<h5><a href="javascript:window.history.back()"><i class="material-icons left">arrow_back</i> Regresar</a> </h5>
            <h4>Editar Editorial</h4>
        </div>
            <?php 
			if(isset($_GET['idEdit'])){
				$database = new Conecta();
				$db = $database->open();
				$query = $db->prepare("SELECT * FROM editorial WHERE idEditorial = ?");
				$query->bindParam(1, $_GET['idEdit']);
                $query->execute();
                $edit=$query->fetch();

                $database->close();
		?>
            <form action="" class="col s12" enctype="multipart/form-data" method="POST">
               
                <div class="row">
                <div class="input-field col s4">
                        <input id="editorial" name="editorial" type="text" value="<?php echo $edit['nombre']; ?>">
                        <label for="Editorial">Editorial</label>
                    </div>
                </div>
                <center>
                <a href="javascript:window.history.back()" class="btn btn-flat btn-large "><i class="material-icons left">reply</i>Volver</a>
               <button class="btn btn-large waves-effect" name="actualizar" type="submit"><i class="material-icons right">save</i>Editar</button>
                </center>
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
			// idCategoria, nombre
			$actu = $db->prepare("UPDATE editorial set nombre = ? where idEditorial = ?");
			$actu->bindParam(1, $_POST['editorial']);
            $actu->bindParam(2, $_GET['idEdit']);
			if($actu->execute()){
                header('location: buscarEditorial.php');
            } else {
                echo "<script>alert('No se ha registrado el cambio')</script>";
            }
		}

	?>
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