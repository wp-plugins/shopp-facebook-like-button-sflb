<?php
/**
 *	Shopp Facebook Like Button
 *  Copyright: Copyright © 2015 Shoppdeveloper.com
**/

defined( 'WPINC' ) || header( 'HTTP/1.1 403' ) & exit; // Prevent direct access

class ShoppFacebook {

		// Class variables

		public $sflb_settings; 	// store old settings as array
		public $share;			// display button 'like', 'likeshare', 'share'
		public $layout;			// standard, button_count, or box_count
		public $show_faces;		// display facebook avatar 'true', or 'false'
		public $width;			// width of button default 450px
		public $action;			// text on button, options 'like', or 'recommend'
		public $font;			// font to use, options are arial, lucida grande, segoe ui, tahoma, trebuchet ms, verdana 
		public $colorscheme;	// display colorscheme options 'light', or 'dark'
		public $kiddirected;	// web site or online service, or a portion of your service, is directed to children under 13
		public $ref;			// label for tracking referrals (max 50 characters)
		public $og_type;		// Open Graph Tag type
		public $og_image_size;	// Open Graph Tag image size
		public $og_fb_type;		// Open Graph Tag Facebook ID type
		public $og_fb_id;		// Open Graph Tag Facebook ID
		public $meta_table;		// shopp_meta table
		public $defaults;

		function ShoppFacebook() {
			// table setting
			global $wpdb;
        	$p = $wpdb->prefix;

        	$this->meta_table		= $p.'shopp_meta';
			$this->sflb_settings	= array();

			//default settings
			$this->defaults = array(
			'share' 		=> 'like',
			'layout'		=> 'standard',
			'show_faces'	=> 'false',
			'width'			=> '450',
			'action'		=> 'like',
			'font'			=> 'arial',
			'colorscheme'	=> 'light',
			'kiddirected'	=> 'false',
			'ref'			=> '',
			'og_fb_type'	=> 'product',
			'og_image_size'	=> '96',
			'og_fb_type'	=> 'admins',
			'og_fb_id'		=> ''
			);
		}		

	function shopp_facebook_settings_page() {

		if ( ! empty($_POST['save']) ) {
		    check_admin_referer('shopp-facebook');
            shopp_set_formsettings();
			$updated = __('Facebook Like settings saved.','sflb');
		}

		include("settings.php");
	}

   	function load_settings(){

		//update from prior versions
		$this->sflb_settings = get_option('sflb_options');

		if ( ! empty($sflb_settings) ) {
			$this->convert_old_settings($sflb_settings);
			delete_option('sflb_options');
		}
		
		$this->check_settings();
	}

	function convert_old_settings( $args) {
		//convert settings from prior versions to Shopp settings
		foreach ($args as $key => $value) {
			if ( 'send' == $key ) {
				$key = 'share';
				if ( 'false' == $value ) $value = 'like';
				if ( 'true' == $value ) $value = 'likeshare';
			}
			shopp_set_setting( 'sflb_'.$key, $value);
		}
	}

	function check_settings(){
		$query = "SELECT name, value
					FROM $this->meta_table
					WHERE name LIKE 'sflb_%'";
		$result = sDB::query($query, 'array');

		if ( ! $result ) return;

		$options = array();
		foreach ( $result as $option ) $options[str_replace('sflb_', '', $option->name)] = $option->value;

		$results = array_merge($this->defaults, $options);

		foreach ($results as $key => $value) $this->{$key} = $value;

	}
}
?>