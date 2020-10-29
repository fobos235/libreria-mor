<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documentación</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <?php include("partials/cabecera.php"); ?>
    <div class="container">
    <div class="row">
        <h4>Documentación - Librería Morelos</h4>
    </div>
    <ul class="collapsible">
        <li>
            <div class="collapsible-header"><i class="material-icons">golf_course</i>Misión</div>
            <div class="collapsible-body"><span>Brindar un sistema de calidad que resuelva las 
            necesidades que haya en la empresa de la manera
             más eficiente posible, dentro de la librería.</span></div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">visibility</i>Visión</div>
            <div class="collapsible-body"><span>Ser un sistema que satisfaga las necesidades de la librería,
            con buena seguridad y una reputación impecable que pueda ser aplicado en más empresas del sector.</span></div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">location_searching</i>Objetivos</div>
            <div class="collapsible-body"><span>
            <b>Objetivo General:</b><br>
                Ayudar a la organización y ampliar las ventas de la librería Morelos mediante el uso de tecnologías 
                web, mejorando el servicio de esta además de poder llegar a más clientes por este medio, además de 
                optimizar los procedimientos de la librería.<br><br>
            <b>Objetivo específico:</b><br>
                Facilitar la compra de libros a los clientes de manera virtual y los datos de sus pedidos,
                así como automatizar las funciones que llevan a cabo los empleados de la librería para mejorar 
                la calidad de del servicio.
            </span></div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">format_list_numbered</i>Plan de proyecto</div>
            <div class="collapsible-body"><span>De acuerdo con el análisis del proyecto se procedió a crear un diseño de
             la base de datos para así hacer un prototipo de las características del proyecto, así como un calendario de 
             actividades donde se calcula el tiempo estimado para la terminación del proyecto y un análisis del costo total. <br>
            <center>
                <table>
                    <tr>
                        <th>Nombre</th>
                        <th>Sueldo por hora</th>
                        <th>Horas trabajadas</th>
                        <th>Sueldo total</th>
                    </tr>
                    <tr>
                        <td>Francisco Javier Tinajero</td>
                        <td>30.79</td>
                        <td>200</td>
                        <td>6158</td>
                    </tr>
                    <tr>
                        <td>Aurelio Murillo Pineda</td>
                        <td>49.23</td>
                        <td>140</td>
                        <td>6892</td>
                    </tr>
                    <tr>
                        <td>Diego Alan Madrigal</td>
                        <td>49.23</td>
                        <td>140</td>
                        <td>6892</td>
                    </tr>
                    <tr>
                        <td>Arturo Andrade Molina</td>
                        <td>43.08</td>
                        <td>140</td>
                        <td>6031</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right"><b>Total</b></td>
                        <td>25973</td>
                    </tr>
                </table>
            </center>
             </span></div>
        </li>
        <li>
            <div class="collapsible-header"><i class="material-icons">insert_link</i>Descargas</div>
            <div class="collapsible-body"><span>
                <table>
                    <tr>
                        <th>Codigo</th>
                        <th>Manual Técnico</th>
                        <th>Manual de usuario</th>
                    </tr>
                    <tr>
                        <th><a href="">libreria.zip</a></th>
                        <th><a href="">manual_tecnico.pdf</a></th>
                        <th><a href="">manual_usuario.pdf</a></th>
                    </tr>
                </table>
            </span></div>
        </li>
    </ul>
    </div>
    <br><br>
    <center>
        Librería Morelos: Un software desarrollado por Kodika Soft
    </center>
    <br>

    <!-- SCRIPTS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script>
        // Inicializacion
        $(document).ready(function(){
            $('.dropdown-trigger').dropdown();
            $('.collapsible').collapsible();
            $('.sidenav').sidenav();
        })
    </script>
</body>
    <?php include_once("partials/footer.php"); ?>
</html>