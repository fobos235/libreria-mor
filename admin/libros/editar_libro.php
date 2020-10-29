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
    <title>Administración</title>
    <link rel="stylesheet" href="../css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="../js/validar.js"></script>
</head>
<body><br>
	
    <div class="container">
		<div class="row">
			<h5><a href="javascript:window.history.back()"><i class="material-icons left">arrow_back</i> Regresar</a> </h5>
            <h4>Editar un libro</h4>
        </div>
		<?php 
			if(isset($_GET['idLibro'])){
				$database = new Conecta();
				$db = $database->open();
				$query = $db->prepare("SELECT * FROM inf_libro WHERE idlibro = ?");
				$query->bindParam(1, $_GET['idLibro']);
				$query->execute();
				$libro = $query->fetch();

				$aut = $db->prepare("SELECT idAutor, nombre FROM autor ORDER BY nombre ASC");
				$aut->execute();

				$edit = $db->prepare("SELECT * FROM editorial ORDER BY nombre ASC");
				$edit->execute();

				$cat = $db->prepare("SELECT * FROM categoria ORDER BY nombre ASC");
				$cat->execute();

				$database->close();
		?>
			<form action="" method="POST">
				<div class="row">
					<div class="input-field col s4">
						<input type="text" name="titulo" id="titulo" value="<?php echo $libro['titulo'];?>">
						<label for="titulo">Título</label>
					</div>
					<!-- Autor -->
					<div class="input-field col s4">
						<select name="autor" id="autor">
							<option value="" disabled>Elegir un autor</option>
							<!-- MOSTRAR AUTORES -->
							<?php
                                while($res = $aut->fetch()){
									if($res['nombre'] == $libro['autor']){ ?>
										<option value="<?php echo $res['idAutor'];?>" selected><?php echo $res['nombre'];?></option>	<?php
									} else{?>
									<option value="<?php echo $res['idAutor'];?>"><?php echo $res['nombre'];?></option>
                                    
                                    
									<?php }
                                }
                            ?>
						</select>
					</div>
					<!-- Editorial -->
					<div class="input-field col s4">
						<select name="editorial" id="editorial">
							<option value="" disabled>Elegir una editorial</option>
							<!-- MOSTRAR editoriales -->
							<?php 
								$query->execute();
								$libro = $query->fetch();
                                while($res = $edit->fetch()){
									if($libro['editorial_id'] == $res['idEditorial']){ ?>
										<option value="<?php echo $res['idEditorial'];?>" selected><?php echo $res['nombre'];?></option>	<?php
									} else{?>
									<option value="<?php echo $res['idEditorial'];?>"><?php echo $res['nombre'];?></option> 
									<?php }
                                }
                            ?>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s3">
						<input type="text" name="edicion" id="edicion" value="<?php echo $libro['edicion'];?>">
						<label for="edicion">Edición</label>
					</div>

					<div class="input-field col s3">
						<input type="text" name="precio" id="precio" value="<?php echo $libro['precio'];?>">
						<label for="precio">Precio</label>
					</div>
					<div class="file-field input-field col s6">
                        <div class="btn">
                            <span>Imagen</span>
                            <input name="foto" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="nomb_foto" type="text" placeholder="Imágen de portada" value="<?php echo $libro['img'];?>">
                        </div>
                    </div>
				</div>
				<div class="row">
					<div class="input-field col s1">
						<input type="text" name="exist" id="existencia" value="<?php echo $libro['existencia'];?>">
						<label for="existencia">Stock</label>
					</div>
				
					<div class="input-field col s3">
						<select name="categoria" id="categoria">
							<option value="" disabled>Elegir una categoría</option>
								<!-- MOSTRAR categoria -->
								<?php 
									$query->execute();
									$libro = $query->fetch();
									while($res = $cat->fetch()){
										if($libro['categoria'] == $res['nombre']){ ?>
											<option value="<?php echo $res['idCat'];?>" selected><?php echo $res['nombre'];?></option>	<?php
										}else{ ?>
										<option value="<?php echo $res['idCat'];?>"><?php echo $res['nombre'];?></option> 
									<?php }
									}
								?>
						</select>
					</div>
					<div class="input-field col s8">
						<input type="text" name="descripcion" id="descripcion" value="<?php echo $libro['descripcion'];?>">
						<label for="descripcion">Descripción del libro</label>
					</div>
				</div>

				<center>
				<div class="row">
					<a href="javascript:window.history.back()" class="btn btn-flat waves-effect btn-large">Volver <i class="material-icons left">arrow_back</i></a>
					<button type="submit" name="actualizar" class="btn waves-effect btn-large">Guardar <i class="material-icons right">save</i></button>
				</div>
				</center>
			</form>
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
			$libro = $query->fetch();
			$edit->execute();
			$dir = '/alpha-lib/img/portadas/';
   			//idLib, title, edic, costo, descripcion, dir, img, cantidad, idEditorial, idCategoria, idAutor
			$actu = $db->prepare("CALL editarLibro (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$actu->bindParam(1, $_GET['idLibro']);
			$actu->bindParam(2, $_POST['titulo']);
			$actu->bindParam(3, $_POST['edicion']);
			$actu->bindParam(4, $_POST['precio']);
			$actu->bindParam(5, $_POST['descripcion']);
			$actu->bindParam(6, $dir);
			$actu->bindParam(7, $_POST['nomb_foto']);
			$actu->bindParam(8, $_POST['exist']);
			$actu->bindParam(9, $_POST['editorial']);
			$actu->bindParam(10, $_POST['categoria']);
			$actu->bindParam(11, $_POST['autor']);

			
			
			if($actu->execute()){
				if(isset($_POST['foto']) && $_POST['foto'] != null){
					try{
						$filetemp= $_FILES['foto']['tmp_name'];
						$nomb_foto = $_FILES['foto']['name'];
						$destino=$_SERVER['DOCUMENT_ROOT'].'/alpha-lib/img/portadas/';
						$filetype = $_FILES['foto']['type'];
						move_uploaded_file($filetemp, $destino.$nomb_foto);
					}catch(Exception $e){
						echo $e->getMessage();
					}
				}
				echo "<script>alert('Se actualizó correctamente')</script>";
				//header("location: editar_libro?idLibro=".$_GET['idLibro']."");
			}
		}

	?>
	</div>
    <!-- SCRIPTS -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/materialize.min.js"></script>
	<script>
		$(document).ready(function(){
            $(".dropdown-trigger").dropdown();
            $(".sidenav").sidenav();
            $('select').formSelect();
        });
	</script>
           
</body>
</html>