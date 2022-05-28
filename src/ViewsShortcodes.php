<?php

namespace SELLERCONTROL;
use SELLERCONTROL\Users;

class ViewsShortcodes
{

    public function __construct()
    {
    }

    /* 
    Funcion para mostar el form para poder agregar la factura.
    */
    public function renderFacturaForm()
    {
        //wp_register_script( 'QuaggaJs', plugins_url('/assets/js/quaggaJS.js', dirname(__FILE__)), , '5.0.2', true );
        $redirect_login = get_permalink();
        $redirect_logout = get_permalink();
        $usuarios = new Users;
        // Get products.
        $args = array(
            'status' => 'publish',
        );
        $products = wc_get_products( $args );
        foreach($products as $product){
            echo json_decode($product, true)['name'];
            echo json_decode($product, true)['id'];
            //echo $product;
        }
        //echo 'Admin: '.$usuarios->is_admin();
        if ($usuarios->is_asociado() || $usuarios->is_admin()) {
            $current_user = wp_get_current_user();
                $url_logout = wp_logout_url( $redirect_logout );
        
                $str = get_avatar($current_user->user_email, 24).' ';
                $str .= 'Hola '.$current_user->display_name.'<br>';
                $str .= '<a href="' . $url_logout . '">Desconectarse</a>';
        
                echo $str;
                ob_start();

//* Función de Javascript que crea un objeto con el asin y titulo del producto. Despues se crea la función donde al llenar el campo del asin, automaticamente se llena el del nombre.
//TODO Que el programa idendifique la linea que se tiene señalada para solo autocompletar esa.
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
            <input class="form-control" list="datalistProveedor" id="proveedor" name="proveedor"
                placeholder="Buscar Proveedor...">
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
            <input class="form-control" list="datalistFormaPago" id="forma_pago" name="forma_pago"
                placeholder="Buscar Forma de Pago...">
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
                    <td>
                        <input type="text" list="asinOptions" name="productCode[]" id="productCode_1"
                            class="form-control" autocomplete="off">
                        <datalist id="asinOptions">
                            <?php
                                    foreach($products as $product){
                                        echo '<option value="'.json_decode($product, true)['sku'].'">';
                                    }
                                    ?>
                        </datalist>
                    </td>
                    <td>
                        <input type="text" list="productNameOptions" name="productName[]" id="productName_1"
                            class="form-control" autocomplete="off">
                        <datalist id="productNameOptions">
                            <?php
                                        foreach($products as $product){
                                            echo '<option value="'.json_decode($product, true)['name'].'">';
                                            //echo $product;
                                        }
                                    ?>
                        </datalist>
                    </td>
                    <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity"
                            autocomplete="off"></td>
                    <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off">
                    </td>
                    <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off">
                    </td>
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

    /**
     * renderFacturaTable
     *
     * @return void
     */
    public function renderFacturaTable()
    {
        $usuarios = new Users;
        //echo 'Admin: '.$usuarios->is_admin();
        if ($usuarios->is_asociado() || $usuarios->is_admin()) {
        ob_start();
        ?>
<table id="example" width="100%"></table>
<?php
         return ob_get_clean();
        }else {
            return 'No estas autorizado.';
        }
    }

    function dcms_form_login_config() {
        $redirect_login = get_permalink();
        $redirect_logout = get_permalink();
    
        if ( ! is_user_logged_in() ):
            $args = array(
                'echo'            => false,
                'redirect'        => $redirect_login,
              );
              return wp_login_form( $args );
        else:
            $current_user = wp_get_current_user();
            $url_logout = wp_logout_url( $redirect_logout );
    
            $str = get_avatar($current_user->user_email, 24).' ';
            $str .= 'Hola '.$current_user->display_name.'<br>';
            $str .= '<a href="' . $url_logout . '">Desconectarse</a>';
    
            return $str;
        endif;
    }

    function iniciarScanner(){
        ?>
        <section id="container" class="container">
        <h3>The user's camera</h3>
        <p>If your platform supports the <strong>getUserMedia</strong> API call, you can try the real-time locating and decoding features.
            Simply allow the page to access your web-cam and point it to a barcode. You can switch between <strong>Code128</strong>
            and <strong>EAN</strong> to test different scenarios.
            It works best if your camera has built-in auto-focus.
            </p>
        <div class="controls">
            <fieldset class="input-group">
                <button class="stop">Stop</button>
            </fieldset>
            <fieldset class="reader-config-group">
                <label>
                    <span>Barcode-Type</span>
                    <select name="decoder_readers">
                        <option value="code_128" selected="selected">Code 128</option>
                        <option value="code_39">Code 39</option>
                        <option value="code_39_vin">Code 39 VIN</option>
                        <option value="ean">EAN</option>
                        <option value="ean_extended">EAN-extended</option>
                        <option value="ean_8">EAN-8</option>
                        <option value="upc">UPC</option>
                        <option value="upc_e">UPC-E</option>
                        <option value="codabar">Codabar</option>
                        <option value="i2of5">Interleaved 2 of 5</option>
                        <option value="2of5">Standard 2 of 5</option>
                        <option value="code_93">Code 93</option>
                    </select>
                </label>
                <label>
                    <span>Resolution (width)</span>
                    <select name="input-stream_constraints">
                        <option value="320x240">320px</option>
                        <option selected="selected" value="640x480">640px</option>
                        <option value="800x600">800px</option>
                        <option value="1280x720">1280px</option>
                        <option value="1600x960">1600px</option>
                        <option value="1920x1080">1920px</option>
                    </select>
                </label>
                <label>
                    <span>Patch-Size</span>
                    <select name="locator_patch-size">
                        <option value="x-small">x-small</option>
                        <option value="small">small</option>
                        <option selected="selected" value="medium">medium</option>
                        <option value="large">large</option>
                        <option value="x-large">x-large</option>
                    </select>
                </label>
                <label>
                    <span>Half-Sample</span>
                    <input type="checkbox" checked="checked" name="locator_half-sample" />
                </label>
                <label>
                    <span>Workers</span>
                    <select name="numOfWorkers">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option selected="selected" value="4">4</option>
                        <option value="8">8</option>
                    </select>
                </label>
                <label>
                    <span>Camera</span>
                    <select name="input-stream_constraints" id="deviceSelection">
                    </select>
                </label>
                <label style="display: none">
                    <span>Zoom</span>
                    <select name="settings_zoom"></select>
                </label>
                <label style="display: none">
                    <span>Torch</span>
                    <input type="checkbox" name="settings_torch" />
                </label>
            </fieldset>
        </div>
      <div id="result_strip">
        <ul class="thumbnails"></ul>
        <ul class="collector"></ul>
      </div>
      <div id="interactive" class="viewport"></div>
    </section>
        <?php
    }
}