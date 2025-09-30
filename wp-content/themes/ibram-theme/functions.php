<?php
/**
 * Tema IBRAM - Functions
 */

// Segurança
if (!defined('ABSPATH')) exit;

// Versão do tema
define('IBRAM_THEME_VERSION', '1.0.5');
define('IBRAM_THEME_PATH', get_stylesheet_directory());
define('IBRAM_THEME_URL', get_stylesheet_directory_uri());

/**
 * Cria pasta languages se não existir
 */
function ibram_criar_pasta_languages() {
    $languages_dir = IBRAM_THEME_PATH . '/languages';
    if (!file_exists($languages_dir)) {
        wp_mkdir_p($languages_dir);
    }
    
    // Cria arquivo .pot vazio se não existir
    $pot_file = $languages_dir . '/ibram-theme.pot';
    if (!file_exists($pot_file)) {
        file_put_contents($pot_file, 
            "# Copyright (C) 2024 IBRAM\n" .
            "msgid \"\"\n" .
            "msgstr \"\"\n" .
            "\"Content-Type: text/plain; charset=UTF-8\\n\"\n" .
            "\"Plural-Forms: nplurals=2; plural=n > 1;\\n\"\n"
        );
    }
}
add_action('after_switch_theme', 'ibram_criar_pasta_languages');

/**
 * Carrega traduções
 */
function ibram_carregar_traducoes() {
    load_child_theme_textdomain('ibram-theme', IBRAM_THEME_PATH . '/languages');
}
add_action('after_setup_theme', 'ibram_carregar_traducoes');

// Remove conflitos do tema pai
remove_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');
remove_action('wp_enqueue_scripts', 'enqueue_bootstrap', 30);
remove_action('wp_enqueue_scripts', 'enqueue_custom_js', 40);

/**
 * Carrega includes do tema
 */
function ibram_carregar_includes() {
    $arquivos = array(
        '/inc/customizer/customizer.php',
        '/inc/menus/menus.php',
        '/inc/menus/menu-home.php', 
        '/inc/menus/menu-interno.php',
        '/inc/plugin/overlay-postx.php',
        '/inc/plugin/estilo-hover-smartslider.php',
        '/inc/widget/menu-widget.php',
		'/inc/widget/simple-menu-widget.php',
        '/inc/scripts-styles.php',
        '/inc/helper-functions.php',
    );
    
    foreach ($arquivos as $arquivo) {
        if (file_exists(IBRAM_THEME_PATH . $arquivo)) {
            require_once IBRAM_THEME_PATH . $arquivo;
        }
    }
}
add_action('after_setup_theme', 'ibram_carregar_includes');

/**
 * Categorias de menu
 */
function ibram_pegar_categorias_menu() {
    return array(
        'menu-o-museu'          => 'O Museu',
        'menu-divisao-tecnica'  => 'Divisão Técnica', 
        'menu-complexo-palacio' => 'Complexo Palácio Imperial',
        'menu-atracoes'         => 'Atrações',
        'menu-servicos'         => 'Serviços Online',
        'menu-comunicacao'      => 'Comunicação',
    );
}

/**
 * Renderiza menu de categoria
 */
function ibram_renderizar_menu_categoria($localizacao, $titulo, $classe_item = 'item__menu') {
    if (!has_nav_menu($localizacao)) return '';
    
    ob_start();
    ?>
    <li class="<?php echo esc_attr($classe_item); ?>">
        <h5><?php echo esc_html($titulo); ?></h5>
        <?php
        wp_nav_menu(array(
            'theme_location' => $localizacao,
            'container' => false,
            'items_wrap' => '%3$s',
            'fallback_cb' => false,
            'walker' => new IBRAM_Submenu_Walker()
        ));
        ?>
    </li>
    <?php
    return ob_get_clean();
}

/**
 * Pega URL da home
 */
function ibram_pegar_url_home() {
    return esc_url(home_url('/'));
}