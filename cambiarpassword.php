<?php
require './includes/config/database.php';
$db = conectarDB();

if(!isset($_SESSION)){
    session_start();
}

$auth = $_SESSION['login'];
if(!$auth){
    header("Location: /biblioteca/login.php");
}

require './includes/selects/user.php';

$errores = [];


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $usuario['idusuario'];
    $passwordActual = $_POST['passwordActual'];
    $passwordNueva = $_POST['passwordNueva'];
    $cofirmarNuevaPassword = $_POST['cofirmarNuevaPassword'];

    $passwordActual = mysqli_real_escape_string($db, $passwordActual);
    $passwordNueva = mysqli_real_escape_string($db, $passwordNueva);
    $cofirmarNuevaPassword = mysqli_real_escape_string($db, $cofirmarNuevaPassword);

    
    $passwordUser = $usuario['password'];
    $auth = password_verify($passwordActual, $passwordUser);
    if($auth){
        if($passwordNueva == $cofirmarNuevaPassword){
            $passwordHash = password_hash($passwordNueva, PASSWORD_DEFAULT);
            $query = "UPDATE usuario SET password = '{$passwordHash}' WHERE idusuario = $id";
            $resultado = mysqli_query($db, $query);
            header("Location: /biblioteca/principal.php");
        }
    }else{
        $errores[] = "Las contraseñas no coinciden";
    }


}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="icon" href="/biblioteca/build/img/logo.png" type="png">
    <link rel="stylesheet" href="/biblioteca/build/css/app.css">
</head>
<body>
    
    <main class="main">
    <section class="registro contenedor">
        <div class="registro-cont">
            <div class="logoLogin">
                <img src="/biblioteca/build/img/logo.png" alt="logo escuela">
                <h2>Cambiar Contraseña</h2>
                <span>Registro</span>
            </div>

            <?php  foreach($errores as $error) : ?>
                <div class="alerta error">
                <?php echo $error; ?>
                </div>
            <?php endforeach ?>

            <form class="formularioLogin" action="cambiarpassword.php" method="POST">

            
                <label for="passwordActual">Contraseña Actual:</label>
                <input type="password" placeholder="Contraseña Actual" name="passwordActual" id="passwordActual" value="" required>

                <label for="passwordNueva">Nueva Contraseña:</label>
                <input type="password" placeholder="Nueva Contraseña" name="passwordNueva" id="passwordNueva" value="" required>

                <label for="cofirmarNuevaPassword">Confirmar Nueva Contraseña:</label>
                <input type="password" placeholder="Confirmar Nueva Contraseña" name="cofirmarNuevaPassword" id="cofirmarNuevaPassword" required>


                <input class="btnLogin" type="submit" value="Cambiar Contraseña">
            </form>
            <a class="cuenta" href="perfil.php">Volver</a>
            

        </div>
    </section>

    </main>


    <script src="src/js/app.js"></script>
</body>
</html>