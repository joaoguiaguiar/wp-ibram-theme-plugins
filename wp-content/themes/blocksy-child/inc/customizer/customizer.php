<?php

// Registrar as opções do Customizador
function mi_customize_register($wp_customize) {
    $wp_customize->add_section('mi_menu_options', array(
        'title'    => __('Opções do Menu Personalizado', 'blocksy-child'),
        'priority' => 120,
    ));

    // 1. Cor de fundo do menu
    $wp_customize->add_setting('mi_menu_bg_color', array(
        'default'           => '#121212',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mi_menu_bg_color', array(
        'label'    => __('Cor de Fundo do Menu', 'blocksy-child'),
        'section'  => 'mi_menu_options',
        'settings' => 'mi_menu_bg_color',
    )));

    // 2. Cor do texto geral do menu
    $wp_customize->add_setting('mi_menu_text_color', array(
        'default'           => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mi_menu_text_color', array(
        'label'    => __('Cor do Texto do Menu (Geral)', 'blocksy-child'),
        'section'  => 'mi_menu_options',
        'settings' => 'mi_menu_text_color',
    )));

    // 3. Cor do texto dos links de navegação
    $wp_customize->add_setting('mi_nav_text_color', array(
        'default'           => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mi_nav_text_color', array(
        'label'    => __('Cor do Texto do Menu de Navegação', 'blocksy-child'),
        'section'  => 'mi_menu_options',
        'settings' => 'mi_nav_text_color',
    )));

    // 4. Cor dos títulos do submenu
    $wp_customize->add_setting('mi_submenu_title_color', array(
        'default'           => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mi_submenu_title_color', array(
        'label'    => __('Cor dos Títulos do Submenu', 'blocksy-child'),
        'section'  => 'mi_menu_options',
        'settings' => 'mi_submenu_title_color',
    )));

    // 5. Cor dos links do submenu
    $wp_customize->add_setting('mi_submenu_text_color', array(
        'default'           => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mi_submenu_text_color', array(
        'label'    => __('Cor do Texto dos Links do Submenu', 'blocksy-child'),
        'section'  => 'mi_menu_options',
        'settings' => 'mi_submenu_text_color',
    )));

  
}
add_action('customize_register', 'mi_customize_register');