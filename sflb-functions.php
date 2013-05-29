<?php
/*
* SFLB functions - Provides output function for SFLB.
*
* @version 1.2
* @since 0.1
* @package shopp-sflb
* @subpackage sflb-functions
*
*/

/*
 *
 * @author Shoppdeveloper.com
 * @since 0.1
 *
 */


function add_sflb_stylesheet() {
        $sflb_StyleUrl = plugins_url('sflb.css', __FILE__); 
        $sflb_StyleFile = WP_PLUGIN_DIR .'/'. basename(dirname(__FILE__)).'/sflb.css';
        if ( file_exists($sflb_StyleFile) ) {
            wp_register_style('sflb_StyleSheets', $sflb_StyleUrl);
            wp_enqueue_style( 'sflb_StyleSheets');
        }
} // End add_sflb_stylesheet


function sflb_languages() {
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain( 'sflb', false, $plugin_dir."/languages/" );
}

function sflb( $result, $options, $Product){
	$result = sflb_create_links( $options );
	return $result;
}

function sflb_add_facebook_open_graph_tags(){
	global $Shopp;
	$current_product		= shopp('product','id','return=true');
	$sflb_options		= get_option( 'sflb_options' );
	// only on Shopp Product Page, load the Open Graph Tags
	if( (shopp( 'storefront','is-product' )) && ($sflb_options['og_fb_id'] != '') ){
		$sflb_og_image_size	= $sflb_options['og_image_size'];
		echo "<meta property='og:title' content='".shopp('product','name','return=true')."' />";
		echo "<meta property='og:type' content='".$sflb_options['og_type']."' />";
		echo "<meta property='og:url' content='".shopp('product','url','return=true')."' />";
		echo "<meta property='og:image' content='".shopp('product','coverimage',"property=url&size=$sflb_og_image_size&return=true")."' />";
		echo "<meta property='og:site_name' content='".get_bloginfo('name')."' />";
		echo "<meta property='fb:".$sflb_options['og_fb_type']."' content='".$sflb_options['og_fb_id']."'/>";
	shopp('storefront','product',"id=$current_product&load=true");
	}
}

?>