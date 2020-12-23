<!-- Este archivo hará referencia a nuestras entradas y los custom post type -->

<?php get_header(); ?>

<!-- Ejecutar un loop basico para mostrar los post -->
<main class="container">
    <h1 class=""><?php the_title(); ?></h1>

    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $taxonomy = get_the_terms(get_the_ID(), 'categoria-productos');
    ?>
            <div class="row">
                <div class="col s12 m7 center-align">
                    <div class="">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                    <div class="carrousel hide-on-small-only">
                        <a href="" class="box">Foto 1</a>
                        <a href="" class="box">Foto 2</a>
                        <a href="" class="box">Foto 3</a>
                    </div>
                </div>
                <div class="col s12 m5">
                    <h4 class="center-align">Características del Producto</h4>
                    <?php the_content(); ?>
                    <div class="center-align mt-3">
                        <a class="waves-effect waves-light btn grey darken-4">Agregar al carrito</a>
                    </div>
                </div>
            </div>

            <!-- Loop para productos relacionados         -->
            <?php
            $ID_producto_actual = get_the_ID();
            $args = array(
                'post_type' =>  'producto',
                'posts_per_page'   =>  6,
                'order' =>  'ASC',
                'orderby'  => 'title',
                'tax_query'  =>  array(
                    array(
                        'taxonomy'  =>  'categoria-productos',
                        'field'  =>  'slug',
                        'terms'  =>  $taxonomy[0]->slug
                    )
                )
            );

            $productos = new WP_Query($args);    // Loop personalizado con productos. Es un objeto
            ?>

            <?php
            // Verificar si este objeto tiene o no productos
            if ($productos->have_posts()) {
            ?>
                <div class="productos-relacionados center-align mt-3">
                    <div class="col s12 m12">
                        <h4>Productos Relacionados</h4>
                    </div>

                    <div class="row">
                        <?php
                            while ($productos->have_posts()) {
                                $productos->the_post();
                                if (get_the_ID() != $ID_producto_actual) {
                        ?>
                                    <a class="col s12 m2 black-text" href="<?php the_permalink(); ?>">
                                        <?php
                                        the_post_thumbnail('thumbnail');
                                        ?>
                                        <p>
                                            <?php the_title(); ?>
                                        </p>
                                    </a>
                        <?php   
                                } 
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>

    <?php
        }
    }
    ?>
</main>

<?php get_footer(); ?>