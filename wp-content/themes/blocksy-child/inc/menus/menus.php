<?php


// Registrar áreas de menu para o site
function mi_register_menus() {
    register_nav_menus(array(
        'menu-principal' => __('Menu Principal', 'blocksy-child'),
    
    ));
}
add_action('init', 'mi_register_menus');

// Walkers personalizados para os menus
class MI_Main_Menu_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
    }

    function start_lvl(&$output, $depth = 0, $args = null) {
        // Vazio para não criar sub-listas
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        // Vazio para não criar sub-listas
    }
}

class MI_Menu_Lista_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // Não faz nada para evitar a criação de sub-listas
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
