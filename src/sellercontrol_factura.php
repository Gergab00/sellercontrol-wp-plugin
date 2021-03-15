<?php

namespace SELLERCONTROL;

class sellercontrol_factura
{

    public function __construct()
    {
    }

    public function render()
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
                    <input class="form-control" list="datalistOptions" id="proveedor" name="proveedor" placeholder="Buscar Proveedor...">
                    <datalist id="datalistOptions">
                        <option value="Juguetialegria">
                        <option value="Amazon">
                        <option value="Neza">
                        <option value="Hasbro">
                        <option value="Iztapalapa">
                    </datalist>
                </div>
                <div class="form-input col-sm-12 col-lg-6">
                    <label class="form-label" for="forma_pago">Forma de Pago</label>
                    <input class="form-control" list="datalistOptions" id="forma_pago" name="forma_pago" placeholder="Buscar Forma de Pago...">
                    <datalist id="datalistOptions">
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
                            <th width="15%">Prod. No</th>
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

    function sellercontrol_insertar_js()
    {
        wp_register_script('invoice', plugins_url('/assets/js/invoice.js', dirname(__FILE__)), array('jquery'), '1', true);
        wp_enqueue_script('invoice');
    }
}
