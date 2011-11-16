<?php
/*
Plugin Name: Shopp Facebook Like Button (sflb)
Plugin URI: http://www.shoppdeveloper.com
Donate link: http://www.shoppdeveloper.com
Description: This plugin adds the Facebook Like-button to the Shopp Product Pages of your Shopp webshop.
Version: 1.0
Author: Shoppdeveloper.com
Author URI: http://www.shoppdeveloper.com
License: GPLv2


    Copyright 2011 Shoppdeveloper.com  (email : support@shoppdeveloper.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once( 'sflb-functions.php' );
require_once( 'sflb-output.php' );


if( is_admin() ) {
	// settings page for Administrator only
	require_once( 'sflb-options.php' );
	global $sflbSettingsPage;
	$sflbSettingsPage = new SFLBSettingsPage;
}

add_action('wp_head','sflb_add_facebook_open_graph_tags');

add_sflb_stylesheet();

add_filter('shopp_tag_product_facebook','sflb',10,3);

add_action( 'init', 'sflb_languages' );

 
?>