<?php

namespace SELLERCONTROL;

class Views
{

    public function __construct()
    {
    }

    /* 
    Funcion para mostar el form para poder agregar la factura.
    */
    public function renderFacturaForm()
    {
        ob_start();
?>
        <form action="<?php get_the_permalink(); ?>" method="post" id="form_factura" class="cuestionario">
            <div class="row">
                <?php wp_nonce_field('graba_factura', 'factura_nonce'); ?>
                <div class="form-input col-sm-12 col-lg-6">
                    <label class="form-label" for="factura">Factura</label>
                    <input class="form-control" type="text" name="factura" id="factura" required>
                </div>
                <div class="form-input col-sm-12 col-lg-6">
                    <label for='fecha'>Fecha</label>
                    <input class="form-control" type="date" name="fecha" id="fecha" required>
                </div>
                <div class="form-input col-sm-12 col-lg-6">
                    <label class="form-label" for="proveedor">Proveedor</label>
                    <input class="form-control" list="datalistProveedor" id="proveedor" name="proveedor" placeholder="Buscar Proveedor...">
                    <datalist id="datalistProveedor">
                        <option value="Juguetialegria">
                        <option value="Amazon">
                        <option value="Neza">
                        <option value="Hasbro">
                        <option value="Iztapalapa">
                    </datalist>
                </div>
                <div class="form-input col-sm-12 col-lg-6">
                    <label class="form-label" for="forma_pago">Forma de Pago</label>
                    <input class="form-control" list="datalistFormaPago" id="forma_pago" name="forma_pago" placeholder="Buscar Forma de Pago...">
                    <datalist id="datalistFormaPago">
                        <option value="Efectivo">
                        <option value="Tarjeta de Débito">
                        <option value="Tarjeta de Crédito Home Depot">
                        <option value="Tarjeta de Crédito Banamex Gold">
                        <option value="Tarjeta de Crédito Bancomer">
                    </datalist>

                </div>
                <div class="form-input col-sm-12 col-lg-6">
                    <label class="form-label" for="iva">IVA</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" step="0.01" name="iva" placeholder="0.00" required>
                    </div>
                </div>
                <div class="form-input col-sm-12 col-lg-6">
                    <label class="form-label" for="monto">Monto</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" step="0.01" name="monto" placeholder="0.00" required>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="form-input col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-hover" id="invoiceItem">
                        <tr>
                            <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                            <th width="15%">ASIN</th>
                            <th width="38%">Nombre Producto</th>
                            <th width="15%">Cantidad</th>
                            <th width="15%">Precio</th>
                            <th width="15%">Total</th>
                        </tr>
                        <tr>
                            <td><input class="itemRow" type="checkbox"></td>
                            <td><input type="text" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>
                            <td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>
                            <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
                            <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
                            <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="form-input col-xs-6 col-sm-3 col-md-3 col-lg-3">
                    <button class="btn btn-danger delete" id="removeRows" type="button">- Borrar</button>
                </div>
                <div class="form-input col-xs-6 col-sm-3 col-md-3 col-lg-3">
                    <button class="btn btn-success" id="addRows" type="button">+ Agregar Más</button>
                </div>
                <div class="form-input col-xs-6 col-sm-3 col-md-3 col-lg-3">
                    <input class="btn btn-success" type="submit" value="Registrar">
                </div>
            </div>

        </form>
<?php
        return ob_get_clean();
    }

    /* 
    
    */
    public static function renderFacturaTable()
    {
        global $wpdb;
        $tabla_sellercontrol = $wpdb->prefix . 'sellercontrol';
        $registros = $wpdb->get_results("SELECT * FROM $tabla_sellercontrol");
        echo '<div class="wrap"><h1>Registro de Compras</h1>';
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th width="30%">Factura</th><th width="20%">Fecha</th>';
        echo '<th>Proveedor</th><th>Forma de Pago</th><th>IVA</th><th>Monto</th><th>WP</th><th>Total</th>';
        echo '</tr></thead>';
        echo '<tbody id="the-list">';
        foreach ($registros as $registro) {
            $factura = esc_textarea($registro->factura);
            $fecha = esc_textarea($registro->fecha);
            $proveedor = (int) $registro->proveedor;
            $forma_pago = (int) $registro->forma_pago;
            $iva = (int) $registro->iva;
            $monto = (int) $registro->monto;
            echo "<tr><td><a href='#' title='$factura'>$factura</a></td>";
            echo "<td>$fecha</td><td>$proveedor</td><td>$forma_pago</td>";
            echo "<td>$iva</td><td>$monto</td>";
            echo "</tr>";
        }
        echo '</tbody></table></div>';
    }
}
