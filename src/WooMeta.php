<?php

namespace SELLERCONTROL;

class WooMeta {

	public function __construct() {

	}

	static public function createBoxOtherData() {
		add_meta_box( 'otros-datos', 'Otros datos del producto', __NAMESPACE__ . '\WooMeta::createFieldsOtherData', 'product', 'normal', 'high' );
	}

	static public function createFieldsOtherData( $post ) {
		wp_nonce_field( 'woocommerce_save_data', 'woocommerce_meta_nonce' );
		$values			= get_post_custom( $post->ID );
		$brand_name		= get_post_meta( $post->ID, '_brand_name', true );
		$ean			= get_post_meta( $post->ID, '_ean', true );
		$manufacturer	= get_post_meta( $post->ID, '_manufacturer', true );
		$check        = isset( $values['is_droppshiping'] ) ? esc_attr( $values['is_droppshiping'][0] ) : '';
		
		?>
<div class="row">
	<div class="col">
		<label for="brand_name">Marca</label>
		<input type="text" name="brand_name" id="brand_name" value="<?php echo esc_attr( $brand_name ); ?>" />
	</div>
	<div class="col">
		<label for="ean">EAN</label>
		<input type="text" name="ean" id="ean" value="<?php echo esc_attr( $ean ); ?>" />
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

	static public function createBoxAmazonData() {
		add_meta_box( 'amazon-datos', 'Datos de Amazon del prodcto', __NAMESPACE__ . '\WooMeta::createFieldsAmazonData', 'product', 'normal', 'high' );
	}

	static public function createFieldsAmazonData( $post ) {
		wp_nonce_field( 'woocommerce_save_data', 'woocommerce_meta_nonce' );
		$values = get_post_custom( $post->ID );
		$n      = 0;
		?>
<div class="row">
	<div class="col">
		<div class="list-group">
			<?php
		while ( isset( $values[ 'seller_' . strval( $n ) ] ) ) {
			$seller = isset( $values[ 'seller_' . strval( $n ) ] ) ? esc_attr( $values[ 'seller_' . strval( $n ) ][0] ) : '';
			$price  = isset( $values[ 'price_' . strval( $n ) ] ) ? esc_attr( $values[ 'price_' . strval( $n ) ][0] ) : '';
			$state  = ( 0 == $n ) ? 'active' : '';

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

	static public function saveInfo($post_id) {
		// Ignoramos los auto guardados.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Si no está el nonce declarado antes o no podemos verificarlo no seguimos.
		// Not allowed, return regular value without updating meta.
		// Check the nonce.
		if ( empty( $_POST['woocommerce_meta_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['woocommerce_meta_nonce'] ), 'woocommerce_save_data' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			return;
		}

		// Si el usuario actual no puede editar entradas no debería estar aquí.
		if ( ! current_user_can( 'edit_post' ) ) {
			return;
		}

		// Nos aseguramos de que hay información que guardar.
		if ( array_key_exists( 'brand_name', $_POST ) ) {
			update_post_meta(
				$post_id,
				'_brand_name',
				$_POST['brand_name']
			);
		}

		if ( array_key_exists( 'ean', $_POST ) ) {
			update_post_meta(
				$post_id,
				'_ean',
				$_POST['ean']
			);
		}
		
		if ( array_key_exists( 'manufacturer', $_POST ) ) {
			update_post_meta(
				$post_id,
				'_manufacturer',
				$_POST['manufacturer']
			);
		}
	}
}