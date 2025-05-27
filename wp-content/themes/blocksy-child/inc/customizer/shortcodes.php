<?php
// Shortcode para exibir o carrossel
function menu_categories_carousel_shortcode() {
    return get_menu_categories_carousel();
}
add_shortcode('menu_categories_carousel', 'menu_categories_carousel_shortcode');
