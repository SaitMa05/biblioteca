<?php
    $idlibro = $_GET['id'];
    require '../includes/config/database.php';
    $db = conectarDB();
    
    // var_dump($db)
    session_start();

    include '../includes/selects/user.php';


    $auth = $_SESSION['login'];

    if($usuario['tipo_idtipo'] == 1 || !$auth){
        header("Location: /biblioteca/principal.php");
    }

    $queryLibros = "SELECT libro.*, autor.* , libros.*
    FROM libros
    JOIN libro ON libros.libros_idlibros = libro.idlibros
    JOIN autor ON libros.autor_idautor = autor.idautor WHERE libroscol = $idlibro";
    $resultadoLibros = mysqli_query($db, $queryLibros);
    $libros = mysqli_fetch_assoc( $resultadoLibros );
    $idLibroSolo = $libros["idlibros"];
    $isbnLibro = $libros["isbn"];



    $queryAutor = "SELECT * FROM autor";
    $resultadoAutor = mysqli_query($db, $queryAutor);
    

    $queryCategoria = "SELECT * FROM categorias";
    $resultadoCategoria = mysqli_query($db, $queryCategoria);
    
    
    $errores = [];

    $titulo = '';
    // $portada = '';
    $descripcion = '';
    $categoria = '';
    $isbn = '';
    $publicado = '';
    $cantidad = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']) ;
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $categoria = mysqli_real_escape_string($db, $_POST['categoria']);
        $isbn = mysqli_real_escape_string($db, $_POST['isbn']);
        $publicado = mysqli_real_escape_string($db, $_POST['publicado']);
        $cantidad = mysqli_real_escape_string($db, $_POST['cantidadDisponible']);

        $portada = $_FILES['portada'];

        // var_dump($categoria);

        $titulo = strip_tags($titulo);
        $descripcion = strip_tags($descripcion);
        $categoria = strip_tags($categoria);
        $isbn = strip_tags($isbn);
        $publicado = strip_tags($publicado);
        $cantidad = strip_tags($cantidad);

        $titulo = preg_replace('/[<>\?\/]/', '', $titulo);
        $descripcion = preg_replace('/[<>\?\/]/', '', $descripcion);
        $categoria = preg_replace('/[<>\?\/]/', '', $categoria);
        $isbn = preg_replace('/[<>\?\/]/', '', $isbn);
        $publicado = preg_replace('/[<>\?\/]/', '', $publicado);
        $cantidad = preg_replace('/[<>\?\/]/', '', $cantidad);


        if ($isbn !== null && $isbn != $isbnLibro) {
            // Consulta preparada para seleccionar el email de la base de datos
            $querySelect = "SELECT isbn FROM `biblioteca_esc`.`libro` WHERE isbn = ?";
            $stmt = $db->prepare($querySelect);
            $stmt->bind_param("s", $isbn);
            $stmt->execute();
            $stmt->store_result();

            // Verificar si se obtuvo un resultado
            if ($stmt->num_rows > 0) {
                $errores[] = 'Este codigo isbn ya está registrado';
            }
            $stmt->close();
        }


        if(!$titulo){
            $errores[] = 'El titulo es obligatorio';
        }

        if(!$descripcion){
            $errores[] = 'La descripcion es obligatorio';
        }

        if(!$categoria){
            $errores[] = 'La categoria es obligatorio';
        }

        if(!$isbn){
            $errores[] = 'El codigo isbn es obligatorio';
        }
        if(strlen($isbn) > 30){
            $errores[] = 'El codigo isbn no puede ser mayor de 30 caracteres';
        }

        if(!$publicado){
            $errores[] = 'El año publicado es obligatorio';
        }

        if(!$cantidad){
            $errores[] = 'La cantidad disponible de ese libro es obligatorio';
        }



        $medida = 1000 * 6144; // 6MB

         if($portada['size'] > $medida){
             $errores[] = 'la imagen es muy pesada';
        }


        if(empty($errores)){

            if(isset($portada) && $_FILES['portada']['error'] === UPLOAD_ERR_OK){
                $imagenActualizada = $_FILES['portada'];
                $carpetaImg = '../admin/imageneslibros/';
                if(!is_dir($carpetaImg)){
                    mkdir($carpetaImg);
                }
                $libroPortada = $libros['portada'];

                if($imagenActualizada['name']){
                    // Eliminar la imagen previa
                    unlink($carpetaImg . $libroPortada);
                    header("Location: ".$_SERVER['PHP_SELF']);
                }
                
                $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
    
                // Mover el archivo solo si se cargó correctamente
                move_uploaded_file($imagenActualizada['tmp_name'], $carpetaImg . $nombreImg);
    
                $queryPortada = "UPDATE libro SET portada = '{$nombreImg}' WHERE idlibros = $idLibroSolo";
                $resultadoPortada = mysqli_query($db, $queryPortada);
            }else{
                $errores[] = "No hay ninguna foto selecionada";
            }

                // Insertar en la base de datos
                $query = "UPDATE libro SET titulo = '${titulo}', descripcion = '${descripcion}', categoria = '${categoria}', isbn = '${isbn}', publicadoYear = '${publicado}', cantidad = '${cantidad}' WHERE idlibros = ${idLibroSolo}";

                $resultado = mysqli_query($db, $query);



                $idAutor = $_POST['autor'];

                $queryDesactivarFKChecks = "SET foreign_key_checks = 0";
                $resultadoDesactivarFKChecks = mysqli_query($db, $queryDesactivarFKChecks);

                var_dump($idAutor);

                if($resultadoDesactivarFKChecks){
                    $queryLibros = "UPDATE libros SET autor_idautor = $idAutor WHERE libroscol = $idlibro";
                    $resultadoLibros = mysqli_query($db, $queryLibros);

                    $queryReservas = "UPDATE reservas SET libros_autor_idautor = $idAutor WHERE libros_libroscol = $idlibro";
                    $resultadoReservas = mysqli_query($db, $queryReservas);

                    $queryActivarFKChecks = "SET foreign_key_checks = 1";
                    $resultadoActivarFKChecks = mysqli_query($db, $queryActivarFKChecks);

                }
                






                

                if($resultado){
                    $_SESSION['idAutor'] = "";
                    header("Location: /biblioteca/admin/listadolibros.php");
                }

        }
    }







?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="icon" href="../build/img/logo.png" type="png">
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>

    <main class="main">
    <section class="registro contenedorIndex">
        <div class="registro-cont">
            <div class="logoLogin">
                <span>.</span>
                <h2>Actualizar Libro</h2>
                <span>.</span>
            </div>


            <?php if ($errores !== null) : ?>
                <?php foreach($errores as $error) : ?>
                    <div class="alerta error">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach ?>
            <?php endif ?>

            <form class="formularioLogin" method="POST" enctype="multipart/form-data">

                <div class="caja"> <!-- Caja inicio-->
                    <label for="titulo">Titulo:</label>
                    <input type="text" placeholder="Titulo" name="titulo" id="titulo" value="<?php echo $libros['titulo']; ?>" required>
            
                    <label for="portada">Portada:</label>
                    <input class="archivo" type="file" id="portada" name="portada" accept="image/jpg, image/png">
                    </div> <!-- Caja fin-->
                    <img style="width: 26rem;" src="../admin/imagenesLibros/<?php echo $libros['portada']; ?>" alt="">

                <label for="descripcion">descripcion:</label>
                <input type="text" placeholder="Descripcion" name="descripcion" id="descripcion" value="<?php echo $libros['descripcion']; ?>" required>

                <div class="caja"> <!-- Caja inicio-->
                    <label for="categoria">Categoria:</label>
                    
                    <select class="categoriaSelect" name="categoria" id="categoria" required>
                        <option value="<?php echo $libros['categoria'] ?>" selected><?php echo $libros['categoria'] ?></option>
                        <?php while($categoriaResult = mysqli_fetch_assoc($resultadoCategoria)):?>
                            <option value="<?php echo $categoriaResult['nombre'] ?>"><?php echo $categoriaResult['nombre'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div> <!-- Caja fin-->

                <div class="caja"> <!-- Caja inicio-->
                <label for="autor">Autor:</label>
                    <select class="categoriaSelect" name="autor" id="autor" required>
                    <option value="<?php echo $libros['idautor'] ?>" selected><?php echo $libros['nombre'] ?><option>
                        <?php while($autor = $resultadoAutor->fetch_assoc()):?>
                        <option value="<?php echo $autor['idautor'] ?>"><?php echo $autor['nombre'];?></option>
                        <?php endwhile; ?>
                    </select>
                    <a class="btnAutor" href="agregarautor.php">Agregar Autor</a>
                    </div> <!-- Caja fin-->
                <label for="isbn">Codigo ISBN:</label>
                <input type="text" placeholder="Codigo ISBN" name="isbn" id="isbn" value="<?php echo $libros['isbn'] ?>" required>
                

                <label for="publicado">Publicado: </label>
                <input class="dateReserva" name="publicado" type="date" value="<?php echo $libros['publicadoYear'] ?>">

                <div class="cantidad">
                    <label for="">Cantidad:</label>
                    <input class="cantidadDisponible" type="number" id="cantidadLibros" name="cantidadDisponible" min="1" value="<?php echo $libros['cantidad'] ?>">
                </div>

                <input class="btnLogin" type="submit" value="Actualizar Libro">
            </form>
            <a class="cuenta" href="/biblioteca/admin/index.php">Volver</a>
        </div>
    </section>

    </main>


    <script src="src/js/alerta.js"></script>

</body>
</html>