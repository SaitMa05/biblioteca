<?php
    require '../includes/config/database.php';
    $db = conectarDB();
    session_start();

    $emailSesion = $_SESSION['usuario'];
    $queryC = "SELECT * FROM usuario WHERE email = '$emailSesion'";
    $resultadoC = mysqli_query($db, $queryC);
    $usuarioC = mysqli_fetch_assoc($resultadoC);
    include '../includes/selects/user.php';
    include '../includes/templates/headerAdmin.php';

    $auth = $_SESSION['login'];

    if($usuarioC['tipo_idtipo'] == 1 || !$auth){
        header("Location: /biblioteca/principal.php");
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['aceptar'])) {
            $idusuario = $_POST['idusuario'];
            $query = "UPDATE usuario SET aceptado = 1 WHERE idusuario = $idusuario"; // Cambia 1 por el valor que necesites
            $resultado = mysqli_query($db, $query);

        } elseif (isset($_POST['negar'])) {
            $idusuario = $_POST['idusuario'];
            
            $queryGetPerfil = "SELECT idperfil FROM perfill WHERE usuario_idusuario = $idusuario";
            $resultadoGetPerfil = mysqli_query($db, $queryGetPerfil);
            $perfil = mysqli_fetch_assoc($resultadoGetPerfil);
            $idperfil = $perfil['idperfil'];

            $queryPerfil = "DELETE FROM perfill WHERE idperfil = $idperfil";
            $resultadoPerfil = mysqli_query($db, $queryPerfil);

            $query = "DELETE FROM usuario WHERE idusuario = $idusuario";
            $resultado = mysqli_query($db, $query);
        }
    }
    $busqueda = "";
    $query = "SELECT * FROM usuario WHERE nombre LIKE '%$busqueda' OR apellido LIKE '$busqueda' OR dni LIKE '%$busqueda' ORDER BY idusuario DESC";
    $resultado = mysqli_query($db, $query);


    
?>

    <main class="main">
        <section class="confirmar">
            <div class=confirmar-cont">
                <form class="buscadorAdmin" method="GET">
                    <input type="search" placeholder="Es recomendable solo buscar un dato por ej solo el nombre y no nombre y apellido o solo con el D.N.I" name="busqueda">
                    <input type="submit" value="Buscar" name="enivar">
                </form>

                <div class="cuentasC">
                <?php  
                    if(isset($_GET['enivar'])){
                        $busqueda = $_GET['busqueda'];
                        $busqueda = mysqli_real_escape_string($db, $busqueda);
                        if(strlen($busqueda)>255){
                            echo "Error. No se puede mas de 30 caracteres";
                        }
                        $query = "SELECT * FROM usuario WHERE nombre LIKE '%$busqueda' OR apellido LIKE '$busqueda' OR dni LIKE '%$busqueda'";
                        $resultado = mysqli_query($db, $query);
                    }
                ?>
            <?php while($usuario = mysqli_fetch_assoc($resultado)): ?>
                <?php if($usuario['aceptado'] == 0): ?>
                    <div class="cuentaC">

                        <!-- <p><?php // echo $usuario['idusuario']; ?></p> -->

                        <img src="/biblioteca/admin/imagenes/<?php echo $usuario['imagen'] ?>" alt="imagen de perfil">
                        <div class="infoConfirmar">

                            <div class="nombre info">
                                <p class="may">Nombre:</p>
                                <p><?php echo $usuario['nombre'], " " ,$usuario['apellido']?></p>
                            </div>

                            <div class="dni info">
                                <p class="may">D.N.I:</p>
                                <p><?php echo $usuario['dni']?></p>
                            </div>

                            <div class="telefono info">
                                <p class="may">Telefono:</p>
                                <p><?php echo $usuario['telefono']?></p>
                            </div>

                            <div class="confirm">
                                <form class="confirmarForm" action="confirmar.php" method="POST">

                                    <input type="submit" name="aceptar" value="Aceptar Cuenta">
                                    <input type="submit" name="negar" value="Negar Cuenta">
                                    <input type="hidden" name="idusuario" value="<?php echo $usuario['idusuario']; ?>">
                                </form>
                            </div>


                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endwhile; ?>

                </div>

            </div>
        </section>
    </main>
    

    <?php 
        include '../includes/templates/footer.php';
    ?>
