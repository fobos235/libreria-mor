<?php
    session_start();
    if(isset($_SESSION['mail']) != null && isset($_SESSION['rol']) != null){
        $usr = $_SESSION['mail'];
        $rol = $_SESSION['rol'];
        if($rol == 1){
            header("location: admin/");
        }
    }else{
        $usr = "";
        $rol = "";
    }
    if(isset($_GET['idCat'])){
        include_once("conexion.php");
        $dababase = new Conecta();
        $db = $dababase->open();
        $categoria = $db->prepare("SELECT * FROM inf_libro WHERE categoria = (SELECT nombre FROM categoria WHERE idCat = ?)");
        $categoria->bindParam(1, $_GET['idCat']);
        $categoria->execute();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categorías</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
    <?php include("partials/cabecera.php"); ?>
    <div class="container">
        <div class="row">
                    <?php
                    while($res = $categoria->fetch()){
                ?>
                    <div class="col s12 m6 l3">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="<?php echo $res['dir'].$res['img'];?>">
                            </div>
                            <div class="card-content">
                                <span class="activator card-title grey-text text-darken-4"><?php echo $res['titulo'];?><i
                                        class="material-icons small right">more_vert</i></span>
                                <p><a class="enlace-car" href="usr/carrito?id=<?php echo $res['idlibro'];?>">
                                        <h6>Agregar al carrito</h6>
                                    </a></p>
                            </div>
                            <div class="card-reveal"> 
                                <span class="card-title grey-text text-darken-4"><?php echo /*utf8_encode(*/$res['titulo']/*)*/;?><i
                                        class="material-icons right">close</i></span>
                                <p>Precio: <?php echo $res['precio'];?></p>
                                <p>Autor: <?php echo $res['autor'];?></p>
                                <p>Disponibles: <?php echo $res['existencia'];?></p>
                                <p><a href="cusr/carrito?id=<?php echo $res['idlibro'];?>">
                                        <h6>Agregar al carrito</h6>
                                    </a></p>
                                <p><a href="detalles?id=<?php echo $res['idlibro'];?>" target="_blank">
                                        <h6>Ver detalles</h6>
                                    </a></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                ?>
                </div>
        <?php }else{
                header("location: categorias");
            } ?>

    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
    	    $('.collapsible').collapsible();
    	    $('.dropdown-trigger').dropdown();
            $('.sidenav').sidenav();
        });
    </script>
</body>
</html>