<?php
    require 'includes/config/database.php';
    $db = conectarDB();
    function reservaTiempo(){
        $queryLibroCantidad = "SELECT * FROM libro";
        $resultadoLibroCantidad = mysqli_query($db, $queryLibroCantidad);
        $libro = mysqli_fetch_assoc($resultadoLibroCantidad);
    
        $queryFecha = "SELECT * FROM reservas WHERE usuario_idusuario = $idSesion";
        $resultadoFechaReservado = mysqli_query($db, $queryFecha);
    
        $fechaActual = date('2024-06-07');
    
    
        while($reservaFecha = mysqli_fetch_assoc($resultadoFechaReservado)){
            $id_reserva = $reservaFecha['idreservas'];
            if($reservaFecha['fecha_reserva'] === $fechaActual){
                $queryDelete = "DELETE FROM reservas WHERE idreservas = $id_reserva";
                $resultadoDelete = mysqli_query($db, $queryDelete);
                if($resultadoDelete){
                    $cantidad = $libro["cantidad"];
                    $cantidad = intval($cantidad);
                    $cantidad = $cantidad+1;
                    $queryUpdate = "UPDATE libro SET cantidad = '${cantidad}' WHERE idlibros = $id_libro_solo";
                    $resultadoUpdate = mysqli_query($db, $queryUpdate);
                }
            }
        }
    }



?>