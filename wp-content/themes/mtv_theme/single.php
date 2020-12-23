<!-- Este archivo hará referencia a nuestras entradas y los custom post type -->

<?php get_header(); ?>

<!-- Ejecutar un loop basico para mostrar los post -->
<main class="container">
    <h1 class="mt-4"><?php the_title(); ?></h1>
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
    ?>
            <div class="row center-align">
                <div class="">
                    <?php the_post_thumbnail('full'); ?>
                </div>
            </div>
            <div class="row">
                <?php the_content(); ?>
            </div>


            <?php
                get_template_part('template-parts/post', 'navigation')
            ?>
    <?php }
    }
    ?>
</main>

<?php get_footer(); ?>