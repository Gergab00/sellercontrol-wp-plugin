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

            wp_register_script('cdn-Datatables', 'https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js', array('jquery'), '1.10.24', false);
            wp_enqueue_script('cdn-Datatables');

            /*wp_register_script('quaggaJS', plugins_url('/assets/js/quaggaJS.js', dirname(__FILE__)), array(), '1', true);
            wp_enqueue_script('quaggaJS');*/
        }

        public static function insertarCSS()
        {
            wp_register_style( 'cdn-Datatables-css', 'https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css', null, '1.10.24');
            wp_enqueue_style( 'cdn-Datatables-css');
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
            array_push($dataSet,$a);
        }

        wp_localize_script('datatables','dataSet',$dataSet);
        }
    }