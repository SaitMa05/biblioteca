<?php
    require '../includes/config/database.php';
    $db = conectarDB();
    session_start();

    include '../includes/selects/user.php';


    $auth = $_SESSION['login'];

    if($usuario['tipo_idtipo'] == 1 || !$auth){
        header("Location: /biblioteca/principal.php");
    }
    include '../includes/templates/headerAdmin.php';



?>


    <main class="main contenedor">
        <section class="crud">
            <div class="crud-cont">

                <h2>Usuarios</h2>
                <div class="cajas">
                    <div class="caja">
                        <p>Confirmacion de Cuentas</p>
                        <img src="/biblioteca/build/img/tilde.jpg" alt="">
                        <a href="confirmar.php">Ir</a>
                    </div>

                    <div class="caja">
                        <p>Listado de Usuarios</p>
                        <img src="/biblioteca/build/img/useredit.png" alt="">
                        <a href="listadoperfil.php">Ir</a>
                    </div>
                </div>

                <h2>Libros</h2>
                <div class="cajas">
                        <div class="caja">
                            <p>Agregar Libro</p>
                            <img src="/biblioteca/build/img/portada.jpg" alt="">
                            <a href="agregarlibro.php">Ir</a>
                        </div>

                        <div class="caja">
                            <p>Listado de libros</p>
                            <img src="/biblioteca/build/img/libro.png" alt="">
                            <a href="listadolibros.php">Ir</a>
                        </div>

                        <div class="caja">
                            <p>Reservas Libros</p>
                            <img src="/biblioteca/build/img/reserva.png" alt="">
                            <a href="reservas.php">Ir</a>
                        </div>

                        <div class="caja">
                            <p>Agregar Categoria</p>
                            <img src="/biblioteca/build/img/categoria.jpg" alt="">
                            <a href="agregarcategoria.php">Ir</a>
                        </div>

                        <div class="caja">
                            <p>Eliminar Categoria</p>
                            <img src="/biblioteca/build/img/categoria.jpg" alt="">
                            <a href="eliminarcategoria.php">Ir</a>
                        </div>
                    </div>


                <h2>PDF</h2>
                <div class="cajas">
                        <div class="caja">
                            <p>Agregar PDF</p>
                            <img src="/biblioteca/build/img/portadapdf.jpg" alt="">
                            <a href="agregarpdf.php">Ir</a>
                        </div>

                        <div class="caja">
                            <p>Listado PDF</p>
                            <img src="/biblioteca/build/img/portadapdf.jpg" alt="">
                            <a href="listadopdf.php">Ir</a>
                        </div>
                    </div>



                    <h2>Autores</h2>
                    <div class="cajas">
                        <div class="caja">
                            <p>Agregar Autor</p>
                            <img src="/biblioteca/build/img/autor.jpg" alt="">
                            <a href="agregarautor.php">Ir</a>
                        </div>

                        <div class="caja">
                            <p>Listado Autor</p>
                            <img src="/biblioteca/build/img/autor.jpg" alt="">
                            <a href="agregarautor.php">Ir</a>
                        </div>
                    </div>

                    <h2>Notebooks</h2>
                    <div class="cajas">
                        <div class="caja">
                                <p>Agregar Notebook</p>
                                <img src="/biblioteca/build/img/notebook.png" alt="">
                                <a href="agregarnotebook.php">Ir</a>
                        </div>

                        <div class="caja">
                                <p>Listado de Notebook</p>
                                <img src="/biblioteca/build/img/notebook.png" alt="">
                                <a href="listadonotebook.php">Ir</a>
                        </div>
                        <div class="caja">
                                <p>Reservas Notebooks</p>
                                <img src="/biblioteca/build/img/notebook.png" alt="">
                                <a href="reservasNotebooks.php">Ir</a>
                        </div>
                    </div>


                    
                    
                </div>

            </div>
        </section>
    </main>
    


    <?php 
        include '../includes/templates/footer.php';
    ?>
