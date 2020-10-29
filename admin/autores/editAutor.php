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
    <title>Administración - Modificar Autores</title>
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
        <div class="container">
        <div class="row">
			<h5><a href="javascript:window.history.back()"><i class="material-icons left">arrow_back</i> Regresar</a> </h5>
            <h4>Editar Autores</h4>
        </div>
            <?php 
			if(isset($_GET['idAutor'])){
				$database = new Conecta();
				$db = $database->open();
				$query = $db->prepare("SELECT * FROM autor WHERE idAutor = ?");
				$query->bindParam(1, $_GET['idAutor']);
                $query->execute();
                $autor=$query->fetch();

				$database->close();
		?>
            <form action="" class="col s12" enctype="multipart/form-data" method="POST">
               
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nombre" name="nombre" type="text"  value = "<?php echo $autor['nombre'];?>">
                        <label for="nombre">Nombre</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="pais" name="pais" type="text" value = "<?php echo $autor['pais'];?>">
                        <label for="pais">Pais</label>
                    </div>
                </div>
                <center>
                <a href="javascript:window.history.back()" class="btn btn-flat btn-large "><i class="material-icons left">reply</i>Volver</a>
                <button class="btn-flat btn-large waves-effect" type="reset"><i class="material-icons left">clear_all</i>Limpiar</button>
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
			// idAutor, nombre, pais
			$actu = $db->prepare("UPDATE autor set nombre = ?, pais = ? where idAutor = ?");
			$actu->bindParam(1, $_POST['nombre']);
            $actu->bindParam(2, $_POST['pais']);
            $actu->bindParam(3, $_GET['idAutor']);
			if($actu->execute()){
                echo "<script> alert('Se actualizó correctamente');
                </script>";
            }else{
                echo "<script> alert('Error al actualizar');</script>";
                
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