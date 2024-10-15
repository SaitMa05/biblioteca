<?php 


    require '../includes/config/database.php';
    $db = conectarDB();
    session_start();
    include '../includes/selects/user.php';
    $resultados_por_pagina = 10;
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    // Calcular el offset
    $offset = ($pagina - 1) * $resultados_por_pagina;

    $queryLibros = "SELECT libro.*, autor.* , libros.*
    FROM libros
    JOIN libro ON libros.libros_idlibros = libro.idlibros
    JOIN autor ON libros.autor_idautor = autor.idautor
    ORDER BY libros.libros_idlibros DESC LIMIT $resultados_por_pagina OFFSET $offset;";
    $resultadoLibros = mysqli_query($db, $queryLibros);
    

    $auth = $_SESSION['login'];

    if($usuario['tipo_idtipo'] == 1 || $usuario['tipo_idtipo'] == 2 || !$auth){
        header("Location: /biblioteca/principal.php");
    }

    if(isset($_POST['id_libro'])) {
        // Obtener el ID del libro a eliminar
        $id_libro = $_POST['id_libro'];
        

        $queryGetLibros = "SELECT * FROM libros WHERE libroscol = $id_libro";
        $resultadoGetLibros = mysqli_query($db, $queryGetLibros);
        $librosR = mysqli_fetch_assoc($resultadoGetLibros);
        $libroId = $librosR['libros_idlibros'];

        $queryDesactivarFKChecks = "SET foreign_key_checks = 0";
        $resultadoDesactivarFKChecks = mysqli_query($db, $queryDesactivarFKChecks);


        if($resultadoDesactivarFKChecks){

            $queryDelete = "DELETE FROM reservas WHERE libros_libroscol = $id_libro";
            $resultadoDelete = mysqli_query($db, $queryDelete);

            $queryLibrosDelete = "DELETE FROM libros WHERE libroscol = $id_libro";
            $resultadoLibrosDelete = mysqli_query($db, $queryLibrosDelete);
            
            $queryDelete = "DELETE FROM libro WHERE idlibros = $libroId";
            $resultadoLibros = mysqli_query($db, $queryDelete);

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
        <h1 h1>Listado de Libros</h1>
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
                        $queryLibros = "SELECT libro.*, autor.* , libros.*
                        FROM libros
                        JOIN libro ON libros.libros_idlibros = libro.idlibros
                        JOIN autor ON libros.autor_idautor = autor.idautor WHERE titulo LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' OR publicadoYear LIKE '%$busqueda%'
                        ORDER BY libros.libros_idlibros DESC LIMIT $resultados_por_pagina OFFSET $offset;";
                        $resultadoLibros = mysqli_query($db, $queryLibros);
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
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Descripcion</th>
                            <th>Categoria</th>
                            <th>Fecha de Publicacion</th>
                            <th>Cantidad</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($libros = $resultadoLibros->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $libros['libroscol']; ?></td>
                            <td><img src="/biblioteca/admin/imagenesLibros/<?php echo $libros['portada']; ?>" alt=""></td>
                            <td><?php echo $libros['titulo']; ?></td>
                            <td><?php echo $libros['nombre']; ?></td>
                            <td><?php echo $libros['descripcion']; ?></td>
                            <td><?php echo $libros['categoria']; ?></td>
                            <td><?php echo $libros['publicadoYear']; ?></td>
                            <td><?php echo $libros['cantidad']; ?></td>
                            <td class="btnTable">
                                <form action="listadolibros.php" method="POST">
                                    <a href="editarlibro.php?id=<?php echo $libros['libroscol'] ?>">Editar</a>
                                    <input type="hidden" name="id_libro" value="<?php echo $libros['libroscol'] ?>">
                                    <input type="submit"  class="btnEliminar" value="Eliminar Libro">
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
