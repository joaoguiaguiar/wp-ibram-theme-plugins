<?php
/**
 * Menus personalizados - Tema IBRAM
 */

// Segurança
if (!defined('ABSPATH')) exit;

/**
 * Registra áreas de menu do site
 */
function ibram_registrar_menus() {
    register_nav_menus(array(
        'menu-principal' => 'Menu Principal',
    ));
}
add_action('init', 'ibram_registrar_menus');

/**
 * Walker para menu principal (sem submenus)
 */
class IBRAM_Main_Menu_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
    }

    function start_lvl(&$output, $depth = 0, $args = null) {
        // Vazio - não cria sub-listas
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        // Vazio - não cria sub-listas
    }
}

/**
 * Walker para menu lista (com categorias e itens)
 */
class IBRAM_Menu_Lista_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // Não cria sub-listas
    }
    
    function end_lvl(&$output, $depth = 0, $args = null) {
        // Não faz nada
    }
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if ($depth === 0) {
            // Item de topo (categoria)
            $output .= '<li class="item__menu">';
            $output .= '<h5>' . esc_html($item->title) . '</h5>';
        } else {
            // Subitem
            $output .= '<p><a href="' . esc_url($item->url) . '" class="link__menu">' . 
                esc_html($item->title) . '</a></p>';
        }
    }
    
    function end_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if ($depth === 0) {
            $output .= '</li>';
        }
    }
}