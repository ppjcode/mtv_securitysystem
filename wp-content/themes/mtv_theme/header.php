<!-- HEADER DE LA PAGINA -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head()?>
</head>
<body>

<header>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="<?php echo home_url();?>">
                    <img src="<?php echo get_template_directory_uri()?>/assets/img/logo.png" alt="" width="250" height="100">
                </a>
            </div>
            <div class="col-8">
                <nav class="">
                    <!-- Generar un menu de ul -->
                        <?php
                            wp_nav_menu(
                                array(
                                    'theme_location'    =>  'top_menu',
                                    'menu_class'        =>  'nav',
                                    'container_class'   =>  'container'
                                )
                            );
                        ?>
                </nav>
            </div>
        </div>
    </div>
</header>