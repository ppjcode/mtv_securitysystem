<!-- HEADER DE LA PAGINA -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body>

    <header>
        <div>
            <nav class="nav-wrapper grey darken-2">
                <div class="container">    
                    <!-- <div> -->
                        <a href="<?php echo home_url(); ?>" class="brand-logo">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="" width="200" height="65">
                        </a>
                    <!-- </div> -->
                    <!-- Generar un menu de ul -->
                    <!-- <div> -->
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'    =>  'top_menu',
                                'menu_class'        =>  'right hide-on-med-and-down',
                                'container_class'   =>  ''
                            )
                        );
                        ?>
                    <!-- </div> -->
                </div>    
            </nav>
        </div>
    </header>