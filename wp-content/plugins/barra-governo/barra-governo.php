<?php
/*
Plugin Name: Barra do Governo
Author: João Aguiar
Author URI: https://github.com/joaoguiaguiar
Description: Ao ativar o plugin, a Barra do Governo Federal é automaticamente exibida no topo do site, independentemente do tema utilizado, garantindo visibilidade e funcionamento contínuo.
Version: 1.0
*/

if (!defined('ABSPATH')) {
    exit;
}

function adicionar_barra_governo() {
    echo '<div id="barra-brasil"></div>';
    echo '<script defer src="https://barra.brasil.gov.br/barra_2.0.js"></script>';
}
add_action('wp_body_open', 'adicionar_barra_governo');

function estilo_barra_governo() {
    echo '<style>
        #barra-brasil {
            position: relative;
            z-index: 1000;
            display: block;
        }
        body {
            overflow-x: hidden;
        }
    </style>';
}
add_action('wp_head', 'estilo_barra_governo');