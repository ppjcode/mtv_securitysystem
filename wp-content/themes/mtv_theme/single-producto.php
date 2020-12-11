<!-- Este archivo hará referencia a nuestras entradas y los custom post type -->

<?php get_header(); ?>

<!-- Ejecutar un loop basico para mostrar los post -->
<main class="container">
    <h1 class="my-4"><?php the_title(); ?></h1>
    
    <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $taxonomy = get_the_terms(get_the_ID(), 'categoria-productos');
    ?>
            <div class="row my-5">
                <div class="col-md-6 col-12">
                    <?php the_post_thumbnail('large'); ?>
                </div>
                <div class="col-md-6 col-12">
                    <!-- Agregamos shortcode de nuestro formulario -->
                    Formulario
                    <?php echo do_shortcode('[contact-form-7 id="47" title="Formulario 1"]'); ?>
                </div>
                <div class="col-12">
                    <?php the_content(); ?>
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
                if($productos -> have_posts()) { 
            ?>
                    <div class="row justify-content-center productos-relacionados">
                        <div class="col-12">
                            <h3 class="text-center">Productos Relacionados</h3>
                        </div>
                        <?php  
                            while($productos -> have_posts()){
                                $productos->the_post();
                                if(get_the_ID() != $ID_producto_actual) {
                        ?>
                                    <div class="col-2 my-3 text-center">
                                        <?php 
                                            the_post_thumbnail('thumbnail');
                                        ?>
                                        <h4>
                                            <a href="<?php the_permalink();?>">
                                                <?php the_title();?>
                                            </a>

                                        </h4>
                                    </div>
                        <?php    }
                            }
                        ?>    
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