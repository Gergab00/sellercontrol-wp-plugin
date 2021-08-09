<?php

namespace SELLERCONTROL;
          
    class WooMeta
    {
    
        public function __construct()
        {
    
        }

        static public function createBoxOtherData()
        {
            add_meta_box( 'otros-datos', 'Otros datos del producto', __NAMESPACE__.'\WooMeta::createFieldsOtherData', 'product', 'normal', 'high' );
        }

        static public function createFieldsOtherData($post)
        {
            $values = get_post_custom( $post->ID );
            $brandName  = isset( $values['brandName'] ) ? esc_attr( $values['brandName'][0] ) : '';
            $check  = isset( $values['is_droppshiping'] ) ? esc_attr( $values['is_droppshiping'][0] ) : '';
            $ean    = isset( $values['ean'] ) ? esc_attr( $values['ean'][0] ) : '';
            $manufacturer = isset($values['manufacturer']) ? esc_attr( $values['manufacturer'][0] ) : "";
            ?>
<div class="row">
    <div class="col">
        <label for="brandName">Marca</label>
        <input type="text" name="brandName" id="brandName" value="<?php echo esc_html( $brandName ); ?>" />
    </div>
    <div class="col">
        <label for="ean">EAN</label>
        <input type="text" name="ean" id="ean" value="<?php echo esc_html( $ean ); ?>" />
    </div>
    <div class="col">
        <label for="manufacturer">Fabricante</label>
        <input type="text" name="manufacturer" id="manufacturer" value="<?php echo esc_html( $manufacturer ); ?>" />
    </div>
    <div class="col">
        <input type="checkbox" id="is_droppshiping" name=is_droppshiping" <?php checked( $check, 'on' ); ?> />
        <label for="is_droppshiping">¿Es Droppshiping?</label>
    </div>
</div>

<div class="row">
    <div class="col">
        <label for=""></label>
    </div>
</div>

<?php
        }

        static public function createBoxAmazonData()
        {
            add_meta_box( 'amazon-datos', 'Datos de Amazon del prodcto', __NAMESPACE__.'\WooMeta::createFieldsAmazonData', 'product', 'normal', 'high' );
        }

        static public function createFieldsAmazonData($post)
        {
            $values = get_post_custom( $post->ID );
            $n = 0;
            ?>
<div class="row">
    <div class="col">
        <div class="list-group">
        <?php
        while (isset($values['seller_'.strval($n)])) {
            $seller = isset( $values['seller_'.strval($n)] ) ? esc_attr( $values['seller_'.strval($n)][0] ) : '';
            $price = isset( $values['price_'.strval($n)] ) ? esc_attr( $values['price_'.strval($n)][0] ) : '';
            $state = (0 == $n) ? 'active' : '';
           
                ?>
                <div class="list-group-item list-group-item-action <?php echo esc_html( $state ); ?>" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1" id="buybox_seller" name="buybox_seller"><?php echo esc_html( $seller ); ?></h5>
                </div>
                <p class="mb-1"><?php echo esc_html( $price ); ?></p>
            </div>
                <?php
                $n++;
        }
        ?>
        </div>
    </div>
</div>
<?php
        }

        static public function saveInfo()
        {
            // Ignoramos los auto guardados.
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
            }
        
            // Si no está el nonce declarado antes o no podemos verificarlo no seguimos.
            if ( ! isset( $_POST['bf_metabox_nonce'] ) || ! wp_verify_nonce( $_POST['bf_metabox_nonce'], 'dariobf_metabox_nonce' ) ) {
                return;
            }
        
            // Si el usuario actual no puede editar entradas no debería estar aquí.
            if ( ! current_user_can( 'edit_post' ) ) {
                return;
            }
        }
    }