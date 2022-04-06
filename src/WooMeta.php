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
		$check_ml        = isset($values['_in_mercadolibre']) ? esc_attr($values['_in_mercadolibre'][0]) : '';
		$check_cl        	= isset($values['_in_claroshop']) ? esc_attr($values['_in_claroshop'][0]) : '';
		$volumen		= get_post_meta($post->ID, '_volumen', true);
		$material		= get_post_meta($post->ID, '_material', true);
		$color			= get_post_meta($post->ID, '_color', true);
		$size			= get_post_meta($post->ID, '_size', true);
		$maxage			= get_post_meta($post->ID, '_max_age', true);
		$minage			= get_post_meta($post->ID, '_min_age', true);
		$model			= get_post_meta($post->ID, '_model_number', true);
		$mercadolibre_category_code	= get_post_meta($post->ID, '_mercadolibre_category_code', true);
		$mercadolibre_category_name	= get_post_meta($post->ID, '_mercadolibre_category_name', true);
		$claroshop_category_code = get_post_meta($post->ID, '_claroshop_category_code', true);
		$forma			= get_post_meta($post->ID, '_forma', true);
		$personaje		= get_post_meta($post ->ID, '_personaje')

?>
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<label for="brand_name" class="form-label">Marca</label>
					<input type="text" class="form-control" name="brand_name" id="brand_name" value="<?php echo esc_attr($brand_name); ?>" />
				</div>
				<div class="col-sm-6 col-md-4">
					<label for="ean" class="form-label">EAN</label>
					<input type="text" class="form-control" name="ean" id="ean" value="<?php echo esc_attr($ean); ?>" />
				</div>
				<div class="col-sm-6 col-md-4">
					<label for="manufacturer" class="form-label">Fabricante</label>
					<input type="text" class="form-control" name="manufacturer" id="manufacturer" value="<?php echo esc_html($manufacturer); ?>" />
				</div>
				<div class="col-sm-6 col-md-4 form-check form-switch">
					<input type="checkbox" class="form-check-input" role="switch" id="in_warehouse" name="in_warehouse" <?php checked($check, 'on'); ?> />
					<label for="in_warehouse" class="form-check-label">¿En Almacen?</label>
				</div>
				<div class="col-sm-6 col-md-4">
					<label for="volumen" class="form-label">Volumen(Litros)</label>
					<input type="number" class="form-control" name="volumen" id="volumen" step="0.01" value="<?php echo esc_html($volumen); ?>">
				</div>
				<div class="col-sm-6 col-md-4">
					<label for="material" class="form-label">Material</label>
					<input type="text" class="form-control" name="material" id="material" value="<?php echo esc_attr($material); ?>" />
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6 col-md-4">
					<label for=color" class="form-label">Color</label>
					<input type="text" class="form-control" name="color" id="color" value="<?php echo esc_attr($color); ?>" />
				</div>
				<div class="col-sm-6 col-md-4">
					<label for="size" class="form-label">Tamaño</label>
					<input type="text" class="form-control" name="size" id="size" value="<?php echo esc_attr($size); ?>" />
				</div>
				<div class="col-sm-6 col-md-4">
					<label for="model_number" class="form-label">Modelo</label>
					<input type="text" class="form-control" name="model_number" id="model_number" value="<?php echo esc_attr($model); ?>" />
				</div>
				<div class="col-sm-6 col-md-4">
					<label for="forma" class="form-label">Forma</label>
					<input type="text" class="form-control" name="forma" id="forma" value="<?php echo esc_attr($forma); ?>" />
				</div>
				<div class="col-sm-6 col-md-4">
					<label for="personaje" class="form-label">Personaje</label>
					<input type="text" class="form-control" name="forma" id="personaje" value="<?php echo esc_attr($personaje); ?>" />
				</div>
				<div class="col-sm-6 col-md-4">
					
					
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6 col-md-4">
					<label for="mercadolibre_category_code" class="form-label">Código de Categoria de Mercado Libre</label>
					<input type="text" class="form-control" name="mercadolibre_category_code" id="mercadolibre_category_code" value="<?php echo esc_html($mercadolibre_category_code); ?>" />
				</div>
				<div class="col-sm-6 col-md-4">
					<label for="mercadolibre_category_name" class="form-label">Nombre de la Categoria de Mercado Libre</label>
					<input type="text" class=form-control" name="mercadolibre_category_name" id="mercadolibre_category_name" value="<?php echo esc_html($mercadolibre_category_name); ?>" />
				</div>
				<div class="col-sm-6 col-md-4">
					<label for="claroshop_category_code" class="form-label">Nombre de la Categoria de Claroshop</label>
					<input type="text" class="form-control" name="claroshop_category_code" id="claroshop_category_code" value="<?php echo esc_html($claroshop_category_code); ?>" />
				</div>
				<div class="col-xs-12">
					<h3>Activación</h3>
				</div>
				<div class="col-sm-6 col-md-4 form-check form-switch">
					<label for="in_mercadolibre" class="form-check-label">MercadoLibre</label>
					<input type="checkbox" class="form-check-input" role="switch" id="in_mercadolibre" name="in_mercadolibre" <?php checked($check_ml, 'on'); ?> />
				</div>
				<div class="col-sm-6 col-md-4 form-check form-switch">
					<label for="in_claroshop" class="form-check-label">Claroshop</label>
					<input type="checkbox" class="form-check-input" role="switch" id="in_claroshop" name="in_claroshop" <?php checked($check_cl, 'on'); ?> />
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6 col-md-4">

				</div>
				<div class="col-sm-6 col-md-4">

				</div>
				<div class="col-sm-6 col-md-4">

				</div>
				<div class="col-sm-6 col-md-4">

				</div>
				<div class="col-sm-6 col-md-4">

				</div>
				<div class="col-sm-6 col-md-4">

				</div>
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

		if (array_key_exists('model_number', $_POST)) {
			update_post_meta(
				$post_id,
				'_model_number',
				$_POST['model_number']
			);
		}

		if (array_key_exists('forma', $_POST)) {
			update_post_meta(
				$post_id,
				'_forma',
				$_POST['forma']
			);
		}

		if (array_key_exists('personaje', $_POST)) {
			update_post_meta(
				$post_id,
				'_personaje',
				$_POST['personaje']
			);
		}

		//Guardado de checkboxes
		$check = isset($_POST['in_warehouse']) && $_POST['in_warehouse'] ? 'on' : 'off';
		update_post_meta($post_id, '_in_warehouse', $check);

		$check_ml = isset($_POST['in_mercadolibre']) && $_POST['in_mercadolibre'] ? 'on' : 'off';
		update_post_meta($post_id, '_in_mercadolibre', $check_ml);

		$check_cl = isset($_POST['in_claroshop']) && $_POST['in_claroshop'] ? 'on' : 'off';
		update_post_meta($post_id, '_in_claroshop', $check_cl);
	}
}
