<?php

session_start();
include '../conexion.php';


$arreglo=$_SESSION['1carrito'];
$numeroventa=0;
$database =new Conecta();
$db = $database->open();
$cons = $db->prepare("select id from compra order by id DESC limit 1");
$cons->execute();
$res = $cons->fetch();
$venta = $res['id'];
// var_dump($_SESSION['direccion']);
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Datos de la compra</title>
	<link rel="stylesheet" href="../css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	<script>
		function validar(){
			var calle = getElementById("calle").value;
			var num_ext = getElementById("num_e").value;
			var num_int = getElementById("num_i").value;
			var colonia = getElementById("colonia").value;
			var cp = getElementById("cp").value;
			var ciudad = getElementById("ciudad").value;

			if(calle == "" || num_ext == ""  || colonia == "" || cp == "" || ciudad == ""){
				alert("Todos los campor son obligatorios a excepción del numero interior");
				return false;
			}else if(cp.leng != 5){
				alert("El código postal debe tener 5 dígitos");
				return false;
			}
		}

		function soloNumeros(e){
			var key = window.Event ? e.which : e.keyCode
			return (key >= 48 && key <= 57)
		}
	</script>
	<?php include_once("partials/cabecera.php");
	if(isset($_SESSION['mail'])){
        $mail = $_SESSION['mail'];
		$nomb = $_SESSION['nombre'];
		include_once("../conexion.php"); ?>

		<div class="container">
			<h4>¡Ya casi!</h4>
			<h6>Sólo necesitamos saber a dónde enviarte tus libros</h6> <br>
			<form action="metodo.php" method="POST" onsubmit="return validar()">
				<div class="row">
					<div class="input-field col s6">
						<i class="material-icons prefix">person_pin_circle</i>
						<input id="calle" name="calle" value="<?=isset($_SESSION['direccion']) ? $_SESSION['direccion']['calle'] :'';?>" type="text" required>
						<label class="active" for="calle">Calle</label>
					</div>
					<div class="input-field col s3">
						<i class="material-icons prefix">radio_button_unchecked</i>
						<input id="num_e" name="num_e" value="<?=isset($_SESSION['direccion']) ? $_SESSION['direccion']['num_e'] :'';?>" type="text" required>
						<label class="active" for="num_e">N. exterior</label>
					</div>
					<div class="input-field col s3">
						<i class="material-icons prefix">radio_button_checked</i>
						<input id="num_i" name="num_i" value="<?=isset($_SESSION['direccion']) ? $_SESSION['direccion']['num_i'] :'';?>" type="text">
						<label class="active" for="num_i">N.. interior</label>
					</div>
					
				</div>

				<div class="row">
					<div class="input-field col s4">
						<i class="material-icons prefix">nature_people</i>
						<input id="colonia" name="colonia" value="<?=isset($_SESSION['direccion']) ? $_SESSION['direccion']['colonia'] :'';?>" type="text" required>
						<label class="active" for="colonia">Colonia</label>
					</div>
					<div class="input-field col s4">
						<i class="material-icons prefix">person_pin_circle</i>
						<input id="cp" name="cp" onkeypress="return soloNumeros(event);" value="<?=isset($_SESSION['direccion']) ? $_SESSION['direccion']['cp'] :'';?>" type="text" required>
						<label class="active" for="cp">Codigo postal</label>
					</div>
					
					<div class="input-field col s4">
						<i class="material-icons prefix">radio_button_checked</i>
						<input id="ciudad" name="ciudad" value="<?=isset($_SESSION['direccion']) ? $_SESSION['direccion']['ciudad'] :'';?>" type="text" required>
						<label class="active" for="ciudad">Ciudad</label>
					</div>
				</div>
				<div class="row">
					<center>
						<a href="/alpha-lib/" class="btn btn-flat btn-large">Volver al inicio</a>
						<button type="submit" class="btn btn-large waves-effect"><i class="material-icons right">forward</i>Continuar</button>
					</center>
				</div>
			</form>
			<br><br>
		</div>
	<?php
	}else{ ?>
		<div class="container">
			<center><br><br>
			<br>
			<br>
				<h5>No has iniciado sesión :(</h5><br>
				Es necesario que inicies sesión para continuar <br>
				<a href="../login">Inicia sesión</a> o <a href="../signup">Regístrate</a> <br>
				<br>
				<br>
				<br>
				<br>
				<br>
			</center>
		</div>
	<?php } 
		include_once("../partials/footer.php");
	?>

	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/materialize.min.js"></script>
	<script>
		$(document).ready(function() {
            $('.dropdown-trigger').dropdown();
            $('.sidenav').sidenav();
        });
	</script>
</body>
</html>