<?php
/**
 * Customizer do Tema IBRAM - Apenas cor de fundo do menu
 */

// Segurança
if (!defined('ABSPATH')) exit;

/**
 * Registra as opções no Customizer
 */
function ibram_customizer_menu($wp_customize) {
    // Seção pro menu
    $wp_customize->add_section('ibram_menu_options', array(
        'title'    => 'Menu Personalizado IBRAM',
        'priority' => 30,
    ));

    // Só a cor de fundo do menu - recarrega a página
    $wp_customize->add_setting('ibram_menu_bg_color', array(
        'default'   => '#121212',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh', // Recarrega tudo
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ibram_menu_bg_color', array(
        'label'    => 'Cor de Fundo do Menu',
        'section'  => 'ibram_menu_options',
        'settings' => 'ibram_menu_bg_color',
    )));
}
add_action('customize_register', 'ibram_customizer_menu');

/**
 * Gera o CSS da cor de fundo
 */
function ibram_gerar_css_menu() {
    $bg_color = get_theme_mod('ibram_menu_bg_color', '#121212');
    ?>
    <style id="ibram-menu-bg-css">
        .menu-personalizado,
        .menu-2,
        .menu-mobile {
            background-color: <?php echo esc_attr($bg_color); ?> !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'ibram_gerar_css_menu');