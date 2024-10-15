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


    $queryLibros = "SELECT libropdf.*, autor.*, librospdf.*
    FROM librospdf
    JOIN libropdf ON librospdf.libropdf_idlibrospdf = libropdf.idlibropdf
    JOIN autor ON librospdf.autor_idautor = autor.idautor WHERE idlibrospdf = $idlibro";
    $resultadoLibros = mysqli_query($db, $queryLibros);
    $libros = mysqli_fetch_assoc( $resultadoLibros );
    $idLibroSolo = $libros["idlibropdf"];


    $queryAutor = "SELECT * FROM autor";
    $resultadoAutor = mysqli_query($db, $queryAutor);
    
    
    
    $errores = [];

    $titulo = '';
    $descripcion = '';
    $isbn = '';
    $publicado = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']) ;
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $isbn = mysqli_real_escape_string($db, $_POST['isbn']);
        $publicado = mysqli_real_escape_string($db, $_POST['publicado']);

        // var_dump($categoria);

        $titulo = strip_tags($titulo);
        $descripcion = strip_tags($descripcion);
        $isbn = strip_tags($isbn);
        $publicado = strip_tags($publicado);
        

        $titulo = preg_replace('/[<>\?\/]/', '', $titulo);
        $descripcion = preg_replace('/[<>\?\/]/', '', $descripcion);
        $isbn = preg_replace('/[<>\?\/]/', '', $isbn);
        $publicado = preg_replace('/[<>\?\/]/', '', $publicado);


        if(!$titulo){
            $errores[] = 'El titulo es obligatorio';
        }

        if(!$descripcion){
            $errores[] = 'La descripcion es obligatorio';
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



        if(empty($errores)){


                // Insertar en la base de datos
                $query = "UPDATE libropdf SET titulo = '${titulo}', descripcion = '${descripcion}', isbn = '${isbn}', publicadoYear = '${publicado}' WHERE idlibropdf = $idLibroSolo";

                $resultado = mysqli_query($db, $query);



                $idAutor = $_POST['autor'];

                $queryDesactivarFKChecks = "SET foreign_key_checks = 0";
                $resultadoDesactivarFKChecks = mysqli_query($db, $queryDesactivarFKChecks);

                var_dump($idAutor);

                if($resultadoDesactivarFKChecks){
                    $queryLibros = "UPDATE librospdf SET autor_idautor = $idAutor WHERE idlibrospdf = $idlibro";
                    $resultadoLibros = mysqli_query($db, $queryLibros);

                    $queryActivarFKChecks = "SET foreign_key_checks = 1";
                    $resultadoActivarFKChecks = mysqli_query($db, $queryActivarFKChecks);

                }
                

                if($resultado){
                    $_SESSION['idAutor'] = "";
                    header("Location: /biblioteca/admin/listadopdf.php");
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
                <h2>Actualizar Libro PDF</h2>
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


                <label for="descripcion">Descripcion:</label>
                <input type="text" placeholder="Descripcion" name="descripcion" id="descripcion" value="<?php echo $libros['descripcion']; ?>" required>


                <div class="caja"> <!-- Caja inicio-->
                <label for="autor">Autor:</label>
                    <select class="categoriaSelect" name="autor" id="autor">
                        <option value="<?php echo $libros['idautor']; ?>"selected><?php echo $libros['nombre']; ?></option>
                        <?php while($autor = $resultadoAutor->fetch_assoc()):?>
                        <option value="<?php echo $autor['idautor'] ?>"><?php echo $autor['nombre'];?></option>
                        <?php endwhile; ?>
                    </select>
                    <a class="btnAutor" href="agregarautor.php">Agregar Autor</a>
                    </div> <!-- Caja fin-->
                <label for="isbn">Codigo ISBN:</label>
                <input type="text" placeholder="Codigo ISBN" name="isbn" id="isbn" value="<?php echo $libros['isbn']; ?>" required>


                <label for="publicado">Publicado: </label>
                <input class="dateReserva" name="publicado" value="<?php echo $libros['publicadoYear']; ?>" type="date">


                <input class="btnLogin" type="submit" value="Actualizar PDF">
                </form>
                <a class="cuenta" href="/biblioteca/admin/index.php">Volver</a>
        </div>
    </section>

    </main>


    <script src="src/js/alerta.js"></script>

</body>
</html>