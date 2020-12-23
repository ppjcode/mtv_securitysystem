<!-- HEADER DE LA PAGINA -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <?php wp_head() ?>
</head>

<body>

    <header>
        <nav class="grey darken-4">
            <div class="nav-wrapper">
                <a href="<?php echo home_url(); ?>" class="brand-logo ml-1"> LOGOTIPO </a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                <!-- Generar Menú (ul) -->
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'    =>  'top_menu',
                        'menu_class'        =>  'right hide-on-med-and-down',
                        'container_class'   =>  ''
                    )
                );
                ?>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <li><a href="">Inicio</a></li>
            <li><a href="<?php echo get_permalink().'/tienda' ?>">Productos</a></li>
            <li><a href="#services">Servicios</a></li>
            <li><a href="<?php echo get_permalink().'/blog' ?>">Blog</a></li>
            <li><a href="#contacto">Contacto</a></li>
        </ul>
    </header>