<?php
/**
 * Carrega todos os CSS e JS do tema IBRAM
 */

// Segurança
if (!defined('ABSPATH')) exit;

/**
 * Carrega styles e scripts do tema
 */
function ibram_carregar_assets() {
    // CSS do tema pai (Blocksy)
    wp_enqueue_style(
        'blocksy-parent-style', 
        get_template_directory_uri() . '/style.css'
    );

    // CSS do tema filho (IBRAM)
    wp_enqueue_style(
        'blocksy-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('blocksy-parent-style'),
        filemtime(get_stylesheet_directory() . '/style.css')
    );

    // CSS dos menus
    wp_enqueue_style(
        'ibram-menu-style',
        get_stylesheet_directory_uri() . '/css/menu.css',
        array('blocksy-child-style'),
        filemtime(get_stylesheet_directory() . '/css/menu.css')
    );

    // JS apenas nas páginas necessárias
    if (is_front_page() || is_single() || is_page() || is_category()) {
        wp_enqueue_script(
            'ibram-tema-script',
            get_stylesheet_directory_uri() . '/js/script.js',
            array('jquery'),
            filemtime(get_stylesheet_directory() . '/js/script.js'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'ibram_carregar_assets', 100);

/**
 * Debug dos estilos carregados (só pra admin)
 */
function ibram_debug_estilos() {
    if (!current_user_can('administrator')) return;
    
    global $wp_styles;
    echo "<!-- ESTILOS CARREGADOS: \n";
    foreach($wp_styles->queue as $handle) {
        echo "$handle\n";
    }
    echo "-->";
}
add_action('wp_head', 'ibram_debug_estilos', 999);