<?php
// MENU 2: Exibir em páginas internas (exceto na home)
if (!function_exists('menu_personalizado_interno')) {
    add_action('blocksy:header:after', 'menu_personalizado_interno');
    function menu_personalizado_interno() {
        if (is_front_page()) return; // não mostrar na home

        if (is_page() || is_single() || is_category()) {
            ?>
            <section class="menu-personalizado menu-2" id="menu-2">
                <div class="GRID">
                    <div class="containner__p">
                        <p class="p__menu" style="font-size: 1rem;">Instituto Brasileiro de Museus</p>
                        <h3>
                            <a href="<?php echo home_url('/'); ?>" class="titulo__menu" style="text-decoration: none;">
                                Museus Castro Maya 
                            </a>
                        </h3>
                    </div>

                    <div class="menu-and-search-menu2">
                        <svg onclick="toggleMenu()" xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" style="cursor:pointer; display:inline-block; color: white;">
                            <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>

                        <nav class="menu__items">
                            <?php
                            $menu_items = wp_get_nav_menu_items('menu-principal');
                            if ($menu_items) {
                                $menu_nav = array_slice($menu_items, 0, 8);
                                foreach ($menu_nav as $item) {
                                    echo '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
                                }
                            }
                            ?>
                        </nav>

                        <div class="container__lista">
                            <div class="containerflex">
                                <?php 
                                if (is_active_sidebar('main-menu-sidebar')) {
                                    dynamic_sidebar('main-menu-sidebar'); 
                                } else {
                                    echo '<ul class="lista_item_menu" style="display:flex; justify-content: space-evenly">';
                                    echo '<li class="item__menu"><h5>Menu</h5>';
                                    echo '<p>Adicione o widget "Menu Lista" na área de widgets do menu principal.</p>';
                                    echo '</li></ul>';
                                }
                                ?>    
                            </div>
                        </div>

                        <div class="container__input">
                            <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }
}