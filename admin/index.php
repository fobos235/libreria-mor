<?php
    require("partials/cabecera.php");
?>
<!DOCTYPE html>
<html lang="es">

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


    <div class="container">
        <div class="row" id="resultado">
            <a href="compras.php">
            <div class="col s12 m4 center" id="compras">
                <div class="card-panel grey lighten-2 hoverable">
                    <span class="black-text">
					<i class="material-icons fixed medium">monetization_on</i>
                        <p>Registro de Compras</p>
                    </span>
                </div>
            </div>
            </a>
            <a href="panel_admin.php">
                <div class="col s12 m4 center" id="panel_admin">
                    <div class="card-panel grey lighten-2 hoverable">
                        <span class="black-text">
							<i class="material-icons fixed medium">people</i>
                            <p>Administradores</p>
                        </span>
                    </div>
            </a>
        </div>
        <a href="panel_libro.php">
            <div class="col s12 m4 center" id="panel_libros">
                <div class="card-panel grey lighten-2 hoverable">
                    <span class="black-text">
                        <i class="material-icons fixed medium">local_library</i>
                        <p>Libros</p>
                    </span>
                </div>
            </div>
        </a><br><br>
        <div class="row">
            Estadísticas del sitio
        </div>
        <div class="row">
            <div class="col sm6">
                <div class="row">
                <iframe width="467.4328259605729" height="289" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vS8CtQOTo3NRjguK1mKQ2KXINfDCWf3jdXn3ggAo9llla9NHu-Oq5Vr-cOfWDPZA6yeEgvyjC8SZ6DY/pubchart?oid=302381626&amp;format=interactive"></iframe>
                </div>
            </div>
            <div class="col sm6">
                <h6>Libros más comprados</h6>
            </div>
        </div>
    </div>
</body>
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

</html>