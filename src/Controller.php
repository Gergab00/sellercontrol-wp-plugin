<?php

namespace SELLERCONTROL;

class Controller
{

    public function __construct()
    {
    }

    public static function guardarFacturaCompra()
    {
        global $wpdb; // Este objeto global nos permite trabajar con la BD de WP

        $tabla_sellercontrol = $wpdb->prefix . 'sellercontrol';
        $factura = sanitize_text_field($_REQUEST['factura']);   
        $fecha = date($_REQUEST['fecha']);
        $proveedor = sanitize_text_field($_REQUEST['proveedor']);
        $forma_pago = sanitize_text_field($_REQUEST['forma_pago']);
        $iva = (double) $_REQUEST['iva'];
        $monto = (double) $_REQUEST['monto'];
        $created_at = date('Y-m-d H:i:s');

        $ret = $wpdb->insert(
            $tabla_sellercontrol,
            array(
                'factura' => $factura,
                'fecha' => $fecha,
                'proveedor' => $proveedor,
                'forma_pago' => $forma_pago,
                'iva' => $iva,
                'monto' => $monto,
                'created_at' => $created_at,
            )
        );

        if($ret){
        echo    '<div class="alert alert-success" role="alert">
            Registro Creado con Éxito. Filas afectadas '.$ret.'
                </div>';
        }else{
            echo    '<div class="alert alert-danger" role="alert">Error en la creacion del registro</div>';
        }
        
    }
}
