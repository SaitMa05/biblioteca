<?php
    session_start();

    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location: /biblioteca/login.php");
    }

    $_SESSION = [];


    header("Location: login.php");
