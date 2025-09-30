<?php
/**
 * Widgets do Menu - Tema IBRAM
 */

// Segurança
if (!defined('ABSPATH')) exit;


/**
 * Registra a sidebar do menu principal
 */
function ibram_registrar_sidebar_menu() {
    register_sidebar(array(
        'name'          => 'Menu Lista Categorias',
        'id'            => 'main-menu-sidebar',
        'description'   => 'Adicione o widget de Navegação aqui para exibir o menu principal',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'ibram_registrar_sidebar_menu', 5); 

/**
 * Conteúdo alternativo para o widget de menu
 */
function ibram_conteudo_widget_menu() {
    ob_start();
    if (is_active_sidebar('main-menu-sidebar')) {
        dynamic_sidebar('main-menu-sidebar');
    } else {
        echo '<ul class="lista_item_menu" style="display:flex; justify-content: space-evenly">';
        echo '<li class="item__menu"><h5>Menu</h5>';
        echo '<p>Adicione o widget "Menu Lista" na área de widgets do menu principal.</p>';
        echo '</li></ul>';
    }
    return ob_get_clean();
}