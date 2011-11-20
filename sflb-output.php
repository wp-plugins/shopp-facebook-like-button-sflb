<?php
/*
* SFLB output - Provides SFLB output on Shopp product page.
*
* @version 1.0
* @since 0.1
* @package Shopp-sflb
* @subpackage sflb-output
*
*/

/*
 *
 * @author Shoppdeveloper.com
 * @since 0.1
 *
 */


function sflb_create_links($arg){
	global $Shopp;
        $sflb	= load_sflb_settings(); // retrieve settings from database
	$sflb_language = get_bloginfo('language');
	$sflb_language = str_replace('-','_',$sflb_language);
	$result	= '<div id="fb-root"></div>
		   <script type="text/javascript">
		   (function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/';
	$result	.= $sflb_language;
	$result	.= '/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		   }
		   (document, \'script\', \'facebook-jssdk\'));
		   </script>'; 
	$result .= "<div id='sflb'>";
	$result .= "<div class='fb-like'";
	$result .= "data-href='".shopp('product','url','return=true')."' ";
	$result .= "data-send='".$sflb['send']."' "; 
	$result .= "data-layout='".$sflb['layout']."' ";
	$result .= "data-width='".$sflb['width']."' ";
	$result .= "data-show-faces='".$sflb['show_faces']."' ";
	$result .= "data-action='".$sflb['action']."' ";
	$result .= "data-colorscheme='".$sflb['colorscheme']."' ";
	$result .= "data-font='".$sflb['font']."' ";
	if( !empty( $sflb['ref']) ){	$result .= "data-ref='".$sflb['ref']."'"; }
	$result .= "></div>";
	$result .= "</div>";
	return $result;

} // End sflb_create_links


function load_sflb_settings(){
	// retrieve settings from database
	$sflb_settings		= get_option( 'sflb_options' );
	$sflb_settings['send']		= ($sflb_settings['send'] == '')?'false':$sflb_settings['send'];
	$sflb_settings['layout']	= ($sflb_settings['layout'] == '')?'standard':$sflb_settings['layout'];
	$sflb_settings['show_faces'] 	= ($sflb_settings['show_faces'] == '')?'false':$sflb_settings['show_faces'];
	$sflb_settings['width']		= ($sflb_settings['width'] == '')?'450':$sflb_settings['width'];
	$sflb_settings['action']	= ($sflb_settings['action'] == '')?'like':$sflb_settings['action'];
	$sflb_settings['font']	 	= ($sflb_settings['font'] == '')?'arial':$sflb_settings['font'];
	$sflb_settings['colorscheme'] 	= ($sflb_settings['colorscheme'] == '')?'light':$sflb_settings['colorscheme'];
	$sflb_settings['ref'] 	= $sflb_settings['ref'];
	return $sflb_settings;

} //End load_sflb_settings


?>