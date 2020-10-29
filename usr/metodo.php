<?php
	session_start();
	if(!isset($_POST)){
		echo "No se puede continuar con el proceso de compra. Define primero la dirección de entrega";
		die();
	}
	$_SESSION['direccion'] = $_POST;
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Pago</title>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
	<?php
		include_once("partials/cabecera.php");
	?>
	<div class="container"> 
	<?php
		if(isset($_SESSION['mail'])){ 
			$mail = $_SESSION['mail'];
			$nomb = $_SESSION['nombre'];
				include_once("../conexion.php");
			 	$database = new Conecta();
			 	$db = $database->open();
				$cliente = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
				$cliente->bindParam(1, $mail);
				$cliente->execute(); 
				$res = $cliente->fetch();
			 	
			 ?>
			<h3>¡Todo está listo!</h3>
			<h4>Esta es la información de tu pedido</h4> <br>

				<b>Datos del cliente: </b> <br>
				Nombre: <?php echo $res['nombre'] ." ". $res['apellidos'];?><br><br>
				<b>Direccion:</b> <br>
				Calle: <?php echo $_POST['calle'] ?> <br>
				Numero exiterior:  <?php echo $_POST['num_e'] ?> Numero interior:  <?php echo $_POST['num_i'] ?><br>
				Ciudad:  <?php echo $_POST['ciudad'] ?>  CP: <?php echo $_POST['cp']; ?>

				<br>
				<b><h5>Artículos: </h5></b>
				<table id="tabla">
					<tr>
						<th>Titulo</th>
						<th>Autor</th>
						<th>Cantidad</th>
						<th>Importe</th>
					</tr>
					<?php
					$total =0;
					$datos=$_SESSION['1carrito'];
						for($i=0; $i < count($datos); $i++){
							?>
								<tr>
									<td><?php echo $datos[$i]['Nombre']; ?></td>
									<td><?php echo $datos[$i]['Cantidad']; ?></td>
									<td><?php echo $datos[$i]['Precio']; ?></td>
									<td><?php echo $datos[$i]['Cantidad']*$datos[$i]['Precio']; ?></td>
								</tr>
							<?php
							$total=($datos[$i]['Cantidad']*$datos[$i]['Precio'])+$total;
						}
					?>
				</table>
				<center>
					<h5 class="right">Total a pagar: <?php echo $total; ?></h5><br><br>
				
				<?php 

					
				?>
				</center>
						<br>
						<br>
						<br>
				
	<?php } ?>
						<a href="#modal-mp" id="pagar" class="waves-effect waves-light btn modal-trigger">Pagar ahora</a>
	</div>

	<div id="modal-mp" class="modal">
		<div class="modal-content">
			<h4>Pagar ahora</h4>
			<p>
				Serás redireccionado a la página de Mercado Pago para llevar a cabo el págo de tu pedido usando tu 
				cuenta de mercado pago o pagar sin inicar sesión usando una tarjeta de crédito/débito o si lo deseas,
				realizando un depósito bancario o a través de tiendas de conveniencia como Oxxo o 7-Eleven
			</p>
		</div>
		<div class="modal-footer">
			<form action="procesar.php" method="GET">
				<?php
					include_once '../vendor/autoload.php';
					// Agrega credenciales
					MercadoPago\SDK::setAccessToken(MERCADO_PAGO_TOKEN);

					$preference = new MercadoPago\Preference();

					// Crea un ítem en la preferencia
					$items = [];
					foreach($datos as $d){
						$item = new MercadoPago\Item();
						$item->title = $d['Nombre'];
						$item->quantity = $d['Cantidad'];;
						$item->unit_price = number_format($d['Precio'],2);
						array_push($items, $item);
					}
					
					$preference->items = $items;
					// var_dump($items);
					$preference->save();
				?>
				<script src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js" data-preference-id="<?php echo $preference->id; ?>"></script>
			</form>
		</div>
	</div>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/materialize.min.js"></script>
	
	
	<script>
		$(document).ready(function() {
            $('.dropdown-trigger').dropdown();
            $('.sidenav').sidenav();
			$('#pagar').click(function(){
				$('#modal-mp').modal();
			});
        });
	</script>
	
</body>
</html>

