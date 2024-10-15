<?php 
    include './includes/templates/header.php';
    // var_dump($_GET);
    if(isset($_GET['mensaje'])){
        $mensaje = $_GET['mensaje'];
    }
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location: login.php");
    }

    $errores = [];
    $exitos = [];

    $query = "SELECT * FROM notebooks ORDER BY idnotebook DESC";
    $resultado = mysqli_query($db,$query);

    $queryFecha = "SELECT reservasnotebooks.*, notebooks.*, usuario.* FROM reservasnotebooks INNER JOIN notebooks ON reservasnotebooks.notebooks_idnotebook = notebooks.idnotebook INNER JOIN usuario ON reservasnotebooks.usuario_idusuario = usuario.idusuario WHERE usuario_idusuario = $idSesion";
    $resultadoFecha = mysqli_query($db,$queryFecha);
    $datos = mysqli_fetch_assoc($resultadoFecha);
    if($datos){
        $fechaActualDB = $datos["fecha_reserva"];
        $fechaFinalizacionDB = $datos["fecha_finalizacion"];
        $idNotebook = $datos["idnotebook"];
        $pasado = $datos["pasado"];
        
        
        if($fechaActualDB == $fechaFinalizacionDB){
            $queryUpdateReserva = "UPDATE notebooks SET pasado = 1 WHERE idnotebook = $idNotebook";
            $resultadoUpdate = mysqli_query($db,$queryUpdateReserva);
            
            
            if($resultadoUpdate){
                $queryDelete = "DELETE FROM reservasnotebooks WHERE usuario_idusuario = $idSesion";
                $resultadoDelete = mysqli_query($db,$queryDelete);
                if($resultadoDelete){
                    $queryUpdateReserve = "UPDATE notebooks SET pasado = 0, disponible = 1 WHERE idnotebook = $idNotebook";
                    $resultadoUpdate = mysqli_query($db,$queryUpdateReserve);
                }
            }
            
        }
    }
   


    
?>

    <main class="main">
        <div class="inicioVentana-Notebook">
        

            <section class="libros">
                <div class="libros-cont">

                <h2>Notebooks</h2>

                <form class="buscadorAdmin mb-2" method="GET">
                    <input type="search" placeholder="Buscar por numero de NoteBook" name="busqueda">
                    <input type="submit" value="Buscar" name="enivar">
                </form>

                <?php  
                    if(isset($_GET['enivar'])){
                        $busqueda = $_GET['busqueda'];
                        $busqueda = mysqli_real_escape_string($db, $busqueda);

                            $query = "SELECT * FROM notebooks WHERE numero LIKE '%$busqueda%' ORDER BY idnotebook DESC";
          
                            $resultado = mysqli_query($db, $query);
                    }
                ?>

                <?php if(isset($mensaje)){
                    $errores[] = $mensaje;
                    $exitos[] = $mensaje;
                } ?>

                <?php if(isset($_GET['error'])){ 
                    foreach($errores as $error) : ?>
                        <div class="alerta error">
                            <?php echo $error; ?>
                        </div>
                    <?php endforeach ?>
                <?php }?>

                <?php if(isset($_GET['exito'])){
                    foreach($exitos as $exito) : ?>
                        <div class="alerta exito">
                            <?php echo $exito; ?>
                        </div>
                    <?php endforeach ?>
                 <?php } ?>

                    <h3>Las notebooks solo se reserva durante el dia y por cuatro horas</h3>

                    <div class="cajas-libros">
                    

                        <?php while($notebook = mysqli_fetch_assoc($resultado)): ?>
                        <div class="caja-libros"> <!--Inicio Caja-->
                            <img src="/biblioteca/admin/imagenesNotebook/<?php echo $notebook['portada'] ?>" alt="portada de libro">
                            <p class="titulo">Notebook <?php echo $notebook['numero']; ?></p>
                            <form class="formReserva" action="register_notebooks.php" method="POST">
                            <input type="hidden" name="idnotebook" value="<?php echo $notebook['idnotebook'] ?>">
                            <button  class="btnReservar" type="submit">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path></svg> Reservar
                                </span>
                            </button>
                            </form>
                            <div class="cantidad">
                            <label for="">Estado:</label>
                            <input class="cantidadDisponible" type="text" id="cantidadLibros" name="cantidadDisponible" value="<?php if($notebook['disponible'] == 1){echo "Disponible";}else{echo "No Disponible";} ?>" readonly>
                            </div>
                        </div>   <!--Fin Caja-->
                        <?php endwhile; ?>
                        

                    </div>
                </div>

            </section>
        </div>
    </main>

    


    <!-- <?php 
        // include './includes/templates/footer.php';
    ?> -->
