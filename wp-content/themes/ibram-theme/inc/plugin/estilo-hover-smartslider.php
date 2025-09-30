<?php
/**
 * Customização de hover no SmartSlider
 * 
 * Adiciona efeitos de hover customizados para elementos do SmartSlider3
 * 
 * @package IBRAM_Theme
 * @since   1.0.0
 */

// Segurança: não deixa acessar direto
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Adiciona estilos de hover customizados para o SmartSlider3
 * 
 * @return void
 */
function ibram_smartslider_estilos_hover() {
    echo "<style>
        .n2-ow.n2-font-e129a8c8af82a9c52ce966752db00e29-hover:hover {
            color: #ffe6c2 !important;
            transition: color 0.3s ease;
        }
    </style>";
}
add_action('wp_head', 'ibram_smartslider_estilos_hover');