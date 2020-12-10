<!-- Este archivo hará referencia a nuestras páginas -->

<?php 
    get_header()
    // Imprimir campos personalizados
    // $fields = get_fields();     
?>

<main class="container">
    <h1 class="my-3">Página<?php the_title();?></h1>
    <?php 
        if(have_posts()){
            while(have_posts()){
                the_post(); ?>
                <h1 class="my-3"><?php the_title();?></h1>

                <?php the_content();?>

            <?php }
        }
    ?>
</main>


<?php get_footer()?>