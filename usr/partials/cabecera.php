<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-124753453-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-124753453-1');
</script>

<?php
    if(isset($_SESSION['mail'])){
        $mail = $_SESSION['mail'];
        $nomb = $_SESSION['nombre'];
    ?>
    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="../perfil">Perfil</a></li>
        <li><a href="#!">Pedidos</a></li>
        <li class="divider"></li>
        <li><a href="../logout">Cerrar sesión</a></li>
    </ul>

    <!-- NAVBAR CON SESIÓN INICIADA -->
    <nav>
        <div class="nav-wrapper blue-grey">
            <a href="../index" class="brand-logo"><h5>Librería Morelos</h5></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a class="waves-effect waves-light" href="#!">Categorías</a></li>
                <li><a class="waves-effect waves-light" href="#!">Sagas</a></li>
                <li><a class="waves-effect waves-light" href="#!">Lo más vendido</a></li>
                <?php if($_SESSION['rol'] == 2){ ?>
                    <li><a class="waves-effect waves-light" title="Ver carrito de compras" href="carrito"><i class="material-icons prefix">local_grocery_store</i></a></li>
                <?php }else{}?>
                    
                <li><a class="dropdown-trigger" title="Opciones de usuario" href="#" data-target="dropdown1"><?php echo $nomb;?><i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
        </div>
    </nav>
    
    <ul class="sidenav waves-effect" id="mobile-demo">
        <li><a class="waves-effect waves-light" href="#!">Categorías</a></li>
        <li><a class="waves-effect waves-light" href="#!">Sagas</a></li>
        <li><a class="waves-effect waves-light" href="#!">Lo más vendido</a></li>
        <?php if($_SESSION['rol'] == 2){ ?>
            <li><a class="waves-effect waves-light" href="carrito">Ver carrito</a></li>
        <?php }else{}?>
        <li><a href="../perfil">Perfil</a></li>
        <li><a href="#!">Pedidos</a></li>
        <li class="divider"></li>
        <li><a href="../logout">Cerrar sesión</a></li>  
    </ul>
    <?php
    }else{
    ?>
        <!-- NAVBAR SIN SESIÓN INICIADA -->
        <nav>
            <div class="nav-wrapper blue-grey">
                <a href="../index" class="brand-logo"><h5>Librería Morelos</h5></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a class="waves-effect waves-light" href="#!">Categorías</a></li>
                    <li><a class="waves-effect waves-light" href="#!">Lo más vendido</a></li>
                    <li><a class="waves-effect waves-light" href="../login">Iniciar sesión</a></li>
                    <li><a class="waves-effect waves-light" href="../signup">Registrarse</a></li>
                </ul>
            </div>
        </nav>
    
        <ul class="sidenav" id="mobile-demo">
            <li><a href="#!">Categorías</a></li>
            <li><a href="#!">Lo más vendido</a></li>
            <li><a class="waves-effect waves-light modal-trigger" href="../login">Iniciar sesión</a></li>
            <li><a class="waves-effect waves-light modal-trigger" href="../signup">Registrarse</a></li>
        </ul>
<?php
    }
?>