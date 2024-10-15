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
    
    $query_categorias = "SELECT DISTINCT nombre FROM categorias";
    $resultado_categorias = mysqli_query($db, $query_categorias);

    $query_categorias2 = "SELECT DISTINCT nombre FROM categorias";
    $resultado_categorias2 = mysqli_query($db, $query_categorias2);

    $resultados_por_pagina = 8;
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $offset = ($pagina - 1) * $resultados_por_pagina;


    $categoria_seleccionada = $_GET['categoria'] ?? '';

    $query_contar_libros = "SELECT COUNT(*) AS total_libros FROM libro WHERE categoria = '$categoria_seleccionada'";
    $resultado_contar_libros = mysqli_query($db, $query_contar_libros);
    $fila_contar_libros = mysqli_fetch_assoc($resultado_contar_libros);
    $total_libros = $fila_contar_libros['total_libros'];


    $query = "SELECT libro.*, autor.*, libros.*
    FROM libros
    JOIN libro ON libros.libros_idlibros = libro.idlibros
    JOIN autor ON libros.autor_idautor = autor.idautor";

    if (!empty($categoria_seleccionada)) {
        $categoria_seleccionada = mysqli_real_escape_string($db, $categoria_seleccionada); // Escapar la categoría
        $query .= " WHERE libro.categoria = '$categoria_seleccionada'";
    }
    $query .= " ORDER BY libros.libros_idlibros DESC LIMIT $resultados_por_pagina OFFSET $offset;";
    $resultado = mysqli_query($db, $query);


    $queryPDF = "SELECT libropdf.*, autor.*, librospdf.*
    FROM librospdf
    JOIN libropdf ON librospdf.libropdf_idlibrospdf = libropdf.idlibropdf
    JOIN autor ON librospdf.autor_idautor = autor.idautor";
    if (!empty($categoria_seleccionada)) {
        $categoria_seleccionada = mysqli_real_escape_string($db, $categoria_seleccionada); // Escapar la categoría
        $queryPDF .= " WHERE libropdf.categoria = '$categoria_seleccionada'";
    }
    $queryPDF .= " ORDER BY librospdf.libropdf_idlibrospdf DESC LIMIT $resultados_por_pagina OFFSET $offset;";
    $resultadoPDF = mysqli_query($db, $queryPDF);


    $sql_total = "SELECT COUNT(*) AS total FROM libros";
    $resultado_total = $db->query($sql_total);
    $row_total = $resultado_total->fetch_assoc();
    $total_resultados = $row_total['total'];

    // Calcular el número total de páginas
    $total_paginas = ceil($total_resultados / $resultados_por_pagina);



    $queryFecha = "SELECT * FROM reservas WHERE usuario_idusuario = $idSesion";
    $resultadoFechaReservado = mysqli_query($db, $queryFecha);

    $fechaActual = date('Y-m-d');

    while($reservaFecha = mysqli_fetch_assoc($resultadoFechaReservado)){
        $id_reserva = $reservaFecha['idreservas'];
        $id_libro_solo = $reservaFecha['libros_libros_idlibros'];
        $queryLibrito = "SELECT * FROM libro WHERE idlibros = $id_libro_solo";
        $resultadoLibrito = mysqli_query($db, $queryLibrito);
        $librito = mysqli_fetch_assoc($resultadoLibrito);
        
        if($reservaFecha['fecha_finalizacion'] === $fechaActual){
            $queryDelete = "DELETE FROM reservas WHERE idreservas = $id_reserva";
            $resultadoDelete = mysqli_query($db, $queryDelete);
            if($resultadoDelete){
                echo "Funciono";
                $cantidad = $librito["cantidad"];
                var_dump($cantidad);
                $cantidad = intval($cantidad);
                $cantidad = $cantidad+1;
                $queryUpdate = "UPDATE libro SET cantidad = '${cantidad}' WHERE idlibros = $id_libro_solo";
                $resultadoUpdate = mysqli_query($db, $queryUpdate);
                header("Location: ".$_SERVER['PHP_SELF']);
            }
        }
    }



?>

    <main class="main">
        <div class="inicioVentana">
            <section class="categoria">
                <div class="fechaActual">
                    <p>Fecha:</p>
                    <p>
                        <?php
                        $fechaHTML = date('d-m-Y');
                        echo $fechaHTML;
                    ?></p>  
                </div>

                <div class="categoria-cont">
                    <h2>Categorias</h2>
                    <div class="btn-conteiner">
                        <button href="" class="btn-content btnCategoria">
                          <span class="icon-arrow">
                            <svg xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 66 43" height="60px" width="60px">
                                <g fill-rule="evenodd" fill="none" stroke-width="1" stroke="none" id="arrow">
                                <path
                                  fill="#333"
                                  d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                                  id="arrow-icon-one"
                                ></path>
                                <path
                                  fill="#444950"
                                  d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                                  id="arrow-icon-two"
                                ></path>
                                <path
                                  fill="#e1e1e1"
                                  d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                                  id="arrow-icon-three"
                                ></path>
                              </g>
                            </svg>
                          </span>
                        </button>
                      </div>            
                    <div id="ocultar" class="d-n">
                        <div class="cajas-categoria">

                        <div class="caja-categoria">
                            <a href="libros.php?categoria=">Todo</a>
                        </div>
                        <!-- <div class="caja-categoria">
                            <a href="libros.php?categoria=Descargas">Descargas</a>
                        </div> -->
                        <?php while($categoriaR = mysqli_fetch_assoc($resultado_categorias)): ?>
                            <div class="caja-categoria"> 
                                <?php echo '<a href="libros.php?categoria=' . urlencode($categoriaR['nombre']) . '">' . htmlspecialchars($categoriaR['nombre']) . '</a>'; ?>

                            </div>
                        <?php endwhile; ?>
                        
                </div>
            </section>

            <section class="libros">
                <div class="libros-cont">



                        
                <?php if(!isset($_GET['categoria'])){ ?>
                <form class="buscadorAdmin mb-2" method="GET">
                    <input type="search" placeholder="Busca por Titulo o Autor del libro. Tambien por fecha publicado 2024/06/06" name="busqueda">
                    <input type="submit" value="Buscar" name="enivar">
                </form>
                <?php } ?>
                
                <?php if( isset($_GET['categoria']) && $_GET['categoria'] != 'Descargas'){ ?>
                <form class="buscadorAdmin mb-2" method="GET">
                    <input type="search" placeholder="Busca por Titulo o Autor del libro. Tambien por fecha publicado 2024/06/06" name="busqueda">
                    <input type="submit" value="Buscar" name="enivar">
                </form>
                <?php } ?>



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

                            $query = "SELECT libro.*, autor.*, libros.*
                            FROM libros
                            JOIN libro ON libros.libros_idlibros = libro.idlibros
                            JOIN autor ON libros.autor_idautor = autor.idautor
                            WHERE libro.titulo LIKE '%$busqueda%' OR autor.nombre LIKE '%$busqueda%' OR libro.publicadoYear LIKE '%$busqueda%' OR libro.categoria LIKE '%$busqueda%' ORDER BY libros.libros_idlibros DESC LIMIT $resultados_por_pagina OFFSET $offset;";
          
                            $resultado = mysqli_query($db, $query);
                    }
                ?>
                <?php if(isset($_GET['categoria'])){ ?>
                <?php if($_GET["categoria"] == 'Descargas'){ ?>
                <form class="buscadorAdmin mb-2" method="GET">
                    <input type="search" placeholder="Buscar Descargas" name="busquedaPDF">
                    <input type="submit" value="Buscar PDF" name="enivarPDF">
                </form>
                <?php } ?>
                <?php } ?>


                <?php  
                    if(isset($_GET['enivarPDF'])){
                        $busquedaPDF = $_GET['busquedaPDF'];
                        $busquedaPDF = mysqli_real_escape_string($db, $busquedaPDF);

                            $queryPDF = "SELECT libropdf.*, autor.*, librospdf.*
                            FROM librospdf
                            JOIN libropdf ON librospdf.libropdf_idlibrospdf = libropdf.idlibropdf
                            JOIN autor ON librospdf.autor_idautor = autor.idautor
                            WHERE libropdf.titulo LIKE '%$busquedaPDF%' OR autor.nombre LIKE '%$busquedaPDF%' OR libropdf.publicadoYear LIKE '%$busquedaPDF%' OR libropdf.categoria LIKE '%$busquedaPDF%' ORDER BY librospdf.libropdf_idlibrospdf DESC LIMIT $resultados_por_pagina OFFSET $offset;";
          
                            $resultadoPDF = mysqli_query($db, $queryPDF);
                    }
                ?>

                    <div class="cajas-libros">
                
                        <?php if(isset($_GET['busquedaPDF'])){ ?>
                            <?php while($librospdf  = mysqli_fetch_assoc($resultadoPDF)): ?>
                                <div class="caja-libros">
                                    <img src="/biblioteca/admin/imageneslibros/4f2da55822a282e8c9c4acc3870b9b40.jpg" alt="">
                                    <p class="titulo"><?php echo $librospdf['titulo'] ?></p>
                                    <p class="autor">Autor: <a href="<?php echo $librospdf['biografia'] ?>"><?php echo $librospdf['nombre'];?></a></p>
                                    <a class="btnReservar" download="<?php echo $librospdf['titulo'] ?>" href="/biblioteca/admin/archivos/<?php echo $librospdf['archivo']?>">Descargar Libro</a>
                                </div>
                            <?php endwhile; ?>
                        <?php }else{ ?>
                                <?php if(isset($_GET['categoria'])){ ?>
                            <?php if($_GET['categoria'] == 'Descargas' || isset($_GET['busquedaPDF'])) { ?>                        
                                <?php while($librospdf  = mysqli_fetch_assoc($resultadoPDF)): ?>
                                <div class="caja-libros">
                                    <img src="/biblioteca/admin/imageneslibros/4f2da55822a282e8c9c4acc3870b9b40.jpg" alt="">
                                    <p class="titulo"><?php echo $librospdf['titulo'] ?></p>
                                    <p class="autor">Autor: <a href="<?php echo $librospdf['biografia'] ?>"><?php echo $librospdf['nombre'];?></a></p>
                                    <a class="btnReservar" download="<?php echo $librospdf['titulo'] ?>" href="/biblioteca/admin/archivos/<?php echo $librospdf['archivo']?>">Descargar Libro</a>
                                </div>
                            <?php endwhile; ?>
                        <?php } ?>
                        <?php } ?>
                            <?php } ?>

                        
                            


       

                    


                    <!-- <?php //if($_GET['libros.php']){

                        // echo "Hola";
                     ?> -->
                    <?php while($libro = mysqli_fetch_assoc($resultado) ): ?>
                        <div class="caja-libros"> <!--Inicio Caja-->
                            <img src="/biblioteca/admin/imageneslibros/<?php echo $libro['portada'] ?>" alt="portada de libro">
                            <p class="titulo"><?php echo $libro['titulo'] ?></p>
                            <p class="autor">Autor: <a target="_bank" href="<?php echo $libro['biografia'] ?>"> <?php echo $libro['nombre'];?></a></p>
                            <form class="formReserva" action="register_reservas.php" method="POST">
                            <input type="hidden" name="idLibro" value="<?php echo $libro['libroscol']; ?>">
                            <input class="dateReserva" type="date" name="dateReserva">
                            <button  class="btnReservar" type="submit">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path></svg> Reservar
                                </span>
                            </button>
                            </form>
                            <div class="cantidad">
                            <label for="">Cantidad:</label>
                            <input class="cantidadDisponible" type="number" id="cantidadLibros" name="cantidadDisponible" min="1" value="<?php echo $libro['cantidad'] ?>" readonly>
                            </div>
                        </div>   <!--Fin Caja-->
                        <?php endwhile; ?>

                        <?php 
                            if($total_libros == 0){
                                $errores[] = "No hay resultados";
                            }
                        ?>
                    </div>
                </div>

            </section>
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
        include './includes/templates/footer.php';
    ?>
