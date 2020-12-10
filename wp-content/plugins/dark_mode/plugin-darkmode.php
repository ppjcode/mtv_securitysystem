<?php

//Plugin Name: DarkMode
//Description: Activa modo oscuro en tu tema
//Version: 1.0.0
//Autor: ppjcode
//Author URI: ppjcode.com


// Llamar archivo css del plugin
function styles_plugin() {

    $estilos_url = plugin_dir_url(__FILE__);
    wp_enqueue_style('modo_oscuro', $estilos_url.'/assets/css/style.css', '', '1.0','all');
}

add_action('wp_enqueue_scripts', 'styles_plugin');


?>