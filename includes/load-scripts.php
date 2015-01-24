<?php
/*
*
* SFLB functions - Provides output function for SFLB.
*
*/

defined( 'WPINC' ) || header( 'HTTP/1.1 403' ) & exit;


function add_sflb_stylesheet() {
   	$sflb_StyleUrl = plugins_url('sflb.css', __FILE__);
    $sflb_StyleFile = plugin_dir_path( __FILE__ ).'sflb.css';
   	if ( file_exists($sflb_StyleFile) ) {
       	wp_register_style('sflb_StyleSheets', $sflb_StyleUrl);
       	wp_enqueue_style('sflb_StyleSheets');
   	}
} // End add_sflb_stylesheet

add_action( 'admin_enqueue_scripts', 'add_sflb_stylesheet' );

function add_sflb_script($hook) {
		if( 'shopp-extra_page_shopp-facebook' == $hook) {

        	$sflb_ScriptUrl = plugins_url('sflb-settings.js', __FILE__);
            $sflb_ScriptFile = plugin_dir_path( __FILE__ ).'sflb-settings.js';

        	if ( file_exists($sflb_ScriptFile) ) {
            	wp_register_script('sflb_ScriptFile', $sflb_ScriptUrl);
            	wp_enqueue_script( 'sflb_ScriptFile');
        	}
		}
} // End add_sflb_script

add_action( 'admin_enqueue_scripts', 'add_sflb_script' );

function sflb_load_textdomain() {
	load_plugin_textdomain( 'sflb', false, 'shopp-sflb/languages/' );
}

add_action( 'wp_loaded', 'sflb_load_textdomain' );

function sflb( $result, $options, $Product){
	$result = sflb_create_links( $options );
	return $result;
}

add_filter('shopp_tag_product_facebook','sflb', 10, 3);

function sflb_add_facebook_open_graph_tags(){
	// only on Shopp Product Page, load the Open Graph Tags
	if ( is_shopp_product() ) { 
		global $Shopp;
		$current_product	= shopp('product.get-id');
		$sflb_options		= load_ogt_data();
	}

	if ( ! empty($sflb_options['og_fb_id']) && is_numeric($sflb_options['og_fb_id']) ) { 
		$sflb_og_image_size	= $sflb_options['og_image_size'];
		echo "<meta property='og:title' content='".shopp('product.get-name')."' />";
		echo "<meta property='og:type' content='".$sflb_options['og_type']."' />";
		echo "<meta property='og:url' content='".shopp('product.get-url')."' />";
		echo "<meta property='og:image' content='".shopp('product.get-coverimage',"property=url&size=$sflb_og_image_size")."' />";
		echo "<meta property='og:site_name' content='".get_bloginfo('name')."' />";
		echo "<meta property='fb:".$sflb_options['og_fb_type']."' content='".$sflb_options['og_fb_id']."'/>";
		shopp('storefront','product',"id=$current_product&load=true");
	}
} 

add_action('wp_head', 'sflb_add_facebook_open_graph_tags');

function load_ogt_data(){
	global $wpdb;

	$query = "SELECT name, value
				FROM {$wpdb->prefix}shopp_meta
				WHERE name LIKE 'sflb_og%'";
	$result = sDB::query($query);

	if ( empty($result) ) return;

	$options = array();

	foreach ( $result as $option ) $options[str_replace('sflb_', '', $option->name)] = $option->value;

	return $options;
}
?>