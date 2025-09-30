<?php
/**
 * Widget Menu Lista - Tema IBRAM
 */

// Segurança
if (!defined('ABSPATH')) exit;

/**
 * Widget para exibir menus WordPress com estrutura personalizada
 */
class IBRAM_Menu_Lista_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'ibram_menu_lista_widget',
            'Menu Lista IBRAM',
            array('description' => 'Exibe menu WordPress em estrutura personalizada')
        );
    }

    /**
     * Exibe o widget no frontend
     */
    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : ''; 
        $nav_menu_id = !empty($instance['nav_menu']) ? (int) $instance['nav_menu'] : 0;

        echo $args['before_widget'];

        // Título do widget
        if (!empty($title)) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        // Menu selecionado
        if ($nav_menu_id > 0) {
            $menu_items = wp_get_nav_menu_items($nav_menu_id);
            
            if ($menu_items) {
                echo '<ul class="lista_item_menu" style="display:flex; justify-content: space-evenly">';
                
                $itens_pai = array();
                $itens_filhos = array();
                
                // Separa itens pai e filhos
                foreach ($menu_items as $item) {
                    if ($item->menu_item_parent == 0) {
                        $itens_pai[$item->ID] = $item;
                    } else {
                        if (!isset($itens_filhos[$item->menu_item_parent])) {
                            $itens_filhos[$item->menu_item_parent] = array();
                        }
                        $itens_filhos[$item->menu_item_parent][] = $item;
                    }
                }
                
                // Exibe os itens
                foreach ($itens_pai as $pai) {
                    echo '<li class="item__menu">';
                    echo '<h5>' . esc_html($pai->title) . '</h5>';
                    
                    // Tem filhos? Exibe eles. Não tem? Exibe o pai como link
                    if (isset($itens_filhos[$pai->ID])) {
                        foreach ($itens_filhos[$pai->ID] as $filho) {
                            echo '<p><a href="' . esc_url($filho->url) . '" class="link__menu">' . 
                                esc_html($filho->title) . '</a></p>';
                        }
                    } else {
                        echo '<p><a href="' . esc_url($pai->url) . '" class="link__menu">' . 
                            esc_html($pai->title) . '</a></p>';
                    }
                    
                    echo '</li>';
                }
                
                echo '</ul>';
            } else {
                echo '<p>Este menu não contém itens.</p>';
            }
        } else {
            echo '<p>Selecione um menu nas configurações do widget.</p>';
        }

        echo $args['after_widget'];
    }

    /**
     * Formulário de configuração do widget
     */
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $nav_menu = isset($instance['nav_menu']) ? $instance['nav_menu'] : '';
        
        $menus = wp_get_nav_menus();
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Título:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                   type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>">Selecione o Menu:</label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>" 
                    name="<?php echo esc_attr($this->get_field_name('nav_menu')); ?>">
                <option value="0">— Selecione —</option>
                <?php foreach ($menus as $menu): ?>
                    <option value="<?php echo esc_attr($menu->term_id); ?>" <?php selected($nav_menu, $menu->term_id); ?>>
                        <?php echo esc_html($menu->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }

    /**
     * Atualiza as configurações do widget
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['nav_menu'] = (!empty($new_instance['nav_menu'])) ? (int) $new_instance['nav_menu'] : 0;
        
        return $instance;
    }
}

/**
 * Registra o widget
 */
function ibram_registrar_widget_menu_lista() {
    register_widget('IBRAM_Menu_Lista_Widget');
}
add_action('widgets_init', 'ibram_registrar_widget_menu_lista', 10); 