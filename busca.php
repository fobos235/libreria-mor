<?php
    session_start();
    include_once("conexion.php");
    $database = new Conecta();
    $db = $database->open();
    $busc = $_GET['busqueda'];
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
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar libros</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php require_once("partials/cabecera.php"); ?>
    <div class="container">
        <div class="row">
            <h5>Resultados por "<?php echo $busc;?>"</h5>
        </div>
        <script>
            
            // creamos el evento para cada tecla pulsada
            document.getElementById("buscar").addEventListener("keypress",verificar);
            function verificar(e) {
        
                // comprovamos con una expresion regular que el caracter pulsado sea
                // una letra, numero o un espacio
                if(e.key.match(/[a-z0-9ñçáéíóú\s]/i)===null) {
        
                    // Si la tecla pulsada no es la correcta, eliminado la pulsación
                    e.preventDefault();
                }
            }
	    </script>
        <div class="row">
            <form action="busca.php" method="get">
                <div class="input-fields col s10">
                    <label for="buscar" >Buscar</label>
                    <input type="text" onKeyPress="return verificar(event)" name="busqueda" id="buscar">
                </div>
                <div class="input-fields col s2">
                <button type="submit" class="btn waves-effect" style="margin-top: 25px; bordes-radius: 3px;"><i class="material-icons">search</i></button>
                </div>

            </form>
        </div>
    <?php
        if(isset($_GET['busqueda'])){
            $cons = $db->prepare("SELECT * FROM inf_libro WHERE (titulo LIKE '%$busc%' OR autor LIKE '%$busc%')");
            $cons->execute();
            ?>
            <div class="row">
            <?php
            while($res = $cons->fetch()){
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
        }
        ?>

        
    </div>

    <!-- SCRIPTS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $(".dropdown-trigger").dropdown();

        });
    </script>
</body>
</html>