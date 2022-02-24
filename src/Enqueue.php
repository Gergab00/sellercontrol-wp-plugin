<?php

namespace SELLERCONTROL;

class Enqueue
{

    public function __construct()
    {
    }

    /* 
        Funcion para agregar los JavaScript necesarios para el funcionamiento del plugin
        https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js
        */
    public static function insertarJS()
    {
        wp_register_script('invoice', plugins_url('/assets/js/invoice.js', dirname(__FILE__)), array('jquery'), '1', true);
        wp_enqueue_script('invoice');
        wp_localize_script('invoice', 'products', Enqueue::obtenerDatosProductos());

        wp_register_script('cdn-Datatables', 'https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js', array('jquery'), '1.10.24', false);
        wp_enqueue_script('cdn-Datatables');

        wp_register_script('quaggajs', plugins_url('/assets/js/quagga.js', dirname(__FILE__)), array('jquery'), '1.0.0', true);
        wp_enqueue_script('quaggajs');

        wp_enqueue_script('jquery-ui-autocomplete');

        wp_register_script('main', plugins_url('/assets/js/main.js', dirname(__FILE__)), array('jquery'), '1', true);
        wp_enqueue_script('main');

        /*wp_register_script('quaggaJS', plugins_url('/assets/js/quaggaJS.js', dirname(__FILE__)), array(), '1', true);
            wp_enqueue_script('quaggaJS');*/
    }

    public static function insertarJSAdmin()
    {
        wp_register_script('Bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.0.2', true);
        wp_enqueue_script('Bootstrap');
        wp_register_script('Bootstrap-Datatables', 'https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js', array('jquery'), '1.11.4', true);
        wp_enqueue_script('Bootstrap-Datatables');
    }

    public static function insertarCSS()
    {
        wp_register_style('cdn-Datatables-css', 'https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css', null, '1.10.24');
        wp_enqueue_style('cdn-Datatables-css');
        wp_register_style('cdn-DatatablesBootstrap-css', 'https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css', null, '1.11.4');
        wp_enqueue_style('cdn-DatatablesBootstrap-css');
        wp_register_style('sellercontrol_styles', plugins_url('/assets/css/style.css', dirname(__FILE__)), null, '1');
        wp_enqueue_style('sellercontrol_styles');
    }

    public static function insertarCSSAdmin()
    {
        wp_register_style('Bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', null, '5.0.2');
        wp_enqueue_style('Bootstrap');
    }

    public static function obenerDatosTabla()
    {
        global $wpdb;
        $config = new Config;
        $data = $config->db_options;
        $tabla_sc_facturas_compras = $wpdb->prefix . $data[0]['table'];
        $registros = $wpdb->get_results("SELECT * FROM $tabla_sc_facturas_compras");

        wp_register_script('datatables', plugins_url('/assets/js/datatables.js', dirname(__FILE__)), array('jquery'), '1', true);
        wp_enqueue_script('datatables');

        $dataSet = array();

        foreach ($registros as $registro) {
            $a = array(
                esc_textarea($registro->factura),
                esc_textarea($registro->fecha),
                esc_textarea($registro->proveedor),
                esc_textarea($registro->forma_pago),
                (int) $registro->iva,
                (int) $registro->monto
            );
            array_push($dataSet, $a);
        }

        wp_localize_script('datatables', 'dataSet', $dataSet);
    }

    public static function obtenerDatosProductos()
    {
        $args = array(
            'status' => 'publish',
        );
        $products = wc_get_products($args);

        $productObject = [];
        foreach ($products as $product) {

            $productObject[json_decode($product, true)['sku']] = json_decode($product, true)['name'];
        }

        return $productObject;
    }
}
