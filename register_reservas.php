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

    $idLibro = $_POST['idLibro'];
    $queryLibros = "SELECT libro.*, autor.* , libros.*
    FROM libros
    JOIN libro ON libros.libros_idlibros = libro.idlibros
    JOIN autor ON libros.autor_idautor = autor.idautor WHERE libroscol = $idLibro";
    $resultadoLibros = mysqli_query($db, $queryLibros);
    $libro = mysqli_fetch_assoc($resultadoLibros);
    
    $id_libro_solo = $libro["idlibros"];
    $idAutor = $libro['idautor'];
    // var_dump($idAutor);

    $queryReserva = "SELECT * FROM reservas WHERE libros_libroscol = $idLibro AND usuario_idusuario = $idSesion";
    $resultadoReserva = mysqli_query($db, $queryReserva);

    $queryReservaExistente = "SELECT COUNT(DISTINCT libros_libroscol) AS num_libros FROM reservas WHERE usuario_idusuario = $idSesion";
    $resultadoReservaExistente = mysqli_query($db, $queryReservaExistente);

    


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $fechaReserva = $_POST['dateReserva'];
        $fechaActual = date('Y-m-d');

        if($resultadoReservaExistente){
            $cLibrosReservado = mysqli_fetch_assoc($resultadoReservaExistente);
            $cantidadLibrosReservado = $cLibrosReservado['num_libros'];

            if($cantidadLibrosReservado >= 3){
                header("Location: libros.php?mensaje=Error: Ya tienes 3 libros reservados&error=5");
                exit;
            }

        }
        if(isset($fechaReserva) && !empty($_POST['dateReserva'])){
            if($fechaReserva < $fechaActual){
                header("Location: libros.php?mensaje=La fecha de reserva no puede ser menor&error=2");
            }else{
                $fechaReservaObj = new DateTime($fechaReserva);
                $diasDisponibles = 14;
                $fechaFinalizacion = date('Y-m-d', strtotime("$fechaReserva +$diasDisponibles days"));
    

                if(mysqli_num_rows($resultadoReserva) > 0){
                    header("Location: libros.php?mensaje=Ya tienes una reserva de este libro&error=4");
                    exit;
                }else{
                    $cantidad = $libro['cantidad'];

                    if($cantidad > 0){   
                    $queryInsertReserva = "INSERT INTO reservas (libros_libroscol, libros_libros_idlibros, libros_autor_idautor, usuario_idusuario, usuario_tipo_idtipo, fecha_reserva, fecha_finalizacion, retirado, entregado_esc) VALUES ($idLibro, $id_libro_solo, $idAutor, $idSesion, $tipo, '${fechaReserva}', '${fechaFinalizacion}', 0, 0)";
                    $resultado = mysqli_query($db, $queryInsertReserva);
    
                    if($resultado){
                        $cantidad = intval($cantidad);
                        $cantidad = $cantidad-1;
    
                        if($cantidad === -1){
                            header("Location: libros.php?mensaje=No hay libros disponibles&error=3");
                            exit;
                        }else{
                            $queryUpdate = "UPDATE libro SET cantidad = '${cantidad}' WHERE idlibros = $id_libro_solo";
                            $resultadoUpdate = mysqli_query($db, $queryUpdate);
    
                            if($resultadoUpdate){
                                header("Location: libros.php?mensaje=Reserva exitosa&exito=1");
                            }
                        }
                    }
                }else{
                    header("Location: libros.php?mensaje=No hay libros disponibles&error=3");
                    exit;
                }
    
                

                    // header("Location: libros.php");

                }
            }


        }else{
            header("Location: libros.php?mensaje=La fecha de reserva es obligatoria&error=1");
        }
    }
?>