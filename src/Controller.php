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
        $config = new Config;
        $data = $config->db_options;

        $tabla_sc_facturas_compras = $wpdb->prefix . $data[0]['table'];
        $tabla_sc_productos_compras = $wpdb->prefix . $data[1]['table'];
        $factura = sanitize_text_field($_REQUEST['factura']);   
        $fecha = date($_REQUEST['fecha']);
        $proveedor = sanitize_text_field($_REQUEST['proveedor']);
        $forma_pago = sanitize_text_field($_REQUEST['forma_pago']);
        $iva = (double) $_REQUEST['iva'];
        $monto = (double) $_REQUEST['monto'];
        $created_at = date('Y-m-d H:i:s');

        $ret = $wpdb->insert(
            $tabla_sc_facturas_compras,
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

        for ($i = 0; $i < count($_REQUEST['productCode']); $i++) {
            $ret2 = $wpdb->insert(
                $tabla_sc_productos_compras,//cambiar la tabla
                array(
                    'factura' => $factura,
                    'fecha' => $fecha,
                    'descripcion' => $_REQUEST['productName'][$i],
                    'ASIN' => $_REQUEST['productCode'][$i],
                    'precio_unitario' => $_REQUEST['price'][$i],
                    'cantidad' => $_REQUEST['quantity'][$i],
                    'total' => $_REQUEST['total'][$i],
                    'created_at' => $created_at,
                )
            );

            if($ret2){
                echo    '<div class="alert alert-success" role="alert">
                    Registro Creado con Éxito. Filas afectadas '.$ret2.'
                        </div>';
                }else{
                    echo    '<div class="alert alert-danger" role="alert">Error en la creacion del registro</div>';
                }

		}

        if($ret){
        echo    '<div class="alert alert-success" role="alert">
            Registro Creado con Éxito. Filas afectadas '.$ret.'
                </div>';
        }else{
            echo    '<div class="alert alert-danger" role="alert">Error en la creacion del registro</div>';
        }
        
    }
}