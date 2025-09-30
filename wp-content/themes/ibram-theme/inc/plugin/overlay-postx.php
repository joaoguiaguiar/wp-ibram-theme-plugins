<?php
/**
 * Customização de overlay para PostX
 * 
 * @package IBRAM_Theme
 * @since   1.0.0
 */

// Segurança
if (!defined('ABSPATH')) exit;

/**
 * Adiciona overlay customizado para PostX
 */
function ibram_postx_overlay() {
    echo "<style>
    .ultp-block-image .ultp-block-title a {
        color: white !important;
        text-decoration: none;
    }
    .ultp-block-image .ultp-block-title a:hover,
    .ultp-block-image .ultp-block-title a:visited,
    .ultp-block-image .ultp-block-title a:focus {
        color: white !important;
    }
    </style>";
    
    echo "<script>
    jQuery(document).ready(function($) {
        $('.ultp-block-item').each(function() {
            var \$item = $(this);
            var \$imageContainer = \$item.find('.ultp-block-image');
            var \$title = \$item.find('.ultp-block-title');
            var \$link = \$title.find('.ultp-component-simple, a');
            
            if (\$imageContainer.length && \$title.length) {
                \$imageContainer.css('position', 'relative');
                \$title.appendTo(\$imageContainer);
                
                \$title.css({
                    'position': 'absolute', 'bottom': '10px', 'left': '10px',
                    'padding': '0.5rem', 'z-index': '10', 'max-width': '90%',
                    'background': 'transparent', 'text-decoration': 'none',
                    'transition': 'all 0.3s ease'
                });
                
                \$link.css({'color': 'white !important', 'text-decoration': 'none'});
                
                \$title.hover(
                    function () { $(this).css('border-bottom', '1px solid white'); },
                    function () { $(this).css('border-bottom', '1px solid transparent'); }
                );
            }
        });
    });
    </script>";
}
add_action('wp_footer', 'ibram_postx_overlay');