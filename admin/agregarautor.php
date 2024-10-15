<?php
    require '../includes/config/database.php';
    $db = conectarDB();
    // var_dump($db)

    session_start();
    include '../includes/selects/user.php';

    $auth = $_SESSION['login'];

    if($usuario['tipo_idtipo'] == 1 || !$auth){
        header("Location: /biblioteca/principal.php");
    }

    $errores = [];

    $nombre = '';
    $nacionalidad = '';
    $fecha_nacimiento = '';
    $biografia = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nombre = mysqli_real_escape_string($db, $_POST['nombre']) ;
        $nacionalidad = mysqli_real_escape_string($db, $_POST['nacionalidad']);
        $fecha_nacimiento = mysqli_real_escape_string($db, $_POST['fecha']);
        $biografia = mysqli_real_escape_string($db, $_POST['biografia']);

        $nombre = strip_tags($nombre);
        $nacionalidad = strip_tags($nacionalidad);
        $fecha_nacimiento = strip_tags($fecha_nacimiento);
        // $biografia = strip_tags($biografia);

        $nombre = preg_replace('/[<>\?\/]/', '', $nombre);
        $nacionalidad = preg_replace('/[<>\?\/]/', '', $nacionalidad);
        $fecha_nacimiento = preg_replace('/[<>\?\/]/', '', $fecha_nacimiento);
        // $biografia = preg_replace('/[<>\?\/]/', '', $biografia);

        if ($nombre !== null && $apellido !== null && $fecha_nacimiento !== null && $nacionalidad !== null) {
            $querySelect = "SELECT nombre, fecha_nacimiento, nacionalidad FROM `biblioteca_esc`.`autor` WHERE nombre = ? AND fecha_nacimiento = ? AND nacionalidad = ?";
            $stmt = $db->prepare($querySelect);
            $stmt->bind_param("ssss", $nombre, $fecha_nacimiento, $nacionalidad);
            $stmt->execute();
            $stmt->store_result();
        
            // Verificar si se obtuvo un resultado
            if ($stmt->num_rows > 0) {
                $errores[] = 'Este autor ya está registrado';
            }
            $stmt->close();
        }
        



        if(!$nombre){
            $errores[] = 'El nombre es obligatorio';
        }


        if(!$nacionalidad){
            $errores[] = 'La nacionalidad es obligatoria';
        }

        if(!$fecha_nacimiento){
            $errores[] = 'La fecha de nacimiento es obligatoria';
        }

        if(!$biografia){
            $errores[] = 'La biografia es obligatoria';
        }





        if(empty($errores)){


                // Insertar en la base de datos
                $query = "INSERT INTO autor (nombre, nacionalidad, fecha_nacimiento, biografia) VALUES ('$nombre', '$nacionalidad', '$fecha_nacimiento', '$biografia')";
                // echo $query;

                $resultado = mysqli_query($db, $query);

                

                if($resultado){
                    header("Location: /biblioteca/admin/index.php");
                }

        }
    }







?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="icon" href="../build/img/logo.png" type="png">
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>

    <main class="main">
    <section class="registro contenedorIndex">
        <div class="registro-cont">
            <div class="logoLogin">
                <span>.</span>
                <h2>Agregar Autor</h2>
                <span>.</span>
            </div>


            <?php if ($errores !== null) : ?>
                <?php foreach($errores as $error) : ?>
                    <div class="alerta error">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach ?>
            <?php endif ?>

            <form class="formularioLogin" method="POST" enctype="multipart/form-data">

                <div class="caja"> <!-- Caja inicio-->
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" placeholder="Nombre del Autor" name="nombre" id="nombre" value="" required>
                </div> <!-- Caja fin-->

                <label for="nacionalidad">Nacionalidad:</label>
                <input type="text" placeholder="Nacionalidad" name="nacionalidad" id="nacionalidad" value="" required>
                

                <label for="fecha">Fecha de Nacimiento:</label>
                <input class="dateReserva" name="fecha" type="date">

                <label for="biografia">Biografia:</label>
                <input type="text" placeholder="Biografia (Introducir un link de alguna pagina)" name="biografia" id="biografia" value="" required>

                <input class="btnLogin" type="submit" value="Agregar Autor">
            </form>
            <a class="cuenta" href="/biblioteca/admin/index.php">Volver</a>
        </div>
    </section>

    </main>


    <script src="src/js/alerta.js"></script>

</body>
</html>