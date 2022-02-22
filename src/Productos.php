<?php

namespace SELLERCONTROL;

class Productos
{

    public function __construct()
    {
    }

    public static function ViewTablaProductos()
    {
        $redirect_login = get_permalink();
        $redirect_logout = get_permalink();
        $usuarios = new Users;
        // Get products.

        if ($usuarios->is_asociado() || $usuarios->is_admin()) {
            $current_user = wp_get_current_user();
            $url_logout = wp_logout_url($redirect_logout);

            $str = get_avatar($current_user->user_email, 24) . ' ';
            $str .= 'Hola ' . $current_user->display_name . '<br>';
            $str .= '<a href="' . $url_logout . '">Desconectarse</a>';

            echo $str;
            ob_start();

?>
            <h2>Tabla de Productos</h2>
            <table id="data_productos" width="100%"></table>

            <!-- Modal -->
            <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModallLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
            </div>

<?php

            return ob_get_clean();
        } else {
            echo 'No estas autorizado. Tienes que ser administrador para entrar.';

            if (!is_user_logged_in()) :
                $args = array(
                    'echo'            => false,
                    'redirect'        => $redirect_login,
                );
                return wp_login_form($args);
            else :
                $current_user = wp_get_current_user();
                $url_logout = wp_logout_url($redirect_logout);

                $str = get_avatar($current_user->user_email, 24) . ' ';
                $str .= 'Hola ' . $current_user->display_name . '<br>';
                $str .= '<a href="' . $url_logout . '">Desconectarse</a>';

                return $str;
            endif;
        }
    }

    public static function obtenerDatosProductos()
    {
        $args = array(
            'status' => 'publish',
            'limit' => 1000,
        );
        $products = wc_get_products($args);

        //echo $products[5];

        $dataSet = array();

        foreach ($products as $producto) {
            $amazon_category = get_post_meta($producto->id, '_amazon_category', true);
            $mercadolibre_category_code    = get_post_meta($producto->id, '_mercadolibre_category_code', true);
            $mercadolibre_category_name    = get_post_meta($producto->id, '_mercadolibre_category_name', true);
            $claroshop_category_code = get_post_meta($producto->id, '_claroshop_category_code', true);
            $a = array(
                "id" => [
                    "link" => esc_textarea($producto->id),
                    "ASIN" => esc_textarea($producto->sku)
                ],
                "name" => esc_textarea($producto->name),
                "amz_cat" => esc_attr($amazon_category),
                "ml_cat_name" => esc_attr($mercadolibre_category_name),
                "ml_cat_code" => esc_attr($mercadolibre_category_code),
                "claro_cat" => esc_attr($claroshop_category_code)
            );
            array_push($dataSet, $a);
        }

        //echo implode(" ", $dataSet[5]);

        wp_register_script('datatables_productos', plugins_url('/assets/js/datatables_productos.js', dirname(__FILE__)), array('jquery'), '1', true);
        wp_enqueue_script('datatables_productos');

        wp_localize_script('datatables_productos', 'dataSet', $dataSet);

        wp_register_script('custom-script', plugins_url( '/assets/js/ajax_producto.js', dirname(__FILE__)), array('jquery'), false, true);
        // Localize the script with new data
        $script_data_array = array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce('view_post'),
        );
        wp_localize_script('custom-script', 'blog', $script_data_array);
        wp_enqueue_script('custom-script');
    }

    function load_post_by_ajax_callback() {
        check_ajax_referer('view_post', 'security');
        $args = array(
            'post_type' => 'post',
            'p' => $_POST['id'],
        );
         
        $posts = new WP_Query( $args );
         
        $arr_response = array();
        if ($posts->have_posts()) {
             
            while($posts->have_posts()) {
                 
                $posts->the_post();
                 
                $arr_response = array(
                    'title' => get_the_title(),
                    'content' => get_the_content(),
                );
            }
            wp_reset_postdata();
        }
         
        echo json_encode($arr_response);
         
        wp_die();
    }
}
