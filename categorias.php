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
    include_once("conexion.php");
    $dababase = new Conecta();
    $db = $dababase->open();
    $categoria = $db->prepare("SELECT * FROM categoria");
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php include_once("partials/cabecera.php"); ?>
    <div class="container">
        <div class="row"><h5>Categorías</h5></div>
        <div class="row"> <?php
            while($cate = $categoria->fetch()){ ?>
                <a href="libros_cat?idCat=<?php echo $cate['idCat'];?>">
                    <div class="col s12 m4 center" id="panel_libros">
                        <div class="card-panel grey lighten-2 hoverable">
                            <span class="black-text">
                                <i class="material-icons fixed medium">local_library</i>
                                <p><?php echo $cate['nombre']; ?></p>
                            </span>
                        </div>
                    </div>
                </a>
        <?php }
        ?> 
        </div>
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