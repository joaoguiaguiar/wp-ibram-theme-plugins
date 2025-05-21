<?php
// Remove o widget antigo "Menu Lista"
function remove_menu_lista_widget_completely() {
    unregister_widget('Menu_Lista_Widget');
}
add_action('widgets_init', 'remove_menu_lista_widget_completely', 99);

// Registra a sidebar do menu principal
function register_main_menu_sidebar() {
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
add_action('widgets_init', 'register_main_menu_sidebar');

// Substitui a renderização padrão dos itens do menu principal
function custom_menu_widget_style($items, $args) {
    if (isset($args->theme_location) && $args->theme_location == 'main-menu') {
        $items = '<ul class="lista_item_menu" style="display: flex; justify-content: space-evenly; list-style: none; padding: 0;">';
        foreach ($items as $item) {
            $items .= '<li>' . $item . '</li>';
        }
        $items .= '</ul>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'custom_menu_widget_style', 10, 2);

// Conteúdo alternativo para o widget de menu
function mi_get_menu_widget_content() {
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
