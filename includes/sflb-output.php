<?php
/*
*
* SFLB output - Provides SFLB output on Shopp product page.
*
*/


function sflb_create_links($arg){
	global $Shopp;

    $sflb	= sflb_load_settings(); // retrieve settings from database
    
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
	$result	.= '/sdk.js#xfbml=1&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		   }
		   (document, \'script\', \'facebook-jssdk\'));
		   </script>'; 
	$result .= "<div id='sflb'>";
	$share = sflb_convert_share($sflb['share']);

	switch($share) {
		case 'true':
		case 'false':
			$result .= "<div class='fb-like'";
			$result .= "data-href='".shopp('product.get-url')."' ";
			$result .= "data-share='".$share."' "; 
			$result .= "data-layout='".$sflb['layout']."' ";
			$result .= "data-width='".$sflb['width']."' ";
			$result .= "data-show-faces='".$sflb['show_faces']."' ";
			$result .= "data-action='".$sflb['action']."' ";
			$result .= "data-colorscheme='".$sflb['colorscheme']."' ";
			$result .= "data-font='".$sflb['font']."' ";
			$result .= "data-kid-directed-site='".$sflb['kiddirected']."' ";
			if( ! empty( $sflb['ref']) ) $result .= "data-ref='".$sflb['ref']."'";
			break;
		case 'share':
			$result .= "<div class='fb-share-button'";
			$result .= "data-href='".shopp('product.get-url')."' ";
			$result .= "data-layout='".$sflb['layout']."' ";
			break;			
	}
	$result .= "></div>";
	$result .= "</div>";
	return $result;

} // End sflb_create_links

function sflb_convert_share($arg){
	switch($arg) {
		case 'like': return 'false'; break;
		case 'likeshare': return 'true'; break;
		case 'share': return 'share'; break;
	}
}

function sflb_set_defaults(){
		
	$sflb_settings['share']			= 'like';
	$sflb_settings['layout']		= 'standard';
	$sflb_settings['show_faces'] 	= 'false';
	$sflb_settings['width']			= '450';
	$sflb_settings['action']		= 'like';
	$sflb_settings['font']	 		= 'arial';
	$sflb_settings['colorscheme'] 	= 'light';
	$sflb_settings['ref'] 			= '';
	$sflb_settings['kiddirected']	= 'false';
	return $sflb_settings;

} //End sflb_set_defaults

function sflb_load_settings(){
	global $wpdb;

	$defaults = sflb_set_defaults();
	$query = "SELECT name, value
				FROM {$wpdb->prefix}shopp_meta
				WHERE name LIKE 'sflb_%'";
	$result = sDB::query($query);

	if ( ! $result ) return $defaults;

	$options = array();
	foreach ( $result as $option ) $options[str_replace('sflb_', '', $option->name)] = $option->value;

	$results = array_merge($defaults, $options);

	return $results;
} //End sflb_load_settings
?>