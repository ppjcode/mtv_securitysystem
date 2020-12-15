<!-- ARCHIVO PARA VIEW DEL HOME -->

<?php get_header(); ?>


<!-- Inicializar un loop básico -->

<!-- Parallax -->
<div class="parallax-container">
    <div class="parallax">
        <?php $ruta = get_template_directory_uri() . '/assets/img/cctv_banner.jpg'; ?>
        <img src="<?php echo $ruta; ?>" class="" alt="Banner" width="100">
    </div>
</div>



<main class="container">


    <!-- Quienes somos -->
    <div class="mt-5">
        <h1 class="center-align">Instalación de Cámaras de Seguridad</h2>

            <div class="row mt-4">
                <div class="col s8">
                    <h5>¿Quienes somos</h5>
                    <p>Somos MTV Security Electronic, una empresa peruana con más de 5 años de experiencia en la distribución e instalación de Sistemas deSeguridad Electrónica, tales como CCTV, Alarmas antirobos, Cercos perimétricos, etc.</p>
                    <p>Contamos con personal técnico especializado que le brindarán el mejor sistema electrónico de seguridad para la protección de su patrimonio personal.</p>
                </div>
                <div class="col s4 center-align">
                    <div class="card">
                        <div class="card-image">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/oficina.jpg'; ?>" alt="Nuestra oficina" width="400">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col s4 center-align">
                    <div class="card">
                        <div class="card-image">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/tecnicos.jpg'; ?>" alt="Nuestra oficina" width="400">
                        </div>
                    </div>
                </div>
                <div class="col s8">
                    <h5>Nuestra misión</h5>
                    <p>Somos MTV Security Electronic, una empresa peruana con más de 5 años de experiencia en la distribución e instalación de Sistemas deSeguridad Electrónica, tales como CCTV, Alarmas antirobos, Cercos perimétricos, etc.</p>
                    <p>Contamos con personal técnico especializado que le brindarán el mejor sistema electrónico de seguridad para la protección de su patrimonio personal.</p>
                </div>
            </div>

            <!-- Servicios -->
            <div class="services mt-5" id="services">
                <h1 class="center-align">Nuestros principales servicios</h2>

                    <div class="row mt-3">

                        <div class="col s4">
                            <h5 class="center-align">CCTV</h5>
                            <p class="center-align">Implementamos sistemas de video vigilancia que podrás monitorear desde tu dispositivo de celular o desdecualquier ordenador con conexión a internet. Trabajamos con las mejores marcas del mercado en nuestro servicio de Instalación yMantenimiento de Sistemas CCTV.</p>

                            <div class="card">
                                <div class="card-image">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/cctv.jpg'; ?>" alt="" width="400" height="300">
                                    <span class="card-title">Ver más</span>
                                </div>
                            </div>
                        </div>

                        <div class="col s4">
                            <h5 class="center-align">Alarmas anti robos</h5>
                            <p class="center-align">Contamos con Sistemas de Alarmas con conexión a Internet que le permitirá ser notificado en cada caso de intrusión. Los paneles y sensores instalados son de la más sotisficada tecnología capaz de integrarse a cualquier dispositivo de forma remota.</p>

                            <div class="card">
                                <div class="card-image">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/alarmas.jpg'; ?>" alt="" width="400" height="300">
                                    <span class="card-title">Ver más</span>
                                </div>
                            </div>
                        </div>


                        <div class="col s4">
                            <h5 class="center-align">Monitoreo 24/7</h5>
                            <p class="center-align">Nuestro servicio de monitoreo lo mantiene protegido y segudo las 24 horas del día. Contamos con conexión inmediata con los centros policiales más cercanos a su domicilo para una rápida intervención en caso de intentos de intrusión.</p>

                            <div class="card">
                                <div class="card-image">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/monitoreo.jpg'; ?>" alt="" width="400" height="300">
                                    <span class="card-title">Ver más</span>
                                    </card-image>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Products Section -->
                    <div class="lista_productos mt-5">
                        <h2 class="center-align">Productos Destacados</h2>

                        <!-- Products Filter -->
                        <div class="row mt-3">
                            <div class="col s12">
                                <select name="categorias-productos" id="categorias-productos">
                                    <option value="">Todas las categorías</option>
                                    <?php
                                    $terms = get_terms('categoria-productos', array('hide_empty' => true));
                                    // Recorremos las categorías con un loop
                                    foreach ($terms as $term) {
                                        echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>




                        <!-- Loop for shared products -->
                        <div id="resultado-productos" class="row mt-4 mb-4">
                            <?php
                            $args = array(
                                'post_type' =>  'producto',
                                'post_per_page' =>  -1, // -1 -> get all products
                                'order' =>  'ASC',
                                'orderby'   => 'title'
                            );

                            $productos = new WP_Query($args);

                            if ($productos->have_posts()) {
                                while ($productos->have_posts()) {

                                    $productos->the_post();
                            ?>
                                    <a href="<?php the_permalink(); ?>" class="black-text">
                                        <div class="col s3 center-align">
                                            <figure>
                                                <?php the_post_thumbnail('thumbnail'); ?>
                                            </figure>
                                            <h4>
                                                <p>
                                                    <?php the_title(); ?>
                                                </p>
                                            </h4>
                                        </div>
                                    </a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="center-align">
                            <a class="waves-effect waves-light btn grey darken-4">Ver Tienda</a>      
                        </div>
                    </div>

                    <!-- NOVEDADES -->
                    <div class="row center-align mt-5">
                        <div class="col-12">
                            <h2>Novedades</h2>
                        </div>
                        <div class="row" id="resultado-novedades">

                        </div>
                    </div>            





                    <div class="mt-5 mb-3">
                        <h2 class="center-align">Contáctanos</h2>
                        <div class="row mt-3">
                            <div class="col s5 center-align">
                                <h6>¿Tienes algúna duda? Escríbenos</h6>
                                <form action="">
                                    <div class="input-field col s12">
                                        <input id="nombre" type="text" class="validate">
                                        <label for="nombre">Nombre y Apellido</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="telefono" type="text" class="validate">
                                        <label for="telefono">Teléfono</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="email" type="email" class="validate">
                                        <label for="email">Correo</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                                        <label for="textarea1">Mensaje</label>
                                    </div>
                                    <button class="btn waves-effect waves-light grey darken-4" type="submit" name="action">Enviar
                                        <i class="material-icons right"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col s7 center-align">
                                <img src="<?php echo get_template_directory_uri() . '/assets/img/atencion_cliente.jpg'; ?>" alt="" width="400" height="300">
                            </div>
                        </div>
                    </div>
                    
</main>



<?php get_footer(); ?>