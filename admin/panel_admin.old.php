<?php
    require("partials/cabecera.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administradores</title>
    <link rel="stylesheet" href="css/materialize.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <h4>Panel Administradores</h4>
        </div>
    </div>
    <!-- SCRIPTS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
        /*$(document).ready(function(){
            $('#modal').modal();
            $('#modal').modal('open'); 
        }); */
    </script>
	
	<div class="container">
			<a id="buscar"><div class="row" id="buscar">
				<div class="col s12 m4 center" id="buscar_admin">			
						<div class="card-panel grey lighten-2 hoverable">
							<span class="black-text">
								<img src="img/lupa.png" style="height:30px;">
								<p>Buscar</p>
							</span>
						</div>  	
				</div></a>

				<a href="registro_admin.php"><div class="col s12 m4 center" id="registrar_admin">		
						<div class="card-panel grey lighten-2 hoverable">
							<span class="black-text">
								<img src="img/plus.png" style="height:30px;">
								<p>Registrar</p>
							</span>
						</div>  </a>
                </div>
                <a href="editar_admin.php"><div class="col s12 m4 center" id="editar_admin">		
						<div class="card-panel grey lighten-2 hoverable">
							<span class="black-text">
								<img src="img/edit.png" style="height:30px;">
								<p>Editar</p>
							</span>
						</div>  
                </div></a>
			</div>
    </div>
    <br>
    <a href="index.php"><- Regresar</a>
    <button	type="button" href="#modal" data-toggle="modal" class="btn	btn-default	btn-lg">Buscar</button>

	<div id="modal" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>

    
</div>
</body>
</html>