<?php
session_start();
if (isset($_SESSION['mail']) != null && isset($_SESSION['rol']) != null) {
    $usr = $_SESSION['mail'];
    $rol = $_SESSION['rol'];
    if ($rol == 1) {
        header("location: ../admin/");
    }
} else {
    $usr = "";
    $rol = "";
}
include '../conexion.php';
$conn = new Conecta();
$sql = $conn->open();
    if (isset($_SESSION['1carrito'])) {
        if(isset($_GET['id'])){
            $arreglo=$_SESSION['1carrito'];
            $encontro=false;
            $numero=0;
            for ($i=0; $i < count($arreglo); $i++) { 
                if ($arreglo[$i]['Id']==$_GET['id']) {
                    $encontro=true;
                    $numero=$i;
                }
            }
            if($encontro==true){
                $arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
                $_SESSION['1carrito']=$arreglo;
            }
            else{

                $nombre="";
                $precio=0;
                $imagen="";
                $re=$sql->prepare("select * from inf_libro where idlibro =".$_GET['id']);
                $re->execute();
                while ($f=$re->fetch()) {
                    $nombre=$f['titulo'];
                    $precio=$f['precio'];
                    $imagen=$f['img'];
                }
                $datosNuevos=array('Id'=>$_GET['id'],
                                'Nombre'=>$nombre,
                                'Precio'=>$precio,
                                'Imagen'=>$imagen,
                                'Cantidad'=>1);
                array_push($arreglo, $datosNuevos);
                $_SESSION['1carrito']=$arreglo;
            }
        }
    }   
    else{
        if (isset($_GET['id'])) {
            $nombre="";
            $precio=0;
            $imagen="";  
            $re=$sql->prepare("select * from inf_libro where idlibro =".$_GET['id']);
            $re->execute();
            while ($f=$re->fetch()) {
                $nombre=$f['titulo'];
                $precio=$f['precio'];
                $imagen=$f['img'];
            }
            $arreglo[]=array('Id'=>$_GET['id'],
                            'Nombre'=>$nombre,
                            'Precio'=>$precio,
                            'Imagen'=>$imagen,
                            'Cantidad'=>1);
            $_SESSION['1carrito']=$arreglo;
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Carrito Libreria Morelos</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <link rel="stylesheet" href="../css/materialize.min.css">
    <script src="../js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <!--Inicio barra de navegacion -->
    <?php
include_once "partials/cabecera.php";
?>
    <!--fin del la barra de nevegacion-->
    <!--inicio de contenido del carrito-->
    <div>
		<div class="container">
			<div class="row">
				<!-- Producto -->	
				<?php
				$total=0;
				if(isset($_SESSION['1carrito'])){
					$datos=$_SESSION['1carrito'];
					
					for ($i=0; $i < count($datos); $i++) { 
						?>
								<div class="col s12 m12">
				<div class="producto">
					<div class="card horizontal">
						<div class="card-image">
							<img src="../img/portadas/<?php echo $datos[$i]['Imagen'];?>"  height="250px" class="reponsive-img" >
						</div>
						<div class="card-stacked">
							<div class="card-content">
								<div class="col l6 m6 s12">
									<h5> <?php echo $datos[$i]['Nombre']; ?> </h5>
									<h6>Cantidad: </h6>
									<input type="text" value="<?php echo $datos[$i]['Cantidad'];?>"
										 data-precio="<?php echo $datos[$i]['Precio'];?>"
										 data-id="<?php echo $datos[$i]['Id'];?>"
										 class="cantidad">  
								</div>
								<div class="col l6 m6 s12">
									<h5>Precio: $<?php echo $datos[$i]['Precio']; ?> </h5>
								</div>
							</div>
							<h5 class="subtotal">SubTotal: $<?php echo $datos[$i]['Precio']*$datos[$i]['Cantidad']; ?> <h5>
							<div class="card-action">
								<h5><a href="" data-id="<?php echo $datos[$i]['Id']?>"  <l class="eliminar">Eliminar</a></h5>
							</div>
						</div>
					</div>
				</div>
				</div>

					<?php
					$total=($datos[$i]['Cantidad']*$datos[$i]['Precio'])+$total;
					}
				}
				else{
					echo '
					<div>
						<center><h4 class="grey-text">El Carrito de compras esta vacio</h4></center>
						<center><h5 class="grey-text">Ve a al tienda para agregar productos :)</h5></center>
					</div>

					';
				}

				echo '<center><h3 id="total">Total:$'.$total.'</h3></center>';

				?>
				<!-- Producto -->	
				<a href="../index.php" class="waves-effect waves-light btn-large">Regresar a la tienda</a>
				
				<?php
					if ($total!=0) {
					
				?>
				<div class="right">
				<h4><font size="2"><a class="waves-effect waves-light btn-large  light-green" href="compras">Ir a caja</a>
					</div>
				<?php
				}
				?>
				</div>
			</div>

 	<!--fin del contenido del carrito-->
	<!--pie de pagina-->
    <script>
        $(document).ready(function() {
            $('.dropdown-trigger').dropdown();
            $('.sidenav').sidenav();
        });

        $(".cantidad").keyup(function(e){
		if($(this).val()!=''){
			if(e.keyCode==13){
				var id=$(this).attr('data-id');
				var precio=$(this).attr('data-precio');
				var cantidad=$(this).val();
				$(this).parentsUntil('.producto').find('.subtotal').text('Subtotal: '+(precio*cantidad));
				$.post('../js/modificarDatos.php',{
					Id:id,
					Precio:precio,
					Cantidad:cantidad
				},function(e){
					$("#total").text('Total'+e);
				});
			}
		}
	});
	$(".eliminar").click(function(e){
		e.preventDefault();
		var id=$(this).attr('data-id');
		$(this).parentsUntil('.producto').remove();
		$.post('../js/eliminar.php',{
			Id:id
		},function(a){
			
			if(a=='0'){
				location.href="../usr/carrito";
			}
		});

	});
    </script>
   
<DIV class="footer">
    <?php
        include_once 'partials/footer.php';
    ?>
</DIV>
</body>

</html>