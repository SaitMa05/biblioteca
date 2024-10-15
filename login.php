<?php

    require 'includes/config/database.php';
    $db = conectarDB();

    $errores = [];
    $email = "";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        $password = strip_tags($password);

        
        if(!$email){
            $errores[] = "El email es obligatorio o no es valido";
        }
        if(!$password){
            $errores[] = "es password es obligatorio";
        }

        if(empty($errores)){
            // Revisar si el usuario existe
            $query = "SELECT * FROM usuario WHERE email = '${email}' ";
            $resultado = mysqli_query($db, $query);
            // var_dump($resultado);

            if($resultado->num_rows){
                $usuario = mysqli_fetch_assoc($resultado);
                if($usuario['aceptado'] == "1"){
                    $auth = password_verify($password, $usuario['password']);
                    if($auth){
                        $querySesion = "UPDATE usuario SET session = 1 WHERE email = '${email}'";
                        $resultadoSesion = mysqli_query($db, $querySesion);
                        session_start();
                        $_SESSION['id'] = $usuario['idusuario'];
                        $_SESSION['usuario'] = $usuario['email'];
                        $_SESSION['login'] = true;
                        $_SESSION['tipo'] = $usuario['tipo_idtipo'];
                        // var_dump($_SESSION);

                        header("Location: principal.php");
                    }else{
                        $errores[] = "El password es icorrecto";
                    }
                }else{
                    $errores[] = "El usuario aun no ha sido aceptado";
                }
            }else{
                $errores[] = "El usuario no existe";
            }

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
                <h2>Iniciar Session</h2>
                <span>Registro</span>
            </div>

            <?php  foreach($errores as $error) : ?>
                <div class="alerta error">
                <?php echo $error; ?>
                </div>
            <?php endforeach ?>

            <form class="formularioLogin" action="login.php" method="POST">

                <label for="email">Email:</label>
                <input type="email" placeholder="Email" name="email" id="email" value="<?php if(!$email){echo "";}else{echo $email;}?>" required>

                <label for="email">Contraseña:</label>
                <input type="password" placeholder="Contraseña" name="password" id="password" required>


                <input class="btnLogin" type="submit" value="Iniciar Session">
            </form>
            <a class="cuenta" href="registrarse.php">Aun no tienes una cuenta? Registrate</a>

        </div>
    </section>

    </main>


    <script src="src/js/alerta.js"></script>
</body>
</html>