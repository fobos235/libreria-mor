<?php
    include_once("../../conexion.php");
    $database = new Conecta();
    $db = $database->open();
    $libros = $db->prepare("SELECT idautor, nombre FROM autor ORDER BY nombre ASC");
    $libros->execute();

    $cat = $db->prepare("SELECT * FROM categoria ORDER BY nombre ASC");
    $cat->execute();

    $edit = $db->prepare("SELECT * FROM editorial ORDER BY nombre ASC");
    $edit->execute();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración - Agregar Libros</title>
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php
        include_once("partials/cabecera.php");
    ?>
        <div class="container">
            <div class="row">
                <h3>Agregar libros</h3>
            </div>
            <form action="" class="col s12" enctype="multipart/form-data" method="POST">
                <div class="row">
                    <div class="input-field col s4">
                        <input id="titulo" name="titulo" type="text" placeholder="Título">
                        <label for="titulo">Título</label>
                    </div>
                    <div class="input-field col s4">
                        <select id="autor" name="autor">
                            <option value="" disabled selected>Elegir un autor</option>
                            <!-- LAS OPCIONES SE AGREGARÁN CON PHP -->
                            <?php
                                while($res = $libros->fetch()){
                                    ?>
                                    <option value="<?php echo $res['idautor']; ?>"><?php echo $res['nombre'];?></option>
                                    <?php
                                }
                                
                            ?>
                        </select>
                        <label for="autor">Autor</label>
                    </div>

                    <div class="input-field col s4">
                        <select id="autor" name="categoria">
                            <option value="" disabled selected>Elegir una categoría</option>
                            <!-- LAS OPCIONES SE AGREGARÁN CON PHP -->
                            <?php
                                while($res = $cat->fetch()){
                                    ?>
                                    <option value="<?php echo $res['idCat']; ?>"><?php echo $res['nombre'];?></option>
                                    <?php
                                }
                                
                            ?>
                        </select>
                        <label for="autor">Categoría</label>
                    </div>
                    <div class="input-field col s2">
                        <input id="edicion" name="edicion" type="text" placeholder="Edición">
                        <label for="edicion">Edición</label>
                    </div>

                    <div class="input-field col s2">
                        <input id="precio"name="precio" type="text" placeholder="Precio">
                        <label for="precio">Precio</label>
                    </div>

                    <div class="input-field col s3">
                        <select name="editorial" id="editorial">
                            <option value="" disabled selected>Elige la editorial</option>
                            <?php
                                while($res = $edit->fetch()){
                                    ?>
                                    <option value="<?php echo $res['idEditorial']; ?>"><?php echo $res['nombre'];?></option>
                                    <?php
                                }
                                
                            ?>
                        </select>
                        
                        <label for="editorial">Editorial</label>
                    </div>

                    <div class="file-field input-field col s5">
                        <div class="btn">
                            <span>Imagen</span>
                            <input name="foto" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Imágen de portada">
                        </div>
                    </div>
                    <div class="input-field col s2">
                        <input id="existencia" name="existencia" type="text" placeholder="Existencia">
                        <label for="existencia">Existencia</label>
                    </div>
                    <div class="input-field col s10">
                        <input id="desc" name="descripcion" type="text" placeholder="Descripción">
                        <label for="desc">Descripción del libro</label>
                    </div>
                </div>
                <center>
                <a href="javascript:window.history.back()" class="btn btn-flat btn-large "><i class="material-icons left">reply</i>Volver</a>
                <button class="btn-flat btn-large waves-effect" type="reset"><i class="material-icons left">clear_all</i>Limpiar</button>
                <button class="btn btn-large waves-effect" name="add" type="submit"><i class="material-icons right">add</i>Agregar</button>
                </center>
            </form>
        </div>

    <!-- SCRIPTS -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/materialize.min.js"></script>
    <script>
        //inicialización
        $(document).ready(function(){
            $(".dropdown-trigger").dropdown();
            $(".sidenav").sidenav();
            $('select').formSelect();
 
        });
    </script>

    <?php
        if(isset($_POST['add'])){
            $autor = $_POST['autor'];
            echo $autor;
            $filetemp= $_FILES['foto']['tmp_name'];
            $nomb_foto = $_FILES['foto']['name'];
            $destino=$_SERVER['DOCUMENT_ROOT'].'/alpha-lib/img/portadas/';
            $filetype = $_FILES['foto']['type'];
            $sql = $db->prepare("INSERT INTO libro (titulo, edicion, precio, descripcion, img, existencia, editorial_id) VALUES (?,?,?,?,?,?,?)");
            $sql->bindParam(1, $_POST['titulo']);
            $sql->bindParam(2, $_POST['edicion']);
            $sql->bindParam(3, $_POST['precio']);
            $sql->bindParam(4, $_POST['descripcion']);
            $sql->bindParam(5, $nomb_foto);
            $sql->bindParam(6, $_POST['existencia']);
            $sql->bindParam(7, $_POST['editorial']);
            if($sql->execute()){
                $id = $database->conn->lastInsertId();
                try{
                    $sql = $db->prepare("INSERT INTO libro_has_autor (libro_idlibro, autor_idAutor) VALUES (?,?)");
                    $sql->bindParam(1, $id);
                    $sql->bindParam(2, $_POST['autor']);
                    if($sql->execute()){

                        $sql = $db->prepare("INSERT INTO libro_has_categoria (libro_idlibro, categoria_idCat) VALUES (?,?)");
                        $sql->bindParam(1, $id);
                        $sql->bindParam(2, $_POST['categoria']);
                        $sql->execute();

                        try{
                        move_uploaded_file($filetemp, $destino.$nomb_foto);
                        }catch(Exception $e){
                            echo $e->getMessage();
                        }
                    }else{
                        echo "Error al relacionar con el autor";
                    }
                    
                }catch(Exception $e){
                    $e->getMessage();
                }
                echo '<center>Se agregó el libro '. $_POST['titulo'].'con el id: '.$id.'</center>';
            }else{
                echo "<script>window.alert('falló la insersión')</script>";
            }
        }
    ?>
    <script>
        //inicialización
        $(document).ready(function(){
            $('.collapsible').collapsible();
            $('.dropdown').dropdown();
            $('.sidenav').sidenav();
        })
    </script>

</body>
</html>