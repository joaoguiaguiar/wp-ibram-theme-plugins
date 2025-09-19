<?php
// Registrar Customizer APENAS para cor de fundo
function mi_customize_register($wp_customize) {
    // Seção para o menu
    $wp_customize->add_section('mi_menu_options', array(
        'title'    => __('Menu Personalizado', 'blocksy-child'),
        'priority' => 30,
    ));

    // APENAS cor de fundo do menu - SEM postMessage, vai RECARREGAR a página
    $wp_customize->add_setting('mi_menu_bg_color', array(
        'default'   => '#121212',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh', // MUDOU AQUI - VAI RECARREGAR TUDO
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mi_menu_bg_color', array(
        'label'    => __('Cor de Fundo do Menu', 'blocksy-child'),
        'section'  => 'mi_menu_options',
        'settings' => 'mi_menu_bg_color',
    )));
}
add_action('customize_register', 'mi_customize_register');

// CSS para a cor de fundo
function mi_generate_menu_css() {
    $bg_color = get_theme_mod('mi_menu_bg_color', '#121212');
    ?>
    <style id="mi-menu-bg-css">
        .menu-personalizado,
        .menu-2,
        .menu-mobile {
            background-color: <?php echo esc_attr($bg_color); ?> !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'mi_generate_menu_css');
?>