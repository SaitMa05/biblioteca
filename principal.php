<?php 
    session_start();
    
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location: login.php");
    }

    $includeAll = true;
    require './includes/templates/header.php';
?>


    <main class="main">
        <section class="bienvenidos">
            <div class="bienvenidos-cont">
                <div class="bienvenidos-inicio">
                    <!-- <img class="d-n-m" src="build/img/biblioteca.png" alt="imagen de biblioteca"> -->
                    <h2>Bienvenidos a la biblioteca <span>PRUEBA DE TITULO</span></h2>
                    <!-- <img class="d-n-d" src="build/img/biblioteca.png" alt="imagen de biblioteca"> -->
                </div>
            </div>
        </section>

        <div class="fondoInicio">
            <div class="actividades">
                <h2>Actividades para Hacer</h2>
                <div class="actividades-cajas">
                    <div class="actividades-caja"> <!--Inicio Caja-->
                        <img src="build/img/leer.jpg" alt="leer imagen">
                        <div class="info-a">
                            <p class="titulo-a">Leer📖</p>
                            <p class="texto-a">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam repudiandae repellendus at inventore ipsum dolore, quasi aperiam facilis ducimus officiis enim eaque in deleniti facere quos, laborum doloribus possimus fuga?</p>
                            <!-- <a href="" class="btnActividades"><p>Ver Actividades</p></a> -->
                        </div>
                    </div> <!--Fin Caja-->

                    <div class="actividades-caja"> <!--Inicio Caja-->
                        <img src="build/img/ajedrez.jpg" alt="ajedrez (jugar) imagen">
                        <div class="info-a">
                            <p class="titulo-a">Jugar🕹️</p>
                            <p class="texto-a">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam repudiandae repellendus at inventore ipsum dolore, quasi aperiam facilis ducimus officiis enim eaque in deleniti facere quos, laborum doloribus possimus fuga?</p>
                            <!-- <a href="" class="btnActividades"><p>Ver Actividades</p></a> -->
                        </div>
                    </div> <!--Fin Caja-->

                    
                    <div class="actividades-caja"> <!--Inicio Caja-->
                        <img src="build/img/estudiar.jpg" alt="estudiar imagen">
                        <div class="info-a">
                            <p class="titulo-a">Estudiar🏫</p>
                            <p class="texto-a">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam repudiandae repellendus at inventore ipsum dolore, quasi aperiam facilis ducimus officiis enim eaque in deleniti facere quos, laborum doloribus possimus fuga?</p>
                            <!-- <a href="" class="btnActividades"><p>Ver Actividades</p></a> -->
                        </div>
                    </div> <!--Fin Caja-->
                    
                </div>
            </div>
        </div>

        <div class="historia m-10r">
            <div class="historia-cont">
                <div class="historia-index">
                <img src="build/img/historia.jpg" alt="imagen biblioteca">
                    <div class="historia-info">
                        <p class="historia-titulo">Historia</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia quibusdam illo quisquam sunt laboriosam dolorum placeat nam molestiae ratione itaque labore quo dolores, soluta necessitatibus dignissimos nihil delectus sint odit?</p>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium optio, officia eum cum nesciunt pariatur ipsam eveniet repellendus! Quod repudiandae dicta cumque. Perferendis commodi optio inventore ea rerum facere. Necessitatibus?</p>
                        <a href="historia.php" class="btnActividades"><p>Historia Completa</p></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    

    <?php 
        include './includes/templates/footer.php';
    ?>
