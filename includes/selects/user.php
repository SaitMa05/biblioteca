<?php
    $idSesion = $_SESSION['id'];
    $query = "SELECT * FROM usuario WHERE idusuario = '$idSesion'";
    $resultado = mysqli_query($db, $query);
    $usuario = mysqli_fetch_assoc($resultado);
?>