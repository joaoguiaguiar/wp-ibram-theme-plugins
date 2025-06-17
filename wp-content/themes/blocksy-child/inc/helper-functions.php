<?php
// Função para criar arquivos CSS default se não existirem
function mi_check_css_files() {
    $css_dir = get_stylesheet_directory() . '/css';
    if (!file_exists($css_dir)) {
        wp_mkdir_p($css_dir);
    }
    $css_files = array(
        'menu.css' => '/* Estilos para o menu principal */',
    );
    foreach ($css_files as $file => $default_content) {
        $file_path = $css_dir . '/' . $file;
        if (!file_exists($file_path)) {
            file_put_contents($file_path, $default_content);
        }
    }
}
add_action('after_switch_theme', 'mi_check_css_files');
add_action('init', 'mi_check_css_files');


// Funções de cache e customizer
function mi_customizer_save_after($wp_customize) {
    set_transient('mi_customizer_updated', time(), DAY_IN_SECONDS);
}
add_action('customize_save_after', 'mi_customizer_save_after');

function mi_clear_theme_cache() {
    delete_transient('mi_customizer_updated');
    set_transient('mi_customizer_updated', time(), HOUR_IN_SECONDS);
}
add_action('after_switch_theme', 'mi_clear_theme_cache');
add_action('customize_save_after', 'mi_clear_theme_cache');

function mi_add_version_to_stylesheet() {
    $version = get_transient('mi_customizer_updated') ? get_transient('mi_customizer_updated') : wp_get_theme()->get('Version');
    return $version;
}
add_filter('stylesheet_version', 'mi_add_version_to_stylesheet');

function mi_debug_enqueued_scripts() {
    if (is_customize_preview()) {
        echo '<script>console.log("Customizer preview está ativo");</script>';
    }
}
add_action('wp_head', 'mi_debug_enqueued_scripts');