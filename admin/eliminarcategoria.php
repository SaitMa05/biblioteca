<?php 
    require '../includes/config/database.php';
    $db = conectarDB();
    session_start();
    include '../includes/selects/user.php';


    $auth = $_SESSION['login'];

    if($usuario['tipo_idtipo'] == 1 || $usuario['tipo_idtipo'] == 2 || !$auth){
        header("Location: /biblioteca/principal.php");
    }
    $queryCategoria = "SELECT * FROM categorias";
    $resultadoCategoria = mysqli_query($db, $queryCategoria);


    if(isset($_POST['id_categoria'])) {
    //    Obtener el ID del usuario a eliminar
        $id_categoria = $_POST['id_categoria'];

        

        
    //    Consulta SQL para eliminar el usuario
        $queryDelete = "DELETE FROM categorias WHERE idcategorias = $id_categoria ";
        $resultadoC = mysqli_query($db, $queryDelete);
    
    //    Ejecutar la consulta
        if ($db->query($queryDelete) === TRUE) {
            header("Location: ".$_SERVER['PHP_SELF']);
        } else {
            echo "Error al eliminar usuario: " . $db->error;
        }
    }


    include '../includes/templates/headerAdmin.php';
?>


    <main class="main listadoMain">
        <h1 h1>Listado de Categorias</h1>
        <div class="listadoPerfil">
            <table class="listado">
                <section class="table_header">
                </section>
                <section class="table_body">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categoria</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($categoria = $resultadoCategoria->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $categoria['idcategorias']; ?></td>
                            <td><?php echo $categoria['nombre']; ?></td>
                            <td class="btnTable">
                                <form action="eliminarcategoria.php" method="POST">
                                    <input type="hidden" name="id_categoria" value="<?php echo $categoria['idcategorias'] ?>">
                                    <input type="submit"  class="btnEliminar" value="Eliminar Categoria">
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        
                        
                    </tbody>
                </section>
            </table>

        </div>
        
    </main>

    <?php 
        include '../includes/templates/footer.php';
    ?>
