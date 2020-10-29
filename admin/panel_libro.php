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
			<h5>Libros <i class="material-icons">book</i></h5>

		</div>
		<a id="busca" href="libros/buscar_libro"><div class="row">
			<div class="col s3 center" id="buscar_admin">			
				<div class="card-panel grey lighten-2 hoverable">
					<span class="black-text">
					<i class="material-icons small">book</i>
						<p>Buscar libros</p>
					</span>
				</div>  	
			</div>
		</a>

		<a id="agregar" href="libros/addlibro"><div class="row">
			<div class="col s3 center" id="agregar_libro">			
				<div class="card-panel grey lighten-2 hoverable">
					<span class="black-text">
						<img src="img/plus.png" style="height:30px;">
						<p>Agregar libro</p>
					</span>
				</div>  	
			</div>
		</a>

		<a id="ver_autores" href="autores/buscarAutor"><div class="row">
			<div class="col s3 center" id="verAutores">			
				<div class="card-panel grey lighten-2 hoverable">
					<span class="black-text">
						<i class="material-icons small">account_circle</i>
						<p>Ver autores</p>
					</span>
				</div>  	
			</div>
		</a>


		<a id="add_autor" href="autores/addAutor">
			<div class="row">
			<div class="col s3 center" id="agregarAutor">			
				<div class="card-panel grey lighten-2 hoverable">
					<span class="black-text">
						<i class="material-icons small">person_add</i>
						<p>Agregar un Autor</p>
					</span>
				</div>  	
			</div>
		</a>

		<a id="ver_autores" href="editorial/buscarEditorial"><div class="row">
			<div class="col s3 center" id="verEditoriales">			
				<div class="card-panel grey lighten-2 hoverable">
					<span class="black-text">
						<i class="material-icons small">bookmark_border</i>
						<p>Ver Editoriales</p>
					</span>
				</div> 
			</div>
		</a>

		<a id="ver_autores" href="editorial/addEditorial"><div class="row">
			<div class="col s3 center" id="addEditorial">			
				<div class="card-panel grey lighten-2 hoverable">
					<span class="black-text">
						<i class="material-icons small">add_box</i>
						<p>Agregar Editorial</p>
					</span>
				</div>  	
			</div>
		</a>

		<a id="categorias" href="categorias/buscarCategoria"><div class="row">
			<div class="col s3 center" id="verCategorias">			
				<div class="card-panel grey lighten-2 hoverable">
					<span class="black-text">
						<i class="material-icons small">library_books</i>
						<p>Categorías</p>
					</span>
				</div>  	
			</div>
		</a>
		<a id="añadir_cat" href="categorias/addCategoria"><div class="row">
			<div class="col s3 center" id="addCategoria">			
				<div class="card-panel grey lighten-2 hoverable">
					<span class="black-text">
						<i class="material-icons small">library_add</i>
						<p>Nueva categoría</p>
					</span>
				</div>  	
			</div>
		</a>

		
    </div>
    <br>
    <a href="index.php"><- Regresar</a>
	<script>
		$(document).ready(function(){
            $('.collapsible').collapsible();
            $('.dropdown-trigger').dropdown();
            $('.sidenav').sidenav();
        });
	</script>
</body>
</html>