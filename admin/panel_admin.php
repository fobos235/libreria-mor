<?php
    require("partials/cabecera.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libros</title>
    <link rel="stylesheet" href="css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <!-- SCRIPTS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
	<br>
    <div class="container">
        <div class="row">
            <h4>Panel Administradores</h4>
        </div>
    </div>
    
	
	<div class="container">
			<a  href="buscarAdmin.php" id="buscar"><div class="row" id="buscar">
				<div class="col s12 m4 center" id="buscar_admin">			
						<div class="card-panel grey lighten-2 hoverable">
							<span class="black-text">
                            <i class="material-icons small">account_circle</i>
								<p>Ver Administradores</p>
							</span>
						</div>  	
				</div></a>

				<a href="registro_admin.php"><div class="col s12 m4 center" id="registrar_admin">		
						<div class="card-panel grey lighten-2 hoverable">
							<span class="black-text">
                            <i class="material-icons small">person_add</i>
								<p>Registrar Administrador</p>
							</span>
						</div>  </a>
                </div>
			</div>
            <a href="index.php"><- Regresar</a>
    </div>
    <br>
    

    
</div>
</body>
</html>