<?php 
    include './includes/templates/header.php';

    
    $idSesion = $_SESSION['id'];
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location: login.php");
    }

    $query = "SELECT reservas.*, libro.*, usuario.* FROM reservas INNER JOIN libro ON reservas.libros_libros_idlibros = libro.idlibros INNER JOIN usuario ON reservas.usuario_idusuario = usuario.idusuario AND reservas.usuario_tipo_idtipo = usuario.tipo_idtipo WHERE usuario_idusuario = $idSesion";
    $resultado = mysqli_query($db,$query);


    $queryNotebook = "SELECT reservasnotebooks.*, notebooks.*, usuario.* FROM reservasnotebooks INNER JOIN notebooks ON reservasnotebooks.notebooks_idnotebook = notebooks.idnotebook INNER JOIN usuario ON reservasnotebooks.usuario_idusuario = usuario.idusuario WHERE usuario_idusuario = $idSesion";
    $resultadoNotebook = mysqli_query($db,$queryNotebook);



    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['id_reserva'])){
            $id_reserva = $_POST['id_reserva'];
            
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
            } else {
                echo "Error al eliminar usuario: " . $db->error;
            }
        
        }
        if(isset($_POST['id_reservanotebook'])){
            $id_reserva = $_POST['id_reservanotebook'];
            
            $queryDelete = "DELETE FROM reservasnotebooks WHERE idreservasnotebooks = $id_reserva";
            $resultadoDelete = mysqli_query($db, $queryDelete);

            if ($db->query($queryDelete) === TRUE) {
                if(isset($_POST['id_notebook'])){
                    $idNotebook = $_POST['id_notebook'];
                    $queryNote = "SELECT * FROM notebooks WHERE idnotebook = $idNotebook";
                    $resultadoNote = mysqli_query($db, $queryNote);
                    $note = mysqli_fetch_assoc($resultadoNote);
                    
                    $disponible = $note["disponible"];

                    $update = "UPDATE notebooks SET disponible = 1 WHERE idnotebook = $idNotebook";
                    $resultadoUpdate = mysqli_query($db, $update);
    
                }
                header("Location: ".$_SERVER['PHP_SELF']);
            } else {
                echo "Error al eliminar usuario: " . $db->error;
            }
        
        }
    }

    



?>


    <main class="main">
        <section class="reservas">
            <div class="reservas-cont">
                <h2>Tus Reservas</h2>


                <?php if(!$resultado->num_rows > 0 && !$resultadoNotebook->num_rows > 0): ?>
                    <div class="alerta warning noReservas">
                        <p class="alerta">Aun no tienes ninguna reserva o ya a finalizado</p>
                        <a>Reserva Aqui:</a>
                        <a href="libros.php">Libros</a>
                        <a>o</a>
                        <a href="notebooks.php">Notebooks</a>
                    </div>
                <?php endif; ?>


                <div class="reservas-cajas">

                <?php while($reservaNote = mysqli_fetch_assoc($resultadoNotebook)): ?>
                    <div class="reservas-caja ">
                        <img src="/biblioteca/admin/imagenesNotebook/<?php echo $reservaNote['portada'] ?>" alt="portada de libro">
                        <p class="titulo-reservas fs-big">Numero de la Notebook: </p>
                        <p class="titulo-reservas"><?php echo $reservaNote['numero']; ?></p>
                        <p class="fecha-reservas"> <span>Inicio:</span> <?php echo $reservaNote['fecha_reserva'];?> </p>
                        <p class="fecha-reservas"> <span>Finaliza:</span> <?php echo $reservaNote['fecha_finalizacion']?> </p>
                        <div class="btnsReservas">
                            <form action="reservas.php" method="POST">
                                <input type="hidden" name="id_reservanotebook" value="<?php echo $reservaNote['idreservasNotebooks'] ?>">
                                <input type="hidden" name="id_notebook" value="<?php echo $reservaNote['idnotebook'] ?>">
                                <?php if($reservaNote['pasado'] == 0){ ?>
                                <input type="submit" class="btnReservar" value="Cancelar Reserva">
                                <?php }else{ ?>
                                    <p>La reserva ya a exedido el tiempo maximo</p>
                                <?php }?>
                            </form>
                        </div>
                    </div>
                    <?php endwhile; ?>

                    <?php while($reserva = mysqli_fetch_assoc($resultado)): ?>
                    <div class="reservas-caja ">
                        <img src="/biblioteca/admin/imageneslibros/<?php echo $reserva['portada'] ?>" alt="portada de libro">
                        <p class="titulo-reservas fs-big">Titulo: </p>
                        <p class="titulo-reservas"><?php echo $reserva['titulo']; ?></p>
                        <p class="fecha-reservas"> <span>Inicio:</span> <?php echo $reserva['fecha_reserva'];?> </p>
                        <p class="fecha-reservas"> <span>Finaliza:</span> <?php echo $reserva['fecha_finalizacion'];?> </p>
                        <div class="btnsReservas">
                            <form action="reservas.php" method="POST">
                                <input type="hidden" name="id_reserva" value="<?php echo $reserva['idreservas'] ?>">
                                <input type="hidden" name="id_libros" value="<?php echo $reserva['idlibros'] ?>">
                                <input type="submit" class="btnReservar" value="Cancelar Reserva">
                            </form>
                        </div>
                    </div>
                    <?php endwhile; ?>

                </div>
            </div>
        </section>
    </main>
    


    <?php 
        include './includes/templates/footer.php';
    ?>
