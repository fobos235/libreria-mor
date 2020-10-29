<?php
    session_start();
    if(isset($_SESSION['rol']) && $_SESSION['rol'] == 1){
        $mail = $_SESSION['mail'];
        $nomb = $_SESSION['nombre'];
    ?>
    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="../perfil">Perfil</a></li>
        <li class="divider"></li>
        <li><a href="../logout">Cerrar sesión</a></li>
    </ul>

     <!-- NAVBAR CON SESIÓN INICIADA -->
     <nav>
        <div class="nav-wrapper blue-grey">
            <a href="index" class="brand-logo"><h5>Librería Morelos</h5></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a class="waves-effect waves-light" href="panel_libro">Libros</a></li>
                <li><a class="waves-effect waves-light" href="comentarios">Comentarios</a></li>
                <li><a class="waves-effect waves-light" href="#!">Clientes</a></li>
                <?php if($_SESSION['rol'] == 2){ ?>
                    <li><a class="waves-effect waves-light" href="#"><i class="material-icons prefix">local_grocery_store</i></a></li>
                <?php }else{}?>
                    
                <li><a class="dropdown-trigger" href="#" data-target="dropdown1"><?php echo $nomb;?><i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
        </div>
    </nav>
    
    <ul class="sidenav" id="mobile-demo">
        <center><h5><?php echo $_SESSION['nombre'];?></h5></center>
        <li class="divider"></li>
        <li><a class="waves-effect waves-light" href="panel_libro">Libros</a></li>
        <li><a class="waves-effect waves-light" href="comentarios">Comentarios</a></li>
        <li><a class="waves-effect waves-light" href="#!">Clientes</a></li>
        <li><a href="../perfil">Perfil</a></li>
        <li class="divider"></li>
        <li><a href="../logout">Cerrar sesión<i class="material-icons right">exit_to_app</i></a></li>
    </ul>
    </ul>
        
    <?php
    }else{
    ?>
        <center>
            <h3>Esta es una zona administrativa</h3>
            <h5>No tienes permiso para estar aquí</h5>
            <?php header("location: /alpha-lib/"); sleep(2); ?>
        </center>
<?php   
    }
?>

