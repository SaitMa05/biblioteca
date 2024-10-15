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

    $categorias = '';


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $categorias = mysqli_real_escape_string($db, $_POST['categorias']) ;


        $categorias = strip_tags($categorias);




        if ($categorias !== null) {
            $querySelect = "SELECT nombre FROM `biblioteca_esc`.`categorias` WHERE nombre = ?";
            $stmt = $db->prepare($querySelect);
            $stmt->bind_param("s", $categorias);
            $stmt->execute();
            $stmt->store_result();
        
            // Verificar si se obtuvo un resultado
            if ($stmt->num_rows > 0) {
                $errores[] = 'Esta categoria ya se encuentra';
            }
            $stmt->close();
        }
        



        if(!$categorias){
            $errores[] = 'La categoria es obligatoria';
        }






        if(empty($errores)){


                // Insertar en la base de datos
                $query = "INSERT INTO categorias (nombre) VALUES ('$categorias')";
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
                <h2>Agregar Categoria</h2>
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
                    <label for="categorias">Categoria:</label>
                    <input type="text" placeholder="Categoria ya sea Materias o Novelas, Cuentos, Etc" name="categorias" id="categorias" value="" required>

                <input class="btnLogin" type="submit" value="Agregar Categoria">
            </form>
            <a class="cuenta" href="/biblioteca/admin/index.php">Volver</a>
        </div>
    </section>

    </main>


    <script src="src/js/alerta.js"></script>

</body>
</html>