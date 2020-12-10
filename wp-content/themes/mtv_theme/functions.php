<?php

// Aqui se agregará código propio


// Inicializar algunas funciones o supports a nuestro tema

function init_template(){
    // Función para agregar funcionalidades extras al tema
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag'); // Imprimir title de la página


    // Agregar un menú a nuestro tema
    register_nav_menus(
        array(
            'top_menu' => 'Menú Principal'
        )
        );
}


// Ejecutar función dentro del código de WP mediante un hook
add_action('after_setup_theme', 'init_template');




// AGREGAR LIBRERÍAS

function assets() {
    // Agregar estilos
    wp_enqueue_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css', '', '5.0.0', 'all');
    wp_enqueue_style('fira', 'https://fonts.googleapis.com/css2?family=Fira+Code&display=swap', '', '1.0', 'all');

    // Ejecutar nuestro archivo style.css
    wp_enqueue_style('estilos',get_stylesheet_uri(), array('bootstrap','fira'), '1.0', 'all');
        // NOTA => get_stylesheet_uri -> Devolverá la ubicación de nuestro archivo css


    // Registrar JS
    wp_register_script('pooper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js', '', '2.5.4', true);
    // Llamar Jquery que ya viene integrado n las librerías de WP
    wp_enqueue_script('bootstraps', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js', array('jquery','pooper'), '5.0.0', true);

    // Cargar un script propio
    wp_enqueue_script('custom', get_template_directory_uri().'/assets/js/custom.js', '', '1.0', true);


}


// Agregar hook para hacer funcionar la función assets
add_action('wp_enqueue_scripts', 'assets');




// CREATE WIDGET

function sidebar() {
    register_sidebar(
        array(
            'name'  =>  'Pie de Página',
            'id'    =>  'footer',
            'description'   =>  'Zona de widgets para pie de página',
            'before_title'  =>  '<p>',
            'after_title'   =>  '</p>',
            'before_widget' =>  '<div id="%1$s" class="%2$s">',
            'after_widget'  =>  '</div>'
        )
    );
}

// INITIALIZE WIDGET IN THE CODE WP
add_action('widgets_init','sidebar');

// ??
add_theme_support('post-thumbnails');



// CREATE A CUSTOM POST TYPE

function products_type() {

    $labels = array(
        'name'  =>  'Productos',
        'singular_name' =>  'Producto',
        'menu_name' =>  'Productos'
    );

    $args = array(
        'label' =>  'Productos',
        'description'   =>  'Productos de MTV',
        'labels'    =>  $labels,
        'supports'  =>  array('title','editor','thumbnail','revisions'),
        'public'    =>  true,
        'show_in_menu'  =>  true,
        'menu_position' =>  5,
        'menu_icon' =>  'dashicons-cart',
        'can_export'    =>  true,
        'publicly_queryable'    =>  true,
        'rewrite'   =>  true,
        'show_in_rest'  =>  true,
    );

    register_post_type('producto', $args);
}

// Generar hook para agregar custom post type de productos
add_action('init', 'products_type');



// Registrar nuestra taxonomia

function pgRegisterTax() {
    $args = array(
        'hierarchical'  =>  true,
        'labels'    =>  array(
            'name'  =>  'Categorías de Productos',
            'singular_name' =>  'Categoría de Producto',   
        ),
        'show_in_nav_menu'  =>  true,
        'show_admin_column' =>  true,
        'rewrite'  =>  array('slug' => 'categoria-productos')  
    );

    // Registrar taxonomia
    register_taxonomy('categoria-productos', array('producto'), $args);
}

// Asignar nuestra función a algún momento en la construcción de nuestra plantilla usando un hook
add_action('init', 'pgRegisterTax');


?>


