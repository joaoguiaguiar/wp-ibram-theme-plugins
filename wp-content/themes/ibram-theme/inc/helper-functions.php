<?php
/**
 * Funções auxiliares - Tema IBRAM
 */

// Segurança: não deixa acessar direto
if (!defined('ABSPATH')) exit;

/**
 * Cria arquivos CSS padrão se não existirem
 */
function ibram_criar_arquivos_css_padrao() {
    $css_dir = get_stylesheet_directory() . '/css';
    
    // Cria diretório se não existir
    if (!file_exists($css_dir)) {
        wp_mkdir_p($css_dir);
    }
    
    // Só cria o menu.css se não existir
    $css_file = $css_dir . '/menu.css';
    if (!file_exists($css_file)) {
        file_put_contents($css_file, '/* Estilos do menu - Tema IBRAM */');
    }
}
add_action('after_switch_theme', 'ibram_criar_arquivos_css_padrao');

/**
 * Limpa cache do tema quando salva customização
 */
function ibram_limpar_cache_customizer($wp_customize) {
    delete_transient('ibram_customizer_updated');
    set_transient('ibram_customizer_updated', time(), HOUR_IN_SECONDS);
}
add_action('customize_save_after', 'ibram_limpar_cache_customizer');

/**
 * Limpa cache ao ativar o tema
 */
function ibram_limpar_cache_ativacao() {
    delete_transient('ibram_customizer_updated');
    set_transient('ibram_customizer_updated', time(), HOUR_IN_SECONDS);
}
add_action('after_switch_theme', 'ibram_limpar_cache_ativacao');

/**
 * Versão dinâmica pra quebrar cache
 */
function ibram_versao_dinamica_stylesheet() {
    $versao_cache = get_transient('ibram_customizer_updated');
    return $versao_cache ? (string) $versao_cache : wp_get_theme()->get('Version');
}
add_filter('stylesheet_version', 'ibram_versao_dinamica_stylesheet');

/**
 * Debug só no modo desenvolvimento (versão profissional)
 */
function ibram_debug_scripts() {
    // SÓ EM DESENVOLVIMENTO MESMO
    if (!defined('WP_DEBUG') || !WP_DEBUG || !is_customize_preview()) {
        return;
    }
    
    // MELHOR: wp_add_inline_script em vez de echo
    wp_add_inline_script('jquery', 'console.log("Customizer ativo - Tema IBRAM");');
}
add_action('wp_enqueue_scripts', 'ibram_debug_scripts');