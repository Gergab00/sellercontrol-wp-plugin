<?php

namespace SELLERCONTROL;

class WooMeta
{

	public function __construct()
	{
	}

	static public function createBoxOtherData()
	{
		add_meta_box('otros-datos', 'Otros datos del producto', __NAMESPACE__ . '\WooMeta::createFieldsOtherData', 'product', 'normal', 'high');
	}

	static public function createFieldsOtherData($post)
	{
		wp_nonce_field('woocommerce_save_data', 'woocommerce_meta_nonce');
		$values			= get_post_custom($post->ID);
		$brand_name		= get_post_meta($post->ID, '_brand_name', true);
		$ean			= get_post_meta($post->ID, '_ean', true);
		$manufacturer	= get_post_meta($post->ID, '_manufacturer', true);
		$check        	= isset($values['_in_warehouse']) ? esc_attr($values['_in_warehouse'][0]) : '';
		$volumen		= get_post_meta($post->ID, '_volumen', true);
		$material		= get_post_meta($post->ID, '_material', true);
		$color			= get_post_meta($post->ID, '_color', true);
		$size			= get_post_meta($post->ID, '_size', true);
		$maxage			= get_post_meta($post->ID, '_max_age', true);
		$minage			= get_post_meta($post->ID, '_min_age', true);

?>
		<div class="row">
			<div class="col">
				<label for="brand_name">Marca</label>
				<input type="text" name="brand_name" id="brand_name" value="<?php echo esc_attr($brand_name); ?>" />
			</div>
			<div class="col">
				<label for="ean">EAN</label>
				<input type="text" name="ean" id="ean" value="<?php echo esc_attr($ean); ?>" />
			</div>
			<div class="col">
				<label for="manufacturer">Fabricante</label>
				<input type="text" name="manufacturer" id="manufacturer" value="<?php echo esc_html($manufacturer); ?>" />
			</div>
			<div class="col">
				<input type="checkbox" id="in_warehouse" name="in_warehouse" <?php checked($check, 'on'); ?> />
				<label for="in_warehouse">¿En Almacen?</label>
			</div>
		</div>

		<div class="row m-3">
			<div class="col">
				<label for="volumen">Volumen(Litros)</label>
				<input type="number" name="volumen" id="volumen" step="0.01" value="<?php echo esc_html($volumen); ?>">
			</div>
			<div class="col">
				<label for="brand_name">Material</label>
				<input type="text" name="brand_name" id="brand_name" value="<?php echo esc_attr($material); ?>" />
			</div>
			<div class="col">
				<label for="brand_name">Color</label>
				<input type="text" name="brand_name" id="brand_name" value="<?php echo esc_attr($color); ?>" />
			</div>
		</div>
		<div class="row m-3">
			<div class="col">
				<label for="brand_name">Tamaño</label>
				<input type="text" name="brand_name" id="brand_name" value="<?php echo esc_attr($size); ?>" />
			</div>
		</div>

	<?php
	}

	static public function createBoxAmazonData()
	{
		add_meta_box('amazon-datos', 'Datos de Amazon del producto', __NAMESPACE__ . '\WooMeta::createFieldsAmazonData', 'product', 'normal', 'high');
	}

	static public function createFieldsAmazonData($post)
	{
		wp_nonce_field('woocommerce_save_data', 'woocommerce_meta_nonce');
		$values 			= get_post_custom($post->ID);
		$amazon_category	= get_post_meta($post->ID, '_amazon_category', true);
		$n      = 0;
	?>
		<div class="row">
			<div class="col">
				<label for="amazon_category">Categoria de Amazon</label>
				<input type="text" name="amazon_category" id="amazon_category" value="<?php echo esc_html($amazon_category); ?>" disabled />
			</div>
		</div>

		<div class="row">
			<div class="col">
				<div class="list-group">
					<?php
					while (isset($values['seller_' . strval($n)])) {
						$seller = isset($values['seller_' . strval($n)]) ? esc_attr($values['seller_' . strval($n)][0]) : '';
						$price  = isset($values['price_' . strval($n)]) ? esc_attr($values['price_' . strval($n)][0]) : '';
						$state  = (0 == $n) ? 'active' : '';

					?>
						<div class="list-group-item list-group-item-action <?php echo esc_html($state); ?>" aria-current="true">
							<div class="d-flex w-100 justify-content-between">
								<h5 class="mb-1" id="buybox_seller" name="buybox_seller"><?php echo esc_html($seller); ?></h5>
							</div>
							<p class="mb-1"><?php echo esc_html($price); ?></p>
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

	static public function createBoxMercadoLibreData()
	{
		add_meta_box('mercadolibre-datos', 'Datos de Mercadolibre del producto', __NAMESPACE__ . '\WooMeta::createFieldsMercadoLibreData', 'product', 'normal', 'high');
	}

	static public function createFieldsMercadoLibreData($post)
	{
		wp_nonce_field('woocommerce_save_data', 'woocommerce_meta_nonce');
		$mercadolibre_category_code	= get_post_meta($post->ID, '_mercadolibre_category_code', true);
		$mercadolibre_category_name	= get_post_meta($post->ID, '_mercadolibre_category_name', true);
		$claroshop_category_code = get_post_meta($post->ID, '_claroshop_category_code', true);
	?>
		<div class="row">
			<div class="col">
				<label for="mercadolibre_category_code">Código de Categoria de Mercado Libre</label>
				<input type="text" name="mercadolibre_category_code" id="mercadolibre_category_code" value="<?php echo esc_html($mercadolibre_category_code); ?>" />
			</div>
			<div class="col">
				<label for="mercadolibre_category_name">Nombre de la Categoria de Mercado Libre</label>
				<input type="text" name="mercadolibre_category_name" id="mercadolibre_category_name" value="<?php echo esc_html($mercadolibre_category_name); ?>" />
			</div>
			<div class="col">
				<label for="claroshop_category_code">Nombre de la Categoria de Claroshop</label>
				<input type="text" name="claroshop_category_code" id="claroshop_category_code" value="<?php echo esc_html($claroshop_category_code); ?>" />
			</div>
		</div>
<?php
	}

	static public function saveInfo($post_id)
	{
		// Ignoramos los auto guardados.
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		// Si no está el nonce declarado antes o no podemos verificarlo no seguimos.
		// Not allowed, return regular value without updating meta.
		// Check the nonce.
		if (empty($_POST['woocommerce_meta_nonce']) || !wp_verify_nonce(wp_unslash($_POST['woocommerce_meta_nonce']), 'woocommerce_save_data')) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			return;
		}

		// Si el usuario actual no puede editar entradas no debería estar aquí.
		if (!current_user_can('edit_post')) {
			return;
		}

		// Nos aseguramos de que hay información que guardar.
		if (array_key_exists('brand_name', $_POST)) {
			update_post_meta(
				$post_id,
				'_brand_name',
				$_POST['brand_name']
			);
		}

		if (array_key_exists('ean', $_POST)) {
			update_post_meta(
				$post_id,
				'_ean',
				$_POST['ean']
			);
		}

		if (array_key_exists('manufacturer', $_POST)) {
			update_post_meta(
				$post_id,
				'_manufacturer',
				$_POST['manufacturer']
			);
		}

		if (array_key_exists('marketsync_category_code', $_POST)) {
			update_post_meta(
				$post_id,
				'_marketsync_category_code',
				$_POST['marketsync_category_code']
			);
		}

		if (array_key_exists('mercadolibre_category_code', $_POST)) {
			update_post_meta(
				$post_id,
				'_mercadolibre_category_code',
				$_POST['mercadolibre_category_code']
			);
		}

		if (array_key_exists('mercadolibre_category_name', $_POST)) {
			update_post_meta(
				$post_id,
				'_mercadolibre_category_name',
				$_POST['mercadolibre_category_name']
			);
		}

		if (array_key_exists('claroshop_category_code', $_POST)) {
			update_post_meta(
				$post_id,
				'_claroshop_category_code',
				$_POST['claroshop_category_code']
			);
		}

		if (array_key_exists('volumen', $_POST)) {
			update_post_meta(
				$post_id,
				'_volumen',
				$_POST['volumen']
			);
		}

		if (array_key_exists('material', $_POST)) {
			update_post_meta(
				$post_id,
				'_material',
				$_POST['material']
			);
		}

		if (array_key_exists('color', $_POST)) {
			update_post_meta(
				$post_id,
				'_color',
				$_POST['color']
			);
		}

		if (array_key_exists('size', $_POST)) {
			update_post_meta(
				$post_id,
				'_size',
				$_POST['size']
			);
		}

		//Guardado de checkboxes
		$check = isset($_POST['in_warehouse']) && $_POST['in_warehouse'] ? 'on' : 'off';
		update_post_meta($post_id, '_in_warehouse', $check);
	}
}
