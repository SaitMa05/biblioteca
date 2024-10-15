<?php

    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_GET['id'])){
        $idUsuarioSession = $_GET['id'];
        $_SESSION['idUsuario'] = $idUsuarioSession;
    }

    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location: /biblioteca/login.php");
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.E.S.T N1</title>
    <link rel="icon" href="/biblioteca/build/img/logo.png" type="png">
    <link rel="stylesheet" href="/biblioteca/build/css/app.css">
</head>
<body>
    <header class="header">
        <div class="header-cont">
            <div class="izquierda">
                <div class="logo">
                    <a href="/"><img src="/biblioteca/build/img/logo.png" alt=""></a>
                    <div class="btnMenu">
                        <input id="toggleChecker" type="checkbox">
                        <label id="togglerLable" for="toggleChecker">
                        <div class="checkboxtoggler">
                            <div class="line-1"></div>
                            <div class="line-2"></div>
                            <div class="line-3"></div>
                        </div>
                        </label>
                    </div>
                    <nav class="nav d-n">
                        <a href="/biblioteca/principal.php">Volver</a>
                        <a href="/biblioteca/admin/reservasAdminNotebooks.php?id=<?php echo $idUsuarioSession  ?>">Notebooks</a>
                    </nav>
                </div>
            </div>
            <div class="derecha">
                <div class="perfil">
                    <a title="Perfil" href="/biblioteca/perfil.php">
                        <img src="/biblioteca/admin/imagenes/<?php echo $usuario['imagen'] ?>" alt="foto de perfil">
                        <p><?php echo $usuario['nombre'] ?></p>
                        <p><?php echo $usuario['apellido'] ?></p>
                    </a>
                </div>
                
                   <?php  if($usuario['tipo_idtipo'] == 2 || $usuario['tipo_idtipo'] == 3): ?>
                        <a class="admin" href="/biblioteca/admin/index.php">Ir a Administracion</a>
                       <?php endif; ?>
            </div>
        </div>
    </header>