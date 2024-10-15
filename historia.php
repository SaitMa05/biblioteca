<?php 

    session_start();
    $auth = $_SESSION['login'];
    if(!$auth){
        header("Location: login.php");
    }

    include './includes/templates/header.php';
?>


    <main class="main">
        <div class="historia">
            <div class="historia-cont">
                <div class="historia-inicio contenedor">
                    <img src="build/img/historia2.jpg" alt="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos facilis illum beatae minus sunt, dolore iste? Repudiandae accusamus vitae veniam debitis est! Et dolorem tempore minima earum <span class="importante">quae</span> autem eaque! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa accusamus totam vitae repellendus necessitatibus numquam minima voluptas? Asperiores necessitatibus minus amet, quasi ducimus debitis qui tempora incidunt fuga officia at. Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias temporibus provident fuga odit omnis molestiae corporis porro labore, quisquam laboriosam laborum ut exercitationem reprehenderit expedita! Odit assumenda quidem molestiae maxime?</p>
                </div>
                <div class="historia-completa contenedor">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores quibusdam ipsam eaque, dolore odio nihil facilis accusamus quos! Consequatur quisquam amet sequi dolor quaerat rem eius omnis in cupiditate modi? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum asperiores fuga perferendis aperiam a earum delectus et, sint eligendi? Esse ipsa ad, expedita vel perspiciatis qui laboriosam quia animi? Quidem.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima, sequi iste. Nam, neque quod fugit officia soluta facere aspernatur veritatis ducimus praesentium, nemo rem facilis nisi optio temporibus omnis? Vero.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, modi? Eum cupiditate nesciunt ab veritatis voluptas quisquam ullam inventore reiciendis, officia autem, consectetur, tenetur molestiae. Molestias officiis assumenda mollitia quas!Lorem</p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est veritatis aut mollitia quaerat cumque dicta tempore cupiditate, aliquam saepe exercitationem molestiae expedita eveniet iure quas harum ex. A, cum reiciendis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, ex quaerat voluptas sint, consectetur fugit iure vitae cum quisquam accusantium eligendi debitis, vero quae fuga aut non minima dignissimos architecto.</p>
                    
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni suscipit recusandae aperiam. Recusandae, quo deserunt? Porro laboriosam mollitia, libero fugiat adipisci explicabo quis, ad labore aliquam aliquid vitae similique quidem.</p>
                </div>
            </div>
        </div>
    </main>
    

    <?php 
        include './includes/templates/footer.php';
    ?>
