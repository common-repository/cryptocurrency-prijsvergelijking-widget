<?php 
/*
Plugin Name: Cryptocurrency Prijsvergelijking Widget
Plugin URI: http://wordpress.org/plugins/cryptocurrency-prijsvergelijking-widget/
Description: Eenvoudig de top 3 goedkoopste cryptocurrency aanbieders toevoegen aan je website voor tientallen verschillende munten.
Author: CryptoPrijzen.com
Version: 1.0
Author URI: https://cryptoprijzen.com/
*/

require_once(__DIR__.'/functions.php');

add_action('add_meta_boxes', 'as_coin_metabox');
function as_coin_metabox(){
	add_meta_box('as_coin_shortcode', 'Shortcode', 'as_coin_shortcode_func', 'shortcode');
}

function as_coin_shortcode_func($post){
	$coin_meta = get_post_meta($post->ID, 'as_coin_meta', true);
	$id_meta = get_post_meta($post->ID, 'as_id_meta', true);
	$width_meta 	= get_post_meta($post->ID, 'as_width_meta', true);
	$width_meta 	= ($width_meta != 0) ? $width_meta : '';
	$height_meta 	= get_post_meta($post->ID, 'as_height_meta', true);
	$height_meta 	= ($height_meta != 0) ? $height_meta : '';
	wp_nonce_field( 'as_coin_meta_'.$post->ID, 'as_coin_meta_'.$post->ID );

?>
<style>
	.as_coin_meta_container {
	    width:  100%;
	    height: auto;
	    overflow: hidden;
	    position: relative;
	}
	.as_coin_meta_container p label {
	    float:  left;
	    width:  100%;
	    margin: 0 0 5px 0;
	    font-size: 15px;
	}
</style>

<div class="as_coin_meta_container">

		<?php if ($id_meta) {
		?>
	
	<p>
		<label for="as_id_meta">
			Kopieer onderstaande shortcode en plak deze op je website:
		</label>
		<span class="regular-text">
			[cryptoprijzen_shortcode id="<?php echo $id_meta; ?>" display="<?php echo $coin_meta; ?>" <?php echo (empty($width_meta) === false) ? 'width="'.$width_meta.'"' : '' ; ?> <?php echo (empty($height_meta) === false) ? 'height="'.$height_meta.'"' : '' ; ?>]
		</span>
	</p>
		<?php
		} ?>

	<p>
		<label for="as_id_meta">
			Type Widget:
		</label>
		<select name="as_id_meta" id="as_id_meta" class="regular-text">
			<option value="">Selecteer de gewenste widget:</option>
			<?php 
				$ids = as_coin_id_format('id');
				$selected = '';
				foreach ($ids as $idkey => $idval) {
					if ($id_meta == $idkey) {
						$selected = 'selected';
					}					
					echo '<option value="'.$idkey.'" '.$selected.'>'.$idval.'</option>';
					$selected = '';
				}
			 ?>
		</select>
	</p>
	<p>
		<label for="as_coin_meta">
			Widget of Tabel: </br><small>Widget toont de top 3 prijzen en tabel toont alle prijzen</small>
		</label>
		<select name="as_coin_meta" id="as_coin_meta" class="regular-text">
			<option value="">Selecteer een optie</option>
			<?php 
				$coins = as_coin_id_format('coin');
				$selected = '';
				foreach ($coins as $coinkey => $coinval) {
					if ($coin_meta == $coinkey) {
						$selected = 'selected';
					}					
					echo '<option value="'.$coinkey.'" '.$selected.'>'.$coinval.'</option>';
					$selected = '';
				}
			 ?>
		</select>
	</p>
	<p>
		<label for="as_width_meta">Breedte: </br><small>Standaard breedte: 100% (blijft 100% bij sidebars)</small></label>
		<input type="text" id="as_width_meta" name="as_width_meta" class="regular-text" value="<?php echo $width_meta; ?>">
	</p>
	<p>
		<label for="as_height_meta">Hoogte: </br><small>Standaard hoogte: 370px</small></label>
		<input type="text" id="as_height_meta" name="as_height_meta" class="regular-text" value="<?php echo $height_meta; ?>">
	</p>
	
</div>

<?php
}


function as_coin_save_meta($id){
	if(isset($_POST['as_id_meta'])){
		update_post_meta(
			$id,
			'as_id_meta',
			strip_tags(trim(sanitize_text_field($_POST['as_id_meta'])))
		);
	}
	if(isset($_POST['as_width_meta'])){
		update_post_meta(
			$id,
			'as_width_meta',
			(int)$_POST['as_width_meta']
		);
	}
	if(isset($_POST['as_coin_meta'])){
		update_post_meta(
			$id,
			'as_coin_meta',
			strip_tags(trim(sanitize_text_field($_POST['as_coin_meta'])))
		);
	}
	if(isset($_POST['as_height_meta'])){
		update_post_meta(
			$id,
			'as_height_meta',
			(int)$_POST['as_height_meta']
		);
	}
}
add_action('save_post', 'as_coin_save_meta');