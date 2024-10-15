<?php 


    require '../includes/config/database.php';
    $db = conectarDB();
    session_start();
    include '../includes/selects/user.php';
    $resultados_por_pagina = 10;
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Calcular el offset
    $offset = ($pagina - 1) * $resultados_por_pagina;

    $queryNotebook = "SELECT * FROM notebooks LIMIT $resultados_por_pagina OFFSET $offset;";
    $resultadoNotebook = mysqli_query($db, $queryNotebook);
    

    $auth = $_SESSION['login'];

    if($usuario['tipo_idtipo'] == 1 || !$auth){
        header("Location: /biblioteca/principal.php");
    }

    if(isset($_POST['id_notebook'])) {
        // Obtener el ID del libro a eliminar
        $id_notebook = $_POST['id_notebook'];
        

        $queryDesactivarFKChecks = "SET foreign_key_checks = 0";
        $resultadoDesactivarFKChecks = mysqli_query($db, $queryDesactivarFKChecks);


        if($resultadoDesactivarFKChecks){

            $queryDelete = "DELETE FROM reservasnotebooks WHERE notebooks_idnotebook = $id_notebook";
            $resultadoDelete = mysqli_query($db, $queryDelete);

            $queryNotebooksDelete = "DELETE FROM notebooks WHERE idnotebook = $id_notebook";
            $resultadoNotebooksDelete = mysqli_query($db, $queryNotebooksDelete);
            

            $queryActivarFKChecks = "SET foreign_key_checks = 1";
            $resultadoActivarFKChecks = mysqli_query($db, $queryActivarFKChecks);

        }


    
        // Ejecutar la consulta
        if ($db->query($queryDelete) === TRUE) {
            header("Location: ".$_SERVER['PHP_SELF']);
        } else {
            echo "Error al eliminar el libro: " . $db->error;
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
        <h1 h1>Listado de Notebooks</h1>
        <form class="buscadorAdmin" method="GET">
            <input type="search" placeholder="Es recomendable solo buscar un dato por ej solo el nombre y no nombre y apellido o solo con el D.N.I" name="busqueda">
            <input type="submit" value="Buscar" name="enivar">
        </form>
            <?php  
                if(isset($_GET['enivar'])){
                    $busqueda = $_GET['busqueda'];
                    $busqueda = mysqli_real_escape_string($db, $busqueda);
                    if(strlen($busqueda)>255){
                        echo "Error. No se puede mas de 30 caracteres";
                    }
                    $queryNotebook = "SELECT * FROM notebooks WHERE numero LIKE '%$busqueda%'
                    ORDER BY idnotebook DESC LIMIT $resultados_por_pagina OFFSET $offset;";
                    $resultadoNotebook = mysqli_query($db, $queryNotebook);
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
                            <th>Numero de la Maquina</th>
                            <th>Disponible</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($notebook = $resultadoNotebook->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $notebook['idnotebook']; ?></td>
                            <td><img src="/biblioteca/admin/imagenesNotebook/<?php echo $notebook['portada']; ?>" alt=""></td>
                            <td><?php echo $notebook['numero']; ?></td>
                            <?php if($notebook['disponible'] == 1 ){ ?>
                                <td>Disponible</td>
                            <?php }else{ ?>
                                <td>No Disponible</td>
                            <?php } ?>
                            <td class="btnTable">
                                <form action="listadonotebook.php" method="POST">
                                    <a href="editarnotebook.php?id=<?php echo $notebook['idnotebook'] ?>">Editar</a>
                                    <input type="hidden" name="id_notebook" value="<?php echo $notebook['idnotebook'] ?>">
                                    <input type="submit"  class="btnEliminar" value="Eliminar Notebook">
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
