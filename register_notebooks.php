<?php
    require 'includes/config/database.php';
    $db = conectarDB();
    session_start();
    date_default_timezone_set('America/Argentina/Buenos_Aires');


    $idSesion = $_SESSION['id'];
    $query = "SELECT * FROM usuario WHERE idusuario = '$idSesion'";
    $resultado = mysqli_query($db, $query);
    $usuario = mysqli_fetch_assoc($resultado);
    $tipo = $usuario['tipo_idtipo'];

    $idNotebook = $_POST['idnotebook'];

    $queryReservaExistente = "SELECT COUNT(DISTINCT notebooks_idnotebook) AS num_notebook FROM reservasnotebooks WHERE usuario_idusuario = $idSesion";
    $resultadoReservaExistente = mysqli_query($db, $queryReservaExistente);

    $queryNotebook = "SELECT * FROM notebooks WHERE idnotebook = $idNotebook";
    $resultadoNotebook = mysqli_query($db, $queryNotebook);
    $n = mysqli_fetch_assoc( $resultadoNotebook);
    $disponible = $n['disponible'];
    $numeroNotebook = $n['numero'];



    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $fechaActual = date('Y-m-d H:i:s');

        $fechaFinalizacion = new DateTime($fechaActual);
        $fechaFinalizacion->modify('+4 hours');  
        $fechaFinalizacion = $fechaFinalizacion->format('Y-m-d H:i:s');


        if($disponible == 1){
            if($resultadoReservaExistente){
                $cNotebookReservada = mysqli_fetch_assoc($resultadoReservaExistente);
                $cantidadNotebookReservada = $cNotebookReservada['num_notebook'];

                if($cantidadNotebookReservada >= 1){
                    header("Location: notebooks.php?mensaje=Ya tienes una reserva&error=5");
                    exit;
                }
            }

            
            $queryInsertReserva = "INSERT INTO reservasnotebooks (notebooks_idnotebook, usuario_idusuario, usuario_tipo_idtipo, fecha_reserva, fecha_finalizacion, retirado, entregado_esc) VALUES ($idNotebook, $idSesion, $tipo, '${fechaActual}', '${fechaFinalizacion}', 0, 0)";
            $resultadoInsertReserva = mysqli_query($db, $queryInsertReserva);

            if($resultadoInsertReserva){
                $queryUpdate = "UPDATE notebooks SET disponible = 0 WHERE idnotebook = $idNotebook";
                $resultadoUpdate = mysqli_query($db, $queryUpdate);
                
                header("Location: notebooks.php?mensaje=Reserva exitosa&exito=1");
                exit;
                
            }
        }else{
            header("Location: notebooks.php?mensaje=La notebook $numeroNotebook no esta disponible&error=5");
        }
    }



?>