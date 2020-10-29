<?php
    session_start();
    include_once("conexion.php");
    if(isset($_GET['id'])){
        $database = new Conecta();
        $db = $database->open();
        $query = $db->prepare("SELECT * FROM inf_libro WHERE idLibro =". $_GET['id']."");
        $query->execute();

        while($row = $query->fetch()){
            $titulo = $row['titulo'];
            $desc = $row['descripcion'];
            $precio = $row['precio'];
            $dir = $row['dir'];
            $img = $row['img'];
            $existencia = $row['existencia'];
            $autor = $row['autor'];
        }
    }else{
        header("location: index");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles del libro</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php include_once("partials/cabecera.php");?>
    <div class="container">
        <div class="row"><h4>Detalles de <?php echo $titulo;?></h4></div>
        <div class="row">
            <div class="col m4">
                <img src="<?php echo $dir.$img;?>" width="100%"alt="">
            </div>
            <div class="col m8">
                <b><h5>Título:</b> <br><?php echo $titulo;?></h5>
                <b><h5>Autor:</b> <br><?php echo $autor;?></h5>
                <b><h5>Descripción:</b></h5><?php echo $desc;?><br><br>
                <b>Precio: </b>$<?php echo $precio;?>
                <b>Existentes: </b><?php echo $existencia;?><br><br><br>
                <center>
                    <a href="usr/carrito?id=<?php echo $_GET['id']; ?>"><button class="btn btn-large waves-effect">Añadir al carrito</button></a><br>
                    ¿No tenemos el libro que buscas? <a href="contacto?tipo=libro">Contactanos</a>
                </center>
                
            </div>
        </div>
    </div>

    <?php include_once("partials/footer.php");?>
    <!-- SCRIPTS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.carousel').next(5);
            $(".dropdown-trigger").dropdown();
        });
    </script>
</body>
</html>