<?php
    require("partials/cabecera.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración</title>
    <link rel="stylesheet" href="css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <h4>Panel de administración</h4>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
	
	<div class="container">
				<h2>Administradores registrados</h2>
				
				<certer>
				<table class="table table-highlight">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Correo</th>
							<th>Teléfono</th>
							<th>Especialización</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include_once('conexion.php');
						$database = new Conecta();
						$db = $database->open();
						try{
							$sql = 'SELECT * FROM usuarios WHERE rol=1';
							foreach ($db->query($sql) as $resultado) {
								?>
						<tr>
							<td><?php echo $resultado['nombre']?></td>
							<td><?php echo $resultado['apellidos']?></td>
							<td><?php echo $resultado['email']?></td>
							<td><?php echo $resultado['telefono']?></td>
							<td><?php echo $resultado['contrasena']?></td>
							<td><a href="" ><img src="img/delete.png" alt="eliminar" style="width: 30px;"></a></td>
						</tr>
						<?php
							}
						} catch(PDOException $e){
							echo "Hay un problema con la conexión: ".$e->getMessage();
						}
							$database->close();
						?>
					</tbody>
				</table>
                </center>
			</div>      
            <br>
            <a href="panel_admin.php"><i class="material-icons left">arrow_back</i> Regresar</a>
			<!-- SCRIPTS -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/materialize.min.js"></script>
<script>
	// Inicializacion
    $(document).ready(function(){
    	$('.collapsible').collapsible();
    	$('.dropdown-trigger').dropdown();
        $('.sidenav').sidenav();
    });
</script>
</body>
</html>