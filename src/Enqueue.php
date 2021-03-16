<?php
    namespace SELLERCONTROL;
          
    class Enqueue
    {
    
        public function __construct()
        {
    
        }

        /* 
        Funcion para agregar los JavaScript necesarios para el funcionamiento del plugin
        */
        public static function insertarJS()
        {
            wp_register_script('invoice', plugins_url('/assets/js/invoice.js', dirname(__FILE__)), array('jquery'), '1', true);
            wp_enqueue_script('invoice');
        }
    }