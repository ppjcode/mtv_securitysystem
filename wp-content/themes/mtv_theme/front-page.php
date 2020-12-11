<!-- ARCHIVO PARA VIEW DEL HOME -->

<?php get_header(); ?>


<!-- Inicializar un loop básico -->


<div class="parallax-container">
    <div class="parallax"><img src="<?php echo get_template_directory_uri(); ?>assets/img/banner.jpg" alt="Banner"></div>
</div>


<main class="container">



    <!-- Sección para productos -->
    <div class="lista_productos">
        <h2 class="center-align">Productos</h2>

        <!-- Filtro de productos -->
        <div class="row">
            <div class="col s6">
                <select name="categorias-productos" id="categorias-productos">
                    <option value="">Todas las categorías</option>
                    <?php
                    $terms = get_terms('categoria-productos', array('hide_empty' => true));
                    foreach ($terms as $term) {
                        echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>




        <!-- Mostrar productos -->
        <div class="row">
            <?php
            $args = array(
                'post_type' =>  'producto',
                'post_per_page' =>  -1, // para que traiga todos los productos
                'order' =>  'ASC',
                'orderby'   => 'title'
            );

            $productos = new WP_Query($args);

            if ($productos->have_posts()) {
                while ($productos->have_posts()) {
                    $productos->the_post();
            ?>
                    <div class="col s4">
                        <figure>
                            <?php the_post_thumbnail('large'); ?>
                        </figure>
                        <h4 class="center-align">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>
                    </div>

            <?php
                }
            }


            ?>
        </div>
    </div>
</main>


<?php get_footer(); ?>