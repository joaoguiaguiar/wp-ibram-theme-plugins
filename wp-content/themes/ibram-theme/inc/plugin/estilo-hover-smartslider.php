<?php
function estilo_hover_smartslider() {
    echo "<style>
        .n2-ow.n2-font-e129a8c8af82a9c52ce966752db00e29-hover:hover {
            color: #ffe6c2 !important;
            transition: color 0.3s ease;
        }
    </style>";
}
add_action('wp_head', 'estilo_hover_smartslider');
