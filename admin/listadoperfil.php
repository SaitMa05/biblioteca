<?php 

    require '../includes/config/database.php';
    $db = conectarDB();
    session_start();
    include '../includes/selects/user.php';
    $resultados_por_pagina = 10;
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    if(isset($_GET['mensaje'])){
        $mensaje = $_GET['mensaje'];
    }
    // Calcular el offset
    $offset = ($pagina - 1) * $resultados_por_pagina;

    $queryUsuarios = "SELECT * FROM usuario ORDER BY idusuario DESC LIMIT $resultados_por_pagina OFFSET $offset";
    $resultadoUsuarios = mysqli_query($db, $queryUsuarios);
    

    $auth = $_SESSION['login'];

    if($usuario['tipo_idtipo'] == 1 || $usuario['tipo_idtipo'] == 2 || !$auth){
        header("Location: /biblioteca/principal.php");
    }

    if(isset($_POST['id_usuario'])) {
        // Obtener el ID del usuario a eliminar
        $id_usuario = $_POST['id_usuario'];

        $queryGetPerfil = "SELECT idperfil FROM perfill WHERE usuario_idusuario = $id_usuario";
        $resultadoGetPerfil = mysqli_query($db, $queryGetPerfil);
        $perfil = mysqli_fetch_assoc($resultadoGetPerfil);
        $idperfil = $perfil['idperfil'];

        $queryPerfil = "DELETE FROM perfill WHERE idperfil = $idperfil";
        $resultadoPerfil = mysqli_query($db, $queryPerfil);
    
        // Consulta SQL para eliminar el usuario
        $queryDelete = "DELETE FROM usuario WHERE idusuario = $id_usuario";
    
        // Ejecutar la consulta
        if ($db->query($queryDelete) === TRUE) {
            header("Location: ".$_SERVER['PHP_SELF']);
        } else {
            echo "Error al eliminar usuario: " . $db->error;
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
        <h1 h1>Listado de Usuarios</h1>
        <form class="buscadorAdmin" method="GET">
            <input type="search" placeholder="Es recomendable solo buscar un dato por ej solo el nombre y no nombre y apellido o solo con el D.N.I" name="busqueda">
            <input type="submit" value="Buscar" name="enivar">
        </form>
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
        <?php  
                    if(isset($_GET['enivar'])){
                        $busqueda = $_GET['busqueda'];
                        $busqueda = mysqli_real_escape_string($db, $busqueda);
                        if(strlen($busqueda)>255){
                            echo "Error. No se puede mas de 30 caracteres";
                        }
                        $queryUsuarios = "SELECT * FROM usuario WHERE nombre LIKE '%$busqueda' OR apellido LIKE '$busqueda' OR dni LIKE '%$busqueda' ORDER BY idusuario DESC";
                        $resultadoUsuarios = mysqli_query($db, $queryUsuarios);
                    }
                ?>
        <div class="listadoPerfil">
            <table class="listado">
                <section class="table_header">
                </section>
                <section class="table_body">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Rango</th>
                            <th>D.N.I</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($usuarios = $resultadoUsuarios->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $usuarios['idusuario']; ?></td>
                            <td><img src="/biblioteca/admin/imagenes/<?php echo $usuarios['imagen']; ?>" alt=""></td>
                            <td><?php echo $usuarios['nombre']; ?></td>
                            <td><?php echo $usuarios['apellido']; ?></td>
                            <td><?php echo $usuarios['email']; ?></td>
                            <td><?php echo $usuarios['telefono']; ?></td>
                            <td><?php if($usuarios['tipo_idtipo'] == 1){
                                            echo "Usuarios";
                                      }else if($usuarios['tipo_idtipo'] == 2){
                                            echo "Moderador";
                                      }else{
                                            echo "Administrador";
                                      }; 
                                ?></td>
                            <!-- <td><?php //if($usuarios['aceptado']== 1){ echo "Aprobado";}else{ echo "No Aprobado";}?></td> -->
                            <td><?php echo $usuarios['dni']; ?></td>
                            <td class="btnTable">
                                <form action="listadoperfil.php" method="POST">
                                    <a href="editarperfil.php?id=<?php echo $usuarios['idusuario'] ?>">Editar</a>
                                    <input type="hidden" name="id_usuario" value="<?php echo $usuarios['idusuario'] ?>">
                                    <a class="alerta warning" href="reservaAdmin.php?id=<?php echo $usuarios['idusuario'] ?>">Reservar un Libro o Notebook</a>
                                    <input type="submit"  class="btnEliminar" value="Eliminar Usuario">
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
