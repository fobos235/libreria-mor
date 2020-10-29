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
    $database = new Conecta();
    $db = $database->open();
    $query = $db->prepare("SELECT * FROM inf_libro LIMIT 8");
    $query->execute(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Librería Morelos</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>

<body>
    <?php
        require_once("partials/cabecera.php");
    ?>

    <!-- INICIO DEL CAROUSEL -->
    <div class="carousel carousel-slider center hide-on-small-and-down">
        <div class="carousel-fixed-item center">
            <?php if(isset($_SESSION['mail'])){}else{ ?>
            <a class="waves-effect  btn white-text waves-light modal-trigger" href="login">Acceder</a>
            <?php } ?>
        </div>
        <div style="background-image: url('img/libreria1.jpg'); background-size: 100%;"
            class="carousel-item red white-text" href="#one!">
            <h1>Bienvenido</h1>
            <p class="white-text">
                <h2>Aquí encontrarás los mejores libros</h2>
            </p>
        </div>
        <div style="background-image: url('img/libreria2.jpg'); background-size: 100%;"
            class="carousel-item amber white-text" href="#two!">
            <h1>Colecciones de sagas</h1>
            <p class="white-text">
                <h2>Las mejores sagas <br>a los mejores precios</h2>
            </p>
        </div>
        <div style="background-image: url('img/libreria3.jpg'); background-size: 100%;"
            class="carousel-item green white-text" href="#three!">
            <h1>Libros educativos</h1>
            <p class="white-text">
                <h2>Libros para gran variedad de<br>cursos y carreras.</h2>
            </p>
        </div>
        <div style="background-image: url('img/libreria4.jpg'); background-size: 100%;"
            class="carousel-item blue white-text" href="#four!">
            <h1>Muchas personas lo están probando</h>
                <p class="white-text">
                    <?php if(isset($_SESSION['mail'])){}else{ ?>
                    <h2><a class="waves-effect waves-light modal-trigger" href="signup">¡Regístrate!</a> es gratis.</h2>
                    <?php } ?>
                </p>
        </div>
    </div>
    <!-- FIN DEL CAROUSEL -->
    <br>
    <!-- CONTENEDOR DE LOS PRODUCTOS -->
    <div class="container">
        <div class="row">
            <h4>Estas son nuestras novedades</h4>
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
            function val(){
                var busca = document.getElementById("buscar").value;
                if(busca.empty){
                    alert("Ingrese algún texto para hacer una busqueda");
                    return false;
                }
            }
	    </script>
        <div class="row">
            <form action="busca.php" method="get" onsubmit="return val()">
                <div class="input-fields col s10">
                    <label for="buscar" >Buscar</label>
                    <input type="text" onkeypress="return verificar(event)" name="busqueda" id="buscar" required>
                </div>
                <div class="input-fields col s2">
                    <button type="submit" class="btn waves-effect" style="margin-top: 25px; bordes-radius: 3px;"><i class="material-icons">search</i></button>
                </div>
                
            </form>
        </div>

        <div class="row">
            <?php
            while($res = $query->fetch()){
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
                        <p><a href="usr/carrito?id=<?php echo $res['idlibro'];?>">
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
    </div>
    <br>
    <?php
        require_once("partials/footer.php");
    ?>

    <!-- Libros -->


    <!--SCRIPTS-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
    //inicializacion
    $(document).ready(function() {
        $('.sidenav').sidenav();
        $('.carousel').next(5);
        $(".dropdown-trigger").dropdown();
        $('.carousel.carousel-slider').carousel({
            fullWidth: true,
            indicators: true,
        });

    });

    $('.carousel').carousel();
    setInterval(function() {
        $('.carousel').carousel('next');
    }, 10000);

    
    </script>
</body>

</html>