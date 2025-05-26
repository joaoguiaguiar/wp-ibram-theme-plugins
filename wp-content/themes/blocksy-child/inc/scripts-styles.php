<?php
function mi_load_all_styles() {
    wp_enqueue_style('blocksy-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('blocksy-child-style', get_stylesheet_directory_uri() . '/style.css', array('blocksy-parent-style'), filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_style('menu-style', get_stylesheet_directory_uri() . '/css/menu.css', array('blocksy-child-style'), filemtime(get_stylesheet_directory() . '/css/menu.css'));
    wp_enqueue_style('menu-2-style', get_stylesheet_directory_uri() . '/css/menu-2.css', array('blocksy-child-style'), filemtime(get_stylesheet_directory() . '/css/menu-2.css'));
    wp_enqueue_script('meu-tema-script', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'mi_load_all_styles', 100);

function debug_styles_loaded() {
    if (current_user_can('administrator')) {
        global $wp_styles;
        echo "<!-- ESTILOS CARREGADOS: \n";
        foreach($wp_styles->queue as $handle) {
            echo "$handle\n";
        }
        echo "-->\n";
    }
}
add_action('wp_head', 'debug_styles_loaded', 999);
