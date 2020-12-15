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




// ADD LIBRARIES

function assets() {
    // ADD STYLES LIBRARIES
    wp_enqueue_style('materialize','https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css', '', '1.0', 'all');
    wp_enqueue_style('roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap', '', '1.0', 'all');

    // EXECUTE FILE CSS CUSTOM
    wp_enqueue_style('estilos',get_stylesheet_uri(), array('materialize','roboto'), '1.0', 'all');
        // NOTA => get_stylesheet_uri -> Devolverá la ubicación de nuestro archivo css


    // REGISTER JS
    wp_register_script('pooper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js', '', '2.5.4', true);
    // Llamar Jquery que ya viene integrado en las librerías de WP
    wp_enqueue_script('materialize', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js', array('jquery','pooper'), '1.0', true);

    // LOAD SCRIPT CUSTOM
    wp_enqueue_script('custom', get_template_directory_uri().'/assets/js/custom.js', '', '1.0', true);


    // FUNCTION FOR SEND AN OBJECT FROM FILE PHP TO FILE JS
    // Función que nos permite enviar un objeto desde nuestro archivo php a un archivo js
        // primer atributo -> handle o nombre que registramos el archivo a usar
        // segundo atributo -> nombre de objeto que vamos a poner
        // tercer atributo  ->  array que recibe informacion
    wp_localize_script('custom','pg', array(
        'ajaxurl'   =>  admin_url('admin-ajax.php'),
        'apiurl'    =>  home_url('wp-json/mtv/v1/')
    ));

}


// Agregar hook para hacer funcionar la función assets
add_action('wp_enqueue_scripts', 'assets');




/*********  CREATE WIDGET FOR FOOTER *********/

function sidebar() {
    register_sidebar(
        array(
            'name'          =>  'Pie de Página',
            'id'            =>  'footer',
            'description'   =>  'Zona de widgets para pie de página',
            'before_title'  =>  '<p>',
            'after_title'   =>  '</p>',
            'before_widget' =>  '<div id="%1$s" class="%2$ss">',
            'after_widget'  =>  '</div>'
        )
    );
}

// INITIALIZE WIDGET IN THE CODE WP
add_action('widgets_init','sidebar');

// ??
add_theme_support('post-thumbnails');



/*********  CREATE A CUSTOM POST TYPE *********/

function products_type() {

    $labels = array(
        'name'          =>  'Productos',
        'singular_name' =>  'Producto',
        'menu_name'     =>  'Productos'
    );

    $args = array(
        'label'              =>  'Productos',
        'description'        =>  'Productos de MTV',
        'labels'             =>  $labels,
        'supports'           =>  array('title','editor','thumbnail','revisions'),
        'public'             =>  true,
        'show_in_menu'       =>  true,
        'menu_position'      =>  5,
        'menu_icon'          =>  'dashicons-cart',
        'can_export'         =>  true,
        'publicly_queryable' =>  true,
        'rewrite'            =>  true,
        'show_in_rest'       =>  true,
    );

    register_post_type('producto', $args);
}

// Generar hook para agregar custom post type de productos
add_action('init', 'products_type');


/*********  FUNCTION TO REGISTER TAXONOMY *********/

function pgRegisterTax() {
    $args = array(
        'hierarchical'      =>  true,
        'labels'            =>  array(
                                    'name'          =>  'Categorías de Productos',
                                    'singular_name' =>  'Categoría de Producto'),
        'show_in_nav_menu'  =>  true,
        'show_admin_column' =>  true,
        'rewrite'           =>  array('slug' => 'categoria-productos')  
    );

    // REGISTER TAXONOMY
    register_taxonomy('categoria-productos', array('producto'), $args);
}

// Asignar nuestra función a algún momento en la construcción de nuestra plantilla usando un hook
add_action('init', 'pgRegisterTax');






// ASIGN FUNCTION TO AJAX HOOKS
add_action('wp_ajax_nopriv_pgFiltroProductos', 'pgFiltroProductos');    // nopriv para permitir a los usuarios no logueados hacer uso de esta función
add_action('wp_ajax_pgFiltroProductos', 'pgFiltroProductos');


// FUNCTION TO FILTER PRODUCTS IN HOME
function pgFiltroProductos() {
    
    $args = array(
        'post_type'      => 'producto',
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'orderby'        => 'title'
    );

    if($_POST['categoria']){
        $args['tax_query'] = array(
                                array(
                                    'taxonomy'  => 'categoria-productos',
                                    'field'     => 'slug',
                                    'terms'     => $_POST['categoria'],
                                )
        );
    }

    $productos = new WP_Query($args);

    // Verificar si nuestro loop logró conseguir post
    if($productos->have_posts()){
        $return = array();
        while($productos->have_posts()){
            $productos->the_post();
            $return[] = array(
                'imagen'    => get_the_post_thumbnail(get_the_ID(), 'large'),
                'link'      => get_the_permalink(),
                'titulo'    => get_the_title(),
            );
        }

        // Una vez que termine el while devolveremos nuestro array
        wp_send_json($return);
    }
}

// Crear endpoint personalizado para llamar novedades en la página principal

// Agregar función por medio de un hook a la interfaz de WP
add_action('rest_api_init', 'novedadesAPI');


function novedadesAPI() {
    register_rest_route(
        'mtv/v1',   // indicar namespace y version
        '/novedades/(?P<cantidad>\d+)',    // ruta que tendra el endpoint. Usamos una expresion regular para asegurarnos que el parametro será un numero
        array(  // pasamos un array
            'methods'   =>  'GET',
            'callback'  =>  'pedidoNovedades'  
        )    
    );
}

function pedidoNovedades($data){
    $args = array(
        'post_type'      =>  'post',
        'posts_per_page' =>  $data['cantidad'],
        'order'          =>  'ASC',
        'orderby'        =>  'title',
    );

    $novedades = new WP_Query($args);


    if($novedades->have_posts()){
        $return = array();
        while($novedades->have_posts()){
            $novedades->the_post();
            $return[] = array(
                'imagen'    => get_the_post_thumbnail(get_the_ID(), 'large'),
                'link'      => get_the_permalink(),
                'titulo'    => get_the_title(),
            );
        }

        // Una vez que termine el while devolveremos nuestro array
        return $return;
    }



}

// Asignar con hook nuestro bloque
add_action('init', 'mtvRegisterBlock');


// REGISTRAR BLOQUE GUTENBERG
function mtvRegisterBlock(){
    // Tomamos el archivo PHP generado en el Build
    $assets = include_once get_template_directory().'/blocks/build/index.asset.php';

    // Registrar nuestro index.js
    wp_register_script(
        'mtv-block',
        get_template_directory_uri().'/blocks/build/index.js',
        $assets['dependencies'],    // dependencias que necesita la librería
        $assets['version']  // Cada build cambia la version para no tener conflictos
    );

    // Registrar nuestro bloque
    register_block_type(
        'mtv/basic',    // Nombre del bloque
        array(
            'editor_script' =>  'mtv-block',
            'attributes'    =>  array(
                'content'   =>  array(
                    'type'  =>  'string',
                    'default'   =>  'Hello World'
                )
            ),
            'render_callback'   =>  'mtvRenderDinamycBlock'
        )
    );
}


// Bloque Gutenberg Dinámico
function mtvRenderDinamycBlock($attributes, $content) {
    return '<h2>'.$attributes['content'].'</h2>';
}



?>