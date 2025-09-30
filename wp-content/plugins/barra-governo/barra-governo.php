<?php
/*
Plugin Name: Barra do Governo - IBRAM
Plugin URI: https://github.com/joaoguiaguiar/plugin-gov-oficial
Description: Coloca a Barra do Governo Federal no topo do site automaticamente
Version: 1.0.0
Author: CTINF / joao.aguiar
Author URI: https://github.com/joaoguiaguiar
Text Domain: ibram-barra-governo
License: GPL v2 or later
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