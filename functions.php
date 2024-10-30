<?php 

function as_coin_id_format($ret = false){
	$id = [
		'Bitcoin_Kopen' 		=> 'Bitcoin Kopen',
		'Bitcoin_Verkopen' 		=> 'Bitcoin Verkopen',
		'Ripple_Kopen' 			=> 'Ripple Kopen',
		'Ripple_Verkopen' 		=> 'Ripple Verkopen',
		'Litecoin_Kopen' 		=> 'Litecoin Kopen',
		'Litecoin_Verkopen' 	=> 'Litecoin Verkopen',
		'Ethereum_Kopen' 		=> 'Ethereum Kopen',
		'Ethereum_Verkopen' 	=> 'Ethereum Verkopen',
		'Bitcoin_Cash_Kopen' 	=> 'Bitcoin Cash Kopen',
		'Bitcoin_Cash_Verkopen' => 'Bitcoin Cash Verkopen',
		'Tron_Kopen' 		=> 'Tron Kopen',
		'Tron_Verkopen' 	=> 'Tron Verkopen',
		'IOTA_Kopen' 		=> 'IOTA Kopen',
		'IOTA_Verkopen' 	=> 'IOTA Verkopen',
		'EOS_Kopen' 		=> 'EOS Kopen',
		'EOS_Verkopen' 		=> 'EOS Verkopen',
		'Cardano_Kopen' 	=> 'Cardano Kopen',
		'Cardano_Verkopen' 	=> 'Cardano Verkopen',
		'Stellar_Kopen' 	=> 'Stellar Kopen',
		'Stellar_Verkopen' 	=> 'Stellar Verkopen',
		'Monero_Kopen' 		=> 'Monero Kopen',
		'Monero_Verkopen' 	=> 'Monero Verkopen',
		'NEO_Kopen' 		=> 'NEO Kopen',
		'NEO_Verkopen' 		=> 'NEO Verkopen',
		'Dash_Kopen' 		=> 'Dash Kopen',
		'Dash_Verkopen' 	=> 'Dash Verkopen',
		'Verge_Kopen' 		=> 'Verge Kopen',
		'Verge_Verkopen' 	=> 'Verge Verkopen',
		'VeChain_Kopen' 	=> 'VeChain Kopen',
		'VeChain_Verkopen' 	=> 'VeChain Verkopen',
		'OmiseGO_Kopen' 	=> 'OmiseGO Kopen',
		'OmiseGO_Verkopen' 	=> 'OmiseGO Verkopen',
		'Qtum_Kopen' 		=> 'Qtum Kopen',
		'Qtum_Verkopen' 	=> 'Qtum Verkopen',
		'NEM_Kopen' 		=> 'NEM Kopen',
		'NEM_Verkopen' 		=> 'NEM Verkopen',
		'Ontology_Kopen' 	=> 'Ontology Kopen',
		'Ontology_Verkopen' => 'Ontology Verkopen',
	];
	$coins = [
		'widget' => 'Widget',
		'table' => 'Tabel',
	];

	if ($ret == 'id') {
		return $id;
	}
	if ($ret == 'coin') {
		return $coins;
	}

	return false;
};


function as_coin_register_post_type(){
	$labels = array(
		'name'                  => _x( 'CryptoPrijzen', 'Post Type General Name', 'as' ),
		'singular_name'         => _x( 'CryptoPrijzen', 'Post Type Singular Name', 'as' ),
		'menu_name'             => __( 'CryptoPrijzen', 'as' ),
		'name_admin_bar'        => __( 'CryptoPrijzen', 'as' ),
		'all_items'             => __( 'Alle Shortcodes', 'as' ),
		'add_new_item'          => __( 'Add New Shortcode', 'as' ),
		'add_new'               => __( 'Nieuwe Shortcode', 'as' ),
		'new_item'              => __( 'New Shortcode', 'as' ),
		'edit_item'             => __( 'Edit Shortcode', 'as' ),
		'update_item'           => __( 'Update Shortcode', 'as' ),
		'view_item'             => __( 'View Shortcode', 'as' ),
		'view_items'            => __( 'View Shortcode', 'as' ),
		'search_items'          => __( 'Search Shortcode', 'as' ),
		'not_found'             => __( 'Not found', 'as' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'as' ),
		'insert_into_item'      => __( 'Insert into Shortcode', 'as' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Shortcode', 'as' ),
		'items_list'            => __( 'Shortcodes list', 'as' ),
		'items_list_navigation' => __( 'Shortcodes list navigation', 'as' ),
		'filter_items_list'     => __( 'Filter Shortcodes list', 'as' ),
	);
	$args = array(
		'label'                 => __( 'CryptoPrijzen', 'as' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => false,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'shortcode', $args );
}

add_action('after_setup_theme', 'as_coin_register_post_type');

add_action( 'manage_shortcode_posts_custom_column' , 'as_shortcode_custom_columns', 10, 2 );

function as_shortcode_custom_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'shortcode':
			$coin_meta 	= get_post_meta($post_id, 'as_coin_meta', true);
			$id_meta 	= get_post_meta($post_id, 'as_id_meta', true);
			$width_meta 	= get_post_meta($post_id, 'as_width_meta', true);
			$width_meta 	= ($width_meta != 0) ? 'width="'.$width_meta.'"' : '';
			$height_meta 	= get_post_meta($post_id, 'as_height_meta', true);
			$height_meta 	= ($height_meta != 0) ? 'height="'.$height_meta.'"' : '';
			$get_type_meta  = strpos($id_meta, 'Kopen');
	 		if ($get_type_meta) {
				$type_meta  = 'buy';
			}
			else{
				$type_meta  = 'sell';				
			}
	 		if ($id_meta) {
				echo '[cryptoprijzen_shortcode id="'.$id_meta.'" display="'.$coin_meta.'" '.$width_meta.' '.$height_meta.']';
			}
			break;
	}
}

function as_shortcode_add_sticky_column($columns) {
    return array_merge( $columns, 
              array('shortcode' => __('Shortcode')) );
}
add_filter('manage_shortcode_posts_columns' , 'as_shortcode_add_sticky_column');


function as_get_coin_shortcode($atts){
	$a = shortcode_atts( array(
		'id' => '',
		'display' => '',
		'width' => '',
		'height' => '',
	), $atts );
	$width 	= (empty($a['width']) === false) ? $a['width'].'px' : '100%' ;
	$height = (empty($a['height']) === false) ? $a['height'].'px' : '370px' ;
	$id_meta = $a['id'];
	$get_type_meta  = strpos($id_meta, 'Kopen');
	 	if ($get_type_meta) {
			$type_meta  = 'buy';
		}
		else{
			$type_meta  = 'sell';				
		}
	$remove_items  = array('_', 'Kopen', 'Verkopen');
	$get_coin_meta = str_replace($remove_items, "", $id_meta);
	$get_coin_meta = strtolower($get_coin_meta);
	return '<iframe src="https://cryptoprijzen.com/cryptoprijzen-widget/cryptoprijzen-widget.php?type='.$type_meta.'&display='.$a['display'].'&id='.$a['id'].'&coin='.$get_coin_meta.'" style="height:'.$height.';width:'.$width.';" frameborder="0" scrolling="no"></iframe>';
}

add_shortcode('cryptoprijzen_shortcode', 'as_get_coin_shortcode');