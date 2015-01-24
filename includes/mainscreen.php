<?php
/**
*
* Mainscreen for ShoppExtra Menu and Shopp Facebook Like Button
*
*/

defined( 'WPINC' ) || header( 'HTTP/1.1 403' ) & exit;

class ShoppFacebookScreen{

   	function __construct(){
      	add_action( 'shopp_init', array( &$this, 'init' ) );
   	}

   	function init(){
      	add_action('admin_menu', array(&$this, 'add_menu'));
		$sflb_admin_nonce = wp_create_nonce('sflb_admin');
   	}

   	function add_menu(){
		// Add settings page to the Shopp menu
		global $SDC;

		if( isset($SDC['pages']['shoppExtraMenu'])){
      			add_submenu_page('shopp-extra', 'Shopp Facebook', 'Shopp Facebook', (defined('SHOPP_USERLEVEL') ? SHOPP_USERLEVEL : 'shopp_financials'), 'shopp-facebook', array($this, 'sflb_create_page'));
		} else {
      			add_menu_page( 'Shopp Extra', 'Shopp Extra',(defined('SHOPP_USERLEVEL') ? SHOPP_USERLEVEL : 'shopp_financials'), 'shopp-extra',array($this,'shoppExtraMenuPage'),'',53);
      			add_submenu_page('shopp-extra', 'Shopp Facebook', 'Shopp Facebook', (defined('SHOPP_USERLEVEL') ? SHOPP_USERLEVEL : 'shopp_financials'), 'shopp-facebook', array($this, 'sflb_create_page'));
		        $SDC['pages']['shoppExtraMenu'] = 'present';
		}

    }

	function shoppExtraMenuPage() {
		if (! current_user_can('shopp_financials') ) wp_die( __('You do not have sufficient permissions to access this page.', 'sflb') );

		echo "<div class='wrap shopp'>";
		echo "<div id='icon-options-general' class='icon32'><br /></div>";
		echo "<h2>".__( 'Shoppdeveloper.com - Main Plugin Page', 'sflb' )."</h2>";
		echo "<table class='form-table'>";
		echo "<tbody>";
		echo "<tr>";
		echo "<th scope='row' valign='top'><label for='introduction'>".__( 'Introduction:','sflb')."</label></th>";
		echo "<td width='500px'>";
		echo "<p>".__('The Shopp Extra menu facilitates plugins created by', 'sflb')." <a href='http://www.shoppdeveloper.com' title='Shoppdeveloper.com website'>Shoppdeveloper.com</a>.</p>";
		echo "<p>".__('We\'d love to hear what you like or don\'t like about our plugins','sflb').".<BR />
			".__('What works and what doesn\'t','sflb').".</p>";
		echo "<BR />";
		echo "<p>".__('Thanks in advance','sflb').".</p>";
		echo "<p></p>";
		echo "<p>Shoppdeveloper.com Team</p>";
		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "</tr>";
		include('other_plugins.php');
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	} // End function shoppExtraMenuPage

    function sflb_create_page(){
      $sflb_page = new ShoppFacebook();
      $sflb_page->shopp_facebook_settings_page();
    }

} // end class

$sflb_Page = new ShoppFacebookScreen();
?>