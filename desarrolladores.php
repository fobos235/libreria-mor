<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desarrolladores</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php
        include_once("partials/cabecera.php");
    ?>
    <div class="container">
        <div class="row">
            <img class="left" src="img/escudo.png" alt="Kodika soft" width="130px" title="Kodika Soft">
            <img src="img/image1097.png" alt="Libreria Morelos" class="right"  width="100px" title="Libreria Morelos">
        </div>

        <div class="row">
            <h5><b>Kodika Soft</b><br></h5>
            Una empresa moreliana de desarrollo de software que utiliza las mejores tecnologías web para el desarrollo de aplicaciones
            a medida. Kodika Soft busca ganar prestigio a nivel local para posteriormente ganar terreno a nivel regional, estatal y nacional. <br>

            <h5><b>Equipo de trabajo</b></h5><br>
            <b>Francisco Javier Tinajero Martínez</b><br>
            Lider de proyecto. Encargado de manejar el equipo, así como manejo de base de datos y programador web. <br><br>

            <b>Aurelio Murillo Pineda</b><br>
            Encargado de programación de modulos del sistema y elaboración de manuales de usuario y técnicos, ejecución de pruebas del sitio. <br><br>

            <b>Diego Alan Madrigal López</b><br>
            Encargado de diseño de logotipos, diseño de interfaces, desarrollador web y elaboracion de manuales técnico y de usuario. <br><br>

            <b>Arturo Andrade Molina</b> <br>
            Elaboración de maquetación del sitio, programación de módulos y manejo de base de datos a nivel de vistas y consultas. <br><br>
        </div>
        <center>
            Quinto cuatrimestre. TSU Tecnologías de la Información y la Comunicación. Area de sistemas informáticos
            <br>
            Universidad Tecnológica de Morelia. <br>
            1 de abril de 2019
        </center> <br><br>
    </div>

    <?php include_once("partials/footer.php"); ?>
    <!--SCRIPTS-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
    //inicializacion
    $(document).ready(function() {
        $('.sidenav').sidenav();
        $(".dropdown-trigger").dropdown();

    });
    
</body>
</html>