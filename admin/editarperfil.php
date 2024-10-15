<?php
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
session_start();
if(!$id){
    header('Location: /biblioteca/admin/index.php');
    exit; // Agregar exit después de redirigir para evitar que se ejecute más código innecesario
}

require '../includes/config/database.php';
$db = conectarDB();
include '../includes/selects/user.php';

$auth = $_SESSION['login'];

if($usuario['tipo_idtipo'] == 1 || !$auth){
    header("Location: /biblioteca/principal.php");
}

$queryid = "SELECT * FROM usuario WHERE idusuario = ${id}";
$resultadoid = mysqli_query($db, $queryid);
$usuario = mysqli_fetch_assoc($resultadoid);

$errores = [];

$nombre = '';
$apellido = '';
$email = '';
$telefono = '';
$dni = '';
$tipo = '';

$emailOriginal = $usuario['email'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
    $email = mysqli_real_escape_string($db, isset($_POST['email']) ? $_POST['email'] : null);
    $telefono = mysqli_real_escape_string($db, $_POST['telefono']);
    $dni = mysqli_real_escape_string($db, $_POST['dni']);
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null; // Agregar verificación si el tipo está establecido

    // Validaciones de los datos ingresados por el usuario
    if(empty($nombre)){
        $errores[] = 'El nombre es obligatorio';
    }

    if(empty($apellido)){
        $errores[] = 'El apellido es obligatorio';
    }

    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errores[] = 'El email es obligatorio o no es válido';
    }

    if(empty($telefono) || !preg_match('/^\d{10}$/', $telefono)){
        $errores[] = 'El teléfono es obligatorio y debe ser un número de 10 dígitos';
    }

    if(empty($dni) || !preg_match('/^\d{8}$/', $dni)){
        $errores[] = 'El D.N.I es obligatorio y debe ser un número de 8 dígitos';
    }

    if(empty($tipo)){
        $errores[] = 'El tipo de usuario es obligatorio';
    }

    $queryDesactivarFKChecks = "SET foreign_key_checks = 0";
    $resultadoDesactivarFKChecks = mysqli_query($db, $queryDesactivarFKChecks);

    if(empty($errores)){



        $query = "UPDATE usuario SET nombre = '${nombre}', apellido = '${apellido}', email = '${email}', telefono = '${telefono}', dni = '${dni}', tipo_idtipo = '${tipo}' WHERE idusuario = ${id}";
        $resultado = mysqli_query($db, $query);

        $queryTipoReserva = "UPDATE reservas SET usuario_tipo_idtipo = ${tipo}";
        $reservaTipoReserva = mysqli_query( $db, $queryTipoReserva);

        if($resultado === TRUE && $reservaTipoReserva === TRUE){
            if($email !== $emailOriginal){

                if(isset($_SESSION['id']) && $_SESSION['id'] == $id) {
                    $_SESSION = [];
                }
            }
            
            header("Location: listadoperfil.php");
            exit; // Agregar exit después de redirigir para evitar que se ejecute más código innecesario
        } else {
            $errores[] = 'Error al actualizar el usuario: ' . mysqli_error($db);
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
                    <img src="../build/img/logo.png" alt="logo escuela">
                    <h2>Actualizar</h2>
                    <span>Registro</span>
                </div>

                <?php foreach($errores as $error) : ?>
                    <div class="alerta error">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach ?>

                <form class="formularioLogin" method="POST" enctype="multipart/form-data">
                    <div class="caja"> <!-- Caja inicio-->
                        <label for="nombre">Nombre:</label>
                        <input type="text" placeholder="Nombre" name="nombre" id="nombre" value="<?php echo $usuario['nombre'] ?>" required>
                
                        <label for="apellido">Apellido:</label>
                        <input type="text" placeholder="Apellido" name="apellido" id="apellido" value="<?php echo $usuario['apellido'] ?>" required>
                    </div> <!-- Caja fin-->

                    <label for="email">Email:</label>
                    <input type="email" placeholder="Email" name="email" id="email" value="<?php echo $usuario['email'] ?>" required>

                    <div class="caja"> <!-- Caja inicio-->
                        <label for="telefono">Telefono:</label>
                        <input type="tel" placeholder="El Telefono debe incluir el codigo de area" name="telefono" id="telefono" value="<?php echo $usuario['telefono'] ?>" required>

                        <label for="dni">D.N.I:</label>
                        <input type="text" placeholder="D.N.I" name="dni" id="dni" value="<?php echo $usuario['dni'] ?>" required>
                    </div> <!-- Caja fin-->

                    <label for="imagen">Imagen de Perfil:</label>
                    <input class="archivo" type="file" id="imagen" name="imagen" accept="image/jpg, image/png">
                    <img class="imagen-small" src="/biblioteca/admin/imagenes/<?php echo $usuario['imagen'] ?>" alt="">

                    <label for="tipo">Tipo de usuario:</label>
                    <select name="tipo" id="tipo">
                        <option class="usuario_tipo" value="1" <?php echo ($usuario['tipo_idtipo'] == 1) ? 'selected' : ''; ?>>Usuario</option>
                        <option class="usuario_tipo" value="2" <?php echo ($usuario['tipo_idtipo'] == 2) ? 'selected' : ''; ?>>Moderador</option>
                        <option class="usuario_tipo" value="3" <?php echo ($usuario['tipo_idtipo'] == 3) ? 'selected' : ''; ?>>Administrador</option>
                    </select>

                    <input class="btnLogin" type="submit" value="Actualizar Usuario">
                </form>
                <a class="cuenta" href="listadoperfil.php">Volver</a>
            </div>
        </section>
    </main>

    <script src="src/js/alerta.js"></script>
</body>
</html>
