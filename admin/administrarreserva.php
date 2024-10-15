<?php
    $id_reservas = $_GET['id'];
    if(!$id_reservas){
        header("Location: /biblioteca/admin/reservas.php");
    }
    require '../includes/config/database.php';
    $db = conectarDB();
    // var_dump($db)
    session_start();
    $idSesion = $_SESSION['id'];

    include '../includes/selects/user.php';


    $auth = $_SESSION['login'];

    if($usuario['tipo_idtipo'] == 1 || !$auth){
        header("Location: /biblioteca/principal.php");
    }

    $queryLibroId = "SELECT * FROM reservas WHERE idreservas = $id_reservas";
    $resultadoLibroId = mysqli_query( $db, $queryLibroId );
    $libros = mysqli_fetch_assoc( $resultadoLibroId );
    $libro_id = $libros['libros_libros_idlibros'];
    

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(isset($_POST['retirado'])){
            $retirado = $_POST['retirado'];
        }
        if(isset($_POST['entregado'])){
            $entregado = $_POST['entregado'];
        }

        if(isset($retirado)){
            $queryRetirado = "UPDATE reservas SET retirado = 1 WHERE idreservas = $id_reservas";
            $resultadoRetirado = mysqli_query($db, $queryRetirado);
            
            header("Location: /biblioteca/admin/reservas.php");
            exit;
        }
        if(isset($entregado)){
            $queryEntregado = "DELETE FROM reservas WHERE idreservas = $id_reservas";
            $resultadoEntregado = mysqli_query($db, $queryEntregado);
            
            if($resultadoEntregado){
                $queryLibro = "SELECT * FROM libro WHERE idlibros = $libro_id";
                $resultadoLibro = mysqli_query($db, $queryLibro);
                $libro = mysqli_fetch_assoc($resultadoLibro);
                
                $cantidad = $libro["cantidad"];
                $cantidad = intval($cantidad);
                $cantidad = $cantidad+1;
                $queryUpdate = "UPDATE libro SET cantidad = '${cantidad}' WHERE idlibros = $libro_id";
                $resultadoUpdate = mysqli_query($db, $queryUpdate);

                header("Location: /biblioteca/admin/reservas.php");
                exit;
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
                <h2>Administracion de Reservas</h2>
                <span>.</span>
            </div>

            <form class="formularioLogin" method="POST" enctype="multipart/form-data">

                    <input class="alerta warning p-1" type="submit" name="retirado" value="Marcar como Retirado">
                    <input class="alerta exito p-1" type="submit" name="entregado" value="Marcar como Entregado">

            </form>
            <a class="cuenta" href="/biblioteca/admin/reservas.php">Volver</a>
        </div>
    </section>

    </main>


    <script src="src/js/alerta.js"></script>

</body>
</html>