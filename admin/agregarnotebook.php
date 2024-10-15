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

    $numero = '';
    // $portada = '';


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $numero = mysqli_real_escape_string($db, $_POST['numero']);
        $numero = strip_tags($numero);
        $numero = preg_replace('/[<>\?\/]/', '', $numero);

        $disponible = $_POST['disponible'];





        if ($numero !== null) {
            // Consulta preparada para seleccionar el email de la base de datos
            $querySelect = "SELECT numero FROM `biblioteca_esc`.`notebooks` WHERE numero = ?";
            $stmt = $db->prepare($querySelect);
            $stmt->bind_param("s", $numero);
            $stmt->execute();
            $stmt->store_result();

            // Verificar si se obtuvo un resultado
            if ($stmt->num_rows > 0) {
                $errores[] = 'Este numero ya está registrado';
            }
            $stmt->close();
        }

        if(!$numero){
            $errores[] = 'El numero es obligatorio';
        }

        if(isset($_POST['compu'])){
            $opcion = $_POST['compu'];
            if($_POST['compu'] == "opcion1"){
                $nombreImg = "compu1.png";
                $numero .= ' ("Vieja")';
            }
            if($_POST['compu'] == "opcion2"){
                $nombreImg = "compu2.jpg"; 
                $numero .= ' ("Nueva")';
            }
        } else {
            $errores[] = "La selección de notebook es obligatoria";
        }
            
        
        


        if(empty($errores)){


                // Insertar en la base de datos
                $query = "INSERT INTO notebooks (numero, portada, disponible, pasado) VALUES ('$numero', '$nombreImg', '$disponible', 0)";
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
    <title>NoteBook</title>
    <link rel="icon" href="../build/img/logo.png" type="png">
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>

    <main class="main">
    <section class="registro contenedorIndex">
        <div class="registro-cont">
            <div class="logoLogin">
                <span>.</span>
                <h2>Agregar Notebook</h2>
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

            <div class="option">
                <label for="compu">
                    <img src="../build/img/compu1.png" alt="">
                    <div class="option">
                        <label for="">Notebooks "Viejas"</label>
                        <input type="radio" name="compu" value="opcion1">
                    </div>
                </label>
                <label for="compu">
                    <img src="../build/img/compu2.jpg" alt="">
                    <div class="option">
                        <label for="">Notebooks "Nuevas"</label>
                        <input type="radio" name="compu" value="opcion2">
                    </div>
                </label>
            </div>

                <label for="numero">Numero De La Maquina:</label>
                <input type="text" placeholder="Numero De La Maquina:" name="numero" id="numero" value="" required>
        
                <label for="">Disponibilidad</label>
                <select name="disponible" id="">
                    <option value="1" select>Disponible</option>
                    <option value="0">No Disponible</option>
                </select>

                <input class="btnLogin" type="submit" value="Agregar NoteBook">
            </form>
            <a class="cuenta" href="/biblioteca/admin/index.php">Volver</a>
        </div>
    </section>

    </main>


    <script src="src/js/alerta.js"></script>

</body>
</html>