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
            <form action="<?php get_the_permalink();?>" method="post" id="form_productos">
            <?php wp_nonce_field('graba_warehouse', 'warehouse_nonce'); ?>
            <h2>Tabla de Productos</h2>
            <div class="row">
            <div class="d-grid gap-2 col-sm-10 col-md-3">
            <input type="submit" value="Guardar Cambios">
            </div>
            </div>
            <div class="row">
            <div class="table-responsive">
                <table id="data_productos" width="100%" class="table"></table>
            </div>
            </div>
            </form>

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
            'limit' => 5000,
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $products = wc_get_products($args);

        //echo $products[5];

        $dataSet = array();

        foreach ($products as $producto) {
            $values			= get_post_custom($producto->id);
            $check        	= isset($values['_in_warehouse']) ? esc_attr($values['_in_warehouse'][0]) : '';
            $in_mercadolibre = isset($values['_in_mercadolibre']) ? esc_attr($values['_in_mercadolibre'][0]) : '';
            $in_claroshop = isset($values['_in_claroshop']) ? esc_attr($values['_in_claroshop'][0]) : '';
            $amazon_category = get_post_meta($producto->id, '_amazon_category', true);
            $mercadolibre_category_code    = get_post_meta($producto->id, '_mercadolibre_category_code', true);
            $mercadolibre_category_name    = get_post_meta($producto->id, '_mercadolibre_category_name', true);
            $claroshop_category_code = get_post_meta($producto->id, '_claroshop_category_code', true);
            $ean = get_post_meta($producto->id, '_ean', true);
            $edit = get_home_url().'/wp-admin/post.php?post='.esc_textarea($producto->id).'&action=edit';
            $personaje      = $values['_personaje'][0];
            $tipo           = $values['_tipo'][0];
            $escala         = $values['_escala'][0];
            $a = array(
                "id" => [
                    "link" => esc_textarea($producto->id),
                    "ASIN" => esc_textarea($producto->sku),
                    "img" => wp_get_attachment_image_src( get_post_thumbnail_id( $producto->id), 'full')[0],
                    "ean" => esc_attr($ean),
                    "amz_cat" => esc_attr($amazon_category),
                    "editar" => $edit,
                    "personaje" => esc_attr($personaje),
                    "escala" => esc_attr($escala),
                    "tipo" => $tipo,
                ],
                "name" => esc_textarea($producto->name),
                "ml_cat_name" => esc_attr($mercadolibre_category_name),
                "ml_cat_code" => esc_attr($mercadolibre_category_code),
                "claro_cat" => esc_attr($claroshop_category_code),
                "in_warehouse" => esc_attr($check),
                "in_mercadolibre" => esc_attr($in_mercadolibre),
                "in_claroshop" => esc_attr($in_claroshop),
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

    public static function guardarCambiosProductos()
    {
        foreach ($_REQUEST as $clave => $valor) {
            //echo "{$clave} => {$valor} ";
            if(str_contains($clave, 'asin')){
                //echo "{$clave} => {$valor} ";
                if(array_key_exists('in_warehouse_'.$valor, $_REQUEST)){
                    
                    update_post_meta($valor, '_in_warehouse', 'on');
                }else{
                    
                    update_post_meta($valor, '_in_warehouse', 'off');
                }

                if(array_key_exists('in_mercadolibre_'.$valor, $_REQUEST)){
                    
                    update_post_meta($valor, '_in_mercadolibre', 'on');
                }else{
                    
                    update_post_meta($valor, '_in_mercadolibre', 'off');
                }

                if(array_key_exists('in_claroshop_'.$valor, $_REQUEST)){
                    
                    update_post_meta($valor, '_in_claroshop', 'on');
                }else{
                    
                    update_post_meta($valor, '_in_claroshop', 'off');
                }
            }
            
            if(str_contains($clave, 'ean')){//Doc Esta función busca enla clave si contiene la palabra ean
                //echo "{$clave} => {$valor} ";
                $idPost = str_replace("ean_", "", $clave);//Doc Extrae la clave para quedarse con el ID del post
                if (array_key_exists('ean_'.$idPost, $_REQUEST)) {
                    update_post_meta(
                        $idPost,
                        '_ean',
                        $valor
                    );
                }
            }

            if(str_contains($clave, 'ml_cat_name_')){
                //echo "{$clave} => {$valor} ";
                $idPost = str_replace("ml_cat_name_", "", $clave);
                if (array_key_exists('ml_cat_name_'.$idPost, $_REQUEST)) {
                    update_post_meta(
                        $idPost,
                        '_mercadolibre_category_name',
                        $valor
                    );
                }
            }

            if(str_contains($clave, 'ml_cat_code_')){
                //echo "{$clave} => {$valor} ";
                $idPost = str_replace("ml_cat_code_", "", $clave);
                if (array_key_exists('ml_cat_code_'.$idPost, $_REQUEST)) {
                    update_post_meta(
                        $idPost,
                        '_mercadolibre_category_code',
                        $valor
                    );
                }
            }

            if(str_contains($clave, 'claro_cat_')){
                //echo "{$clave} => {$valor} ";
                $idPost = str_replace("claro_cat_", "", $clave);
                if (array_key_exists('claro_cat_'.$idPost, $_REQUEST)) {
                    update_post_meta(
                        $idPost,
                        '_claroshop_category_code',
                        $valor
                    );
                }
            }

            if(str_contains($clave, 'personaje_')){
                //echo "{$clave} => {$valor} ";
                $idPost = str_replace("personaje_", "", $clave);
                if (array_key_exists('personaje_'.$idPost, $_REQUEST)) {
                    update_post_meta(
                        $idPost,
                        '_personaje',
                        $valor
                    );
                }
            }

            if(str_contains($clave, 'tipo_')){
                //echo "{$clave} => {$valor} ";
                $idPost = str_replace("tipo_", "", $clave);
                if (array_key_exists('tipo_'.$idPost, $_REQUEST)) {
                    update_post_meta(
                        $idPost,
                        '_tipo',
                        $valor
                    );
                }
            }

            if(str_contains($clave, 'escala_')){
                //echo "{$clave} => {$valor} ";
                $idPost = str_replace("escala_", "", $clave);
                if (array_key_exists('escala_'.$idPost, $_REQUEST)) {
                    update_post_meta(
                        $idPost,
                        '_escala',
                        $valor
                    );
                }
            }
            
        }

        echo'<div class="alert alert-primary fade show" role="alert">Registros Actualizados con Éxito!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
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
