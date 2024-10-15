<?php 
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location: /biblioteca/login.php");
    }
?>

<footer class="footer">
        <div class="footer-cont">
            <p>Todos los derechos reservados <span class="yearFooter"></span>&copy;</p>
        </div>
    </footer>
    <script src="src/js/app.js"></script>

    <!-- <script src="src/js/alerta.js"></script> -->

</body>
</html>