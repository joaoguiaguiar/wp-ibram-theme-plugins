<?php

// Função para gerar o CSS personalizado
function mi_customizer_css() {
    if (is_admin() && !is_customize_preview()) {
        return;
    }

    $menu_bg_color = get_theme_mod('mi_menu_bg_color', '#121212');
    $menu_text_color = get_theme_mod('mi_menu_text_color', '#FFFFFF');
    $nav_text_color = get_theme_mod('mi_nav_text_color', '#FFFFFF');
    $submenu_title_color = get_theme_mod('mi_submenu_title_color', '#FFFFFF');
    $submenu_text_color = get_theme_mod('mi_submenu_text_color', '#FFFFFF');
    ?>
    <style type="text/css">
        /* 1. Fundo */
        .menu-personalizado,
        .menu-2,
        .menu-mobile {
            background-color: <?php echo esc_attr($menu_bg_color); ?> !important;
        }

        /* 2. Texto geral */
        .p__menu, 
        .titulo__menu, 
        .p__menuMobile,
        .material-symbols-outlined,
        .menu-hamburguer {
            color: <?php echo esc_attr($menu_text_color); ?> !important;
        }

        /* 3. Links navegação */
        .menu__items a {
            color: <?php echo esc_attr($nav_text_color); ?> !important;
        }

        /* 4. Títulos submenu */
        .item__menu h5,
        .item__menuMobile h5 {
            color: <?php echo esc_attr($submenu_title_color); ?> !important;
        }

        /* 5. Texto submenu */
        .link__menu {
            color: <?php echo esc_attr($submenu_text_color); ?> !important;
        }

        /* 6. Hover geral */
        .menu__items a:hover,
        .link__menu:hover {
            color: <?php echo esc_attr($menu_hover_color); ?> !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'mi_customizer_css', 999);



// CSS dinâmico para o Customizer (apenas na pré-visualização)
function mi_customizer_dynamic_css() {
    if (!is_customize_preview()) {
        return;
    }
    ?>
    <style id="mi-dynamic-customizer-css"></style>
    <script>
    (function($) {
        $(function() {
            var $style = $('#mi-dynamic-customizer-css');

            function updateCSS() {
                var css = '';

                var menuBgColor = wp.customize('mi_menu_bg_color')();
                if (menuBgColor) {
                    css += '.menu-personalizado, .menu-2, .menu-mobile { background-color: ' + menuBgColor + ' !important; }';
                }

                var menuTextColor = wp.customize('mi_menu_text_color')();
                if (menuTextColor) {
                    css += '.p__menu, .titulo__menu, .p__menuMobile, .material-symbols-outlined, .menu-hamburguer { color: ' + menuTextColor + ' !important; }';
                }

                var navTextColor = wp.customize('mi_nav_text_color')();
                if (navTextColor) {
                    css += '.menu__items a { color: ' + navTextColor + ' !important; }';
                }

                var submenuTitleColor = wp.customize('mi_submenu_title_color')();
                if (submenuTitleColor) {
                    css += '.item__menu h5, .item__menuMobile h5 { color: ' + submenuTitleColor + ' !important; }';
                }

                var submenuTextColor = wp.customize('mi_submenu_text_color')();
                if (submenuTextColor) {
                    css += '.link__menu { color: ' + submenuTextColor + ' !important; }';
                }

                $style.text(css);
            }

            updateCSS();

            wp.customize('mi_menu_bg_color', function(value) { value.bind(updateCSS); });
            wp.customize('mi_menu_text_color', function(value) { value.bind(updateCSS); });
            wp.customize('mi_nav_text_color', function(value) { value.bind(updateCSS); });
            wp.customize('mi_submenu_title_color', function(value) { value.bind(updateCSS); });
            wp.customize('mi_submenu_text_color', function(value) { value.bind(updateCSS); });
        });
    })(jQuery);
    </script>
    <?php
}
add_action('wp_footer', 'mi_customizer_dynamic_css', 999);

