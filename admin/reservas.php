<?php 

    require '../includes/config/database.php';
    $db = conectarDB();
    session_start();
    include '../includes/selects/user.php';
    $resultados_por_pagina = 10;
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Calcular el offset
    $offset = ($pagina - 1) * $resultados_por_pagina;


    $auth = $_SESSION['login'];

    if($usuario['tipo_idtipo'] == 1 || $usuario['tipo_idtipo'] == 2 || !$auth){
        header("Location: /biblioteca/principal.php");
    }

    


    $queryReserva = "SELECT reservas.*, libro.*, usuario.* FROM reservas INNER JOIN libro ON reservas.libros_libros_idlibros = libro.idlibros INNER JOIN usuario ON reservas.usuario_idusuario = usuario.idusuario AND reservas.usuario_tipo_idtipo = usuario.tipo_idtipo LIMIT $resultados_por_pagina OFFSET $offset";
    $resultadoReserva = mysqli_query($db,$queryReserva);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['id_reserva'])){
            $id_reserva = $_POST['id_reserva'];




            if(isset($_POST['retirar'])){
                $queryRetirado = "UPDATE reservas SET retirado = 1 WHERE idreservas = $id_reserva";
                $resultadoRetirado = mysqli_query($db, $queryRetirado);
                
                header("Location: /biblioteca/admin/reservas.php");
                exit;
            }else{
                $queryDelete = "DELETE FROM reservas WHERE idreservas = $id_reserva";
                $resultadoDelete = mysqli_query($db, $queryDelete);

                if ($db->query($queryDelete) === TRUE) {
                    if(isset($_POST['id_libros'])){
                        $idLibro = $_POST['id_libros'];
                        $queryLibro = "SELECT * FROM libro WHERE idlibros = $idLibro";
                        $resultadoLibro = mysqli_query($db, $queryLibro);
                        $libro = mysqli_fetch_assoc($resultadoLibro);
                        
                        $cantidad = $libro["cantidad"];
                        $cantidad = intval($cantidad);
                        $cantidad = $cantidad+1;
                        $queryUpdate = "UPDATE libro SET cantidad = '${cantidad}' WHERE idlibros = $idLibro";
                        $resultadoUpdate = mysqli_query($db, $queryUpdate);
        
                    }
                    header("Location: ".$_SERVER['PHP_SELF']);
                }
            }

        
        }
    }

    // Calcular el número total de resultados
    $sql_total = "SELECT COUNT(*) AS total FROM usuario";
    $resultado_total = $db->query($sql_total);
    $row_total = $resultado_total->fetch_assoc();
    $total_resultados = $row_total['total'];

    // Calcular el número total de páginas
    $total_paginas = ceil($total_resultados / $resultados_por_pagina);

    include '../includes/templates/headerAdmin.php';
?>


    <main class="main listadoMain">
        <h1 h1>Listado de Reservas de Libros</h1>
        <form class="buscadorAdmin" method="GET">
            <input type="search" placeholder="Es recomendable solo buscar un dato por ej solo el nombre y no nombre y apellido o solo con el D.N.I" name="busqueda">
            <input type="submit" value="Buscar" name="enivar">
        </form>
        <!-- <?php  
                if(isset($_GET['enivar'])){
                    $busqueda = $_GET['busqueda'];
                    $busqueda = mysqli_real_escape_string($db, $busqueda);
                    if(strlen($busqueda)>255){
                        echo "Error. No se puede mas de 30 caracteres";
                    }
                    $queryReserva = "SELECT reservas.*, libro.*, usuario.* FROM reservas INNER JOIN libro ON reservas.libros_libros_idlibros = libro.idlibros INNER JOIN usuario ON reservas.usuario_idusuario = usuario.idusuario AND reservas.usuario_tipo_idtipo = usuario.tipo_idtipo  WHERE nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%' OR titulo LIKE '%$busqueda%' OR dni LIKE '%$busqueda%' OR fecha_reserva LIKE '%$busqueda%' OR fecha_finalizacion LIKE '%$busqueda%'";
                    $resultadoReserva = mysqli_query($db,$queryReserva);
                }
                ?> -->
        <div class="listadoPerfil">

            <table class="listado">
                <section class="table_header">
                </section>
                <section class="table_body">
                    <thead>
                        <tr>
                            <th>ID de la Reserva</th>
                            <th>Portada</th>
                            <th>Usuario</th>
                            <th>Libro</th>
                            <th>Fecha de Reserva</th>
                            <th>Fecha de Finalizacion</th>
                            <th>Retirado</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($reserva = $resultadoReserva->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $reserva['idreservas']; ?></td>
                            <td><img src="/biblioteca/admin/imagenesLibros/<?php echo $reserva['portada']; ?>" alt=""></td>
                            <td><?php echo $reserva['nombre']; echo " "; echo $reserva['apellido']; ?></td>
                            <td><?php echo $reserva['titulo']; ?></td>
                            <td><?php echo $reserva['fecha_reserva']; ?></td>
                            <td><?php echo $reserva['fecha_finalizacion']; ?></td>
                            <td><?php if($reserva['retirado'] == 0){
                                            echo "Aun no esta retirado";
                                      }else if($reserva['retirado'] == 1){
                                            echo "Retirado";
                                      }
                                ?></td>

                            
                            <!-- <td><?php //if($usuarios['aceptado']== 1){ echo "Aprobado";}else{ echo "No Aprobado";}?></td> -->
                            <td class="btnTable">
                                <form class="formReservas" action="reservas.php" method="POST">
                                    <input class="alerta warning p-1" name="retirar" type="submit" value="Marcar como Retirado">
                                    <input type="hidden" name="id_reserva" value="<?php echo $reserva['idreservas'] ?>">
                                    <input type="hidden" name="id_libros" value="<?php echo $reserva['idlibros'] ?>">
                                    <input class="alerta exito p-1" type="submit" class="btnEliminar" value="Marcar como Entregado">
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        
                        
                    </tbody>
                </section>
            </table>

        </div>
        
    </main>
    <div class="paginas">
        <?php
        for ($i = 1; $i <= $total_paginas; $i++) {
            echo "<a href=\"?pagina=$i\">$i</a> ";
        }
        ?>
        <!-- <a href="?pagina=1">1</a>
        <a href="?pagina=2">2</a>
        <a href="?pagina=3">3</a> -->
    </div>
    

    <?php 
        include '../includes/templates/footer.php';
    ?>
