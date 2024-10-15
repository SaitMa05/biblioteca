<?php
    require 'includes/config/database.php';
    $db = conectarDB();
    // var_dump($db)
    
    $errores = [];

    $nombre = '';
    $apellido = '';
    $email = '';
    $password = '';
    $passwordConfirm = '';
    $telefono = '';
    $dni = '';


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nombre = mysqli_real_escape_string($db, $_POST['nombre']) ;
        $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
        $email = mysqli_real_escape_string($db, isset($_POST['email']) ? $_POST['email'] : null);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $passwordConfirm = mysqli_real_escape_string($db, $_POST['passwordConfirm']);
        $telefono = mysqli_real_escape_string($db, $_POST['telefono']);
        $dni = mysqli_real_escape_string($db, $_POST['dni']);
        $tipo = 1;

        $imagen = $_FILES['imagen'];


        $nombre = strip_tags($nombre);
        $apellido = strip_tags($apellido);
        $password = strip_tags($password);
        $passwordConfirm = strip_tags($passwordConfirm);
        $telefono = strip_tags($telefono);
        $dni = strip_tags($dni);

        $nombre = preg_replace('/[<>\?\/]/', '', $nombre);
        $apellido = preg_replace('/[<>\?\/]/', '', $apellido);
        $telefono = preg_replace('/[<>\?\/]/', '', $telefono);
        $dni = preg_replace('/[<>\?\/]/', '', $dni);

        
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        


        $passwordHash = password_hash($password, PASSWORD_DEFAULT);


        if ($email !== null) {
            // Consulta preparada para seleccionar el email de la base de datos
            $querySelectEmail = "SELECT email FROM `biblioteca_esc`.`usuario` WHERE email = ?";
            $stmt = $db->prepare($querySelectEmail);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            // Verificar si se obtuvo un resultado
            if ($stmt->num_rows > 0) {
                $errores[] = 'Este email ya está en uso';
            }
            $stmt->close();
        }

        if ($dni !== null) {
            // Consulta preparada para seleccionar el email de la base de datos
            $querySelectDNI = "SELECT dni FROM `biblioteca_esc`.`usuario` WHERE dni = ?";
            $stmt = $db->prepare($querySelectDNI);
            $stmt->bind_param("s", $dni);
            $stmt->execute();
            $stmt->store_result();

            // Verificar si se obtuvo un resultado
            if ($stmt->num_rows > 0) {
                $errores[] = 'Este D.N.I ya está registrado';
            }
            $stmt->close();
        }

        if ($telefono !== null) {
            // Consulta preparada para seleccionar el email de la base de datos
            $querySelectTelefono = "SELECT dni FROM `biblioteca_esc`.`usuario` WHERE telefono = ?";
            $stmt = $db->prepare($querySelectTelefono);
            $stmt->bind_param("s", $telefono);
            $stmt->execute();
            $stmt->store_result();

            // Verificar si se obtuvo un resultado
            if ($stmt->num_rows > 0) {
                $errores[] = 'El telefono ya se encuentra registrado';
            }
            $stmt->close();
        }


        if(strlen($dni) < 8 || strlen($dni) > 8 || !filter_var($dni, FILTER_VALIDATE_INT)){
            $errores[] = 'El D.N.I no es Valido';
        }

        if(!$nombre){
            $errores[] = 'El nombre es obligatorio';
        }

        if(!$apellido){
            $errores[] = 'El apellido es obligatorio';
        }

        if(!$email || strlen($email) > 100){
            $errores[] = 'El email es obligatorio o no puede ser mayor a 100 caracteres';
        }

        if(!$password){
            $errores[] = 'El password es obligatorio';
        }
        elseif ((strlen($password) < 6)) {
            $errores[] = 'La password no puede ser menor que 6 caracteres';
        }

        if(!$telefono || !filter_var($telefono, FILTER_VALIDATE_INT) || strlen($telefono) > 10){
            $errores[] = 'El telefono es obligatorio o no es valido';
        }

        if(!$dni){
            $errores[] = 'El D.N.I es obligatorio';
        }

        // if($imagen['error'] ){
        //     $errores[] = 'Error al colocar la imagen';
        //     var_dump($imagen["error"]);
        // }




        $medida = 1000 * 6144; // 6MB

        if($imagen['size'] > $medida){
            $errores[] = 'la imagen es muy pesada';
        }


         if($password === $passwordConfirm){
            if(empty($errores)){

                // Subida de archivos

                // Crear Carpeta
                $carpetaImg = 'admin/imagenes/';


                if(!is_dir($carpetaImg)){
                    mkdir($carpetaImg);
                }
                if(!$imagen || $imagen['error']){
                    $nombreImg = $nombreImg['tmp_name'];
                    $nombreImg = "user.png";
                }else{
                    $nombreImg = md5(uniqid(rand(), true)) . ".jpg";
                    move_uploaded_file($imagen['tmp_name'], $carpetaImg . $nombreImg);
                }
                // Generar un nombre unico



                // Subir la Imagen



                // Insertar en la base de datos
                $query = "INSERT INTO usuario (nombre, apellido, email, password, telefono, dni, imagen, session, fecha_registro, aceptado, tipo_idtipo) VALUES ('$nombre', '$apellido', '$email', '$passwordHash', '$telefono', '$dni','$nombreImg', 0, NOW(), 0, '$tipo')";
                // echo $query;

                $resultado = mysqli_query($db, $query);

                if($resultado === TRUE){
                    $id = $db->insert_id;
                    $queryPerfilI = "INSERT INTO perfill (usuario_idusuario) VALUES ('$id')"; 
                    $resultadoPerfilI = mysqli_query($db, $queryPerfilI);
                }


                header("Location: registroexitoso.php");

            }
         }else{
            $errores[] = 'La passwords deben ser iguales';
         }




    }


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="icon" href="build/img/logo.png" type="png">
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>

    <main class="main">
    <section class="registro contenedorIndex">
        <div class="registro-cont">
            <div class="logoLogin">
                <img src="build/img/logo.png" alt="logo escuela">
                <h2>Registro</h2>
                <span>Registro</span>
            </div>


            <?php  foreach($errores as $error) : ?>
                <div class="alerta error">
                <?php echo $error; ?>
                </div>
            <?php endforeach ?>

            <form class="formularioLogin" action="registrarse.php" method="POST" enctype="multipart/form-data">

                <div class="caja"> <!-- Caja inicio-->
                    <label for="nombre">Nombre:</label>
                    <input type="text" placeholder="Nombre" name="nombre" id="nombre" value="<?php echo $nombre ?>" required>
            
                    <label for="apellido">Apellido:</label>
                    <input type="text" placeholder="Apellido" name="apellido" id="apellido" value="<?php echo $apellido ?>" required>
                </div> <!-- Caja fin-->

                <label for="email">Email:</label>
                <input type="email" placeholder="Email" name="email" id="email" value="<?php echo $email ?>" required>
                <div class="caja"> <!-- Caja inicio-->
                    <label for="password">Contraseña:</label>
                    <input type="password" placeholder="Contraseña" name="password" id="password" required>

                    <label for="passwordConfirm">Confirmar Contraseña</label>
                    <input type="password" placeholder="Confirmar Contraseña" name="passwordConfirm" id="passwordConfirm" required>
                </div> <!-- Caja fin-->

                <div class="caja"> <!-- Caja inicio-->
                    <label for="telefono">Telefono:</label>
                    <input type="tel" placeholder="El Telefono debe incluir el codigo de area" name="telefono" id="telefono" value="<?php echo $telefono ?>" required>

                    <label for="dni">D.N.I:</label>
                    <input type="text" placeholder="D.N.I" name="dni" id="dni" value="<?php echo $dni ?>" required>
                </div> <!-- Caja fin-->

                <label for="imagen">Imagen de Perfil:</label>
                <input class="archivo" type="file" id="imagen" name="imagen" accept="image/jpg, image/png">
<!-- 
                <label for="tipo">tipo de usuario:</label>
                <select name="tipo" id="tipo">
                    <option class="usuario_tipo" value="1" selected disabled>Usuario</option>
                </select> -->

                <input class="btnLogin" type="submit" value="Registrarse">
            </form>
            <a class="cuenta" href="login.php">Ya tienes una cuenta? Inicia Session</a>
        </div>
    </section>

    </main>


    <script src="src/js/alerta.js"></script>

</body>
</html>