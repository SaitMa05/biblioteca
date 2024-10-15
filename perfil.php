<?php
    include './includes/templates/header.php';
    $usuarioId = $usuario['idusuario'];
    $queryPerfil = "SELECT u.* FROM `biblioteca_esc`.`usuario` u INNER JOIN `biblioteca_esc`.`perfill` p ON u.idusuario = p.usuario_idusuario WHERE p.usuario_idusuario = $usuarioId";
    $resultadoPerfil = mysqli_query($db, $queryPerfil);

    $errores = [];

    if($resultadoPerfil && mysqli_num_rows($resultadoPerfil) > 0) {
        $usuarioPerfil = mysqli_fetch_assoc($resultadoPerfil);

        $id = $usuarioPerfil['idusuario'];
        $nombre = $usuarioPerfil['nombre'];
        $apellido = $usuarioPerfil['apellido'];
        $email = $usuarioPerfil['email'];
        $telefono = $usuarioPerfil['telefono'];
        $dni = $usuarioPerfil['dni'];
        $imagen = $usuarioPerfil['imagen'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK){
            $imagenActualizada = $_FILES['imagen'];
            $carpetaImg = 'admin/imagenes/';
            if(!is_dir($carpetaImg)){
                mkdir($carpetaImg);
            }
            if($imagenActualizada['name']){
                // Eliminar la imagen previa
                unlink($carpetaImg . $imagen);
                header("Location: ".$_SERVER['PHP_SELF']);
            }
            
            $nombreImg = md5(uniqid(rand(), true)) . ".jpg";

            // Mover el archivo solo si se cargó correctamente
            move_uploaded_file($imagenActualizada['tmp_name'], $carpetaImg . $nombreImg);

            $query = "UPDATE usuario SET imagen = '{$nombreImg}' WHERE idusuario = $id";
            $resultado = mysqli_query($db, $query);
        }else{
            $errores[] = "No hay ninguna foto selecionada";
        }
    }
?>

<main class="main contenedor perfilEditar">
    <div class="btnsPerfil">
        <a href="/biblioteca/cambiarpassword.php">Cambiar Contraseña</a>
        <a href="/biblioteca/cerrar_sesion.php">Cerrar Sesion</a>
    </div>
    <?php  foreach($errores as $error) : ?>
                <div class="alerta error contA">
                    <?php echo $error; ?>
                </div>
            <?php endforeach ?>
    <form action="perfil.php" class="perfilForm" method="POST" enctype="multipart/form-data">
        <?php //var_dump($nombreImg) ?>
        <label for="nombre">Nombre:</label>
        <input type="text" value="<?php echo $nombre ?>" readonly>

        <label for="apellido">Apellido:</label>
        <input type="text" value="<?php echo $apellido ?>" readonly>

        <label for="email">Email:</label>
        <input type="text" value="<?php echo $email ?>" readonly>

        <label for="telefono">Telefono:</label>
        <input type="text" value="<?php echo $telefono ?>" readonly>

        <label for="dni">D.N.I:</label>
        <input type="text" value="<?php echo $dni ?>" readonly>

        <label class="fotoLabel" for="">Foto de perfil Actual:</label>
        <div class="imgEditar">
            <img src="/biblioteca/admin/imagenes/<?php echo $imagen ?>" alt="imagen de perfil">
            <input class="archivo bg-white" type="file" id="imagen" name="imagen" accept="image/jpg, image/png">
            <input class="btnActualizar" type="submit" value="Actualizar Foto">
        </div>
    </form>
</main>

<?php 
    include './includes/templates/footer.php';
?>
