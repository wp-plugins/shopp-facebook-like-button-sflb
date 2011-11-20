<?php
/*
* SFLB options - Provides Shopp Facebook Like Button (sflb) option page in Shopp menu.
*
* @version 1.0
* @since 0.1
* @package sflb
* @subpackage sflb-options
*
*/

/*
 *
 * @author Shoppdeveloper.com
 * @since 0.1
 *
 */



class SFLBSettingsPage{
	function SFLB_settingspage(){
		$this->__construct();
	}

   	function __construct(){
      		add_action('shopp_init', array(&$this, 'init'));
   	}

   	function init(){
      		add_action('admin_menu', array(&$this, 'add_menu'));
		$sflbError = FALSE;
   	}

   	function add_menu(){
		// Add settings page to the Shopp menu
		global $shoppExtraMenu;
		if($shoppExtraMenu == 'present'){
      			add_submenu_page('shopp-extra', 'Shopp sflb', 'Shopp sflb',(defined('SHOPP_USERLEVEL') ? SHOPP_USERLEVEL : 'manage_options'), 'sflb-settings', array($this, 'createPage_SFLB'));
		} else {
      			add_menu_page( 'Shopp Extra', 'Shopp Extra',(defined('SHOPP_USERLEVEL') ? SHOPP_USERLEVEL : 'manage_options'), 'shopp-extra',array($this,'shoppExtraMenuPage'),'',53);
      			add_submenu_page('shopp-extra', 'Shopp sflb', 'Shopp sflb',(defined('SHOPP_USERLEVEL') ? SHOPP_USERLEVEL : 'manage_options'), 'sflb-settings', array($this, 'createPage_SFLB'));
		$shoppExtraMenu = 'present';
		}	
   	}
	function shoppExtraMenuPage() {
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.','sppb') );
		}
		echo "<div class='wrap shopp'>";
		echo "<div id='icon-options-general' class='icon32'><br /></div>";
		echo "<h2>".__( 'Shoppdeveloper.com - Main Plugin Page', 'sflb' )."</h2>";
		echo "<table class='form-table'>";
		echo "<tbody>";
		echo "<tr>";
		echo "<th scope='row' valign='top'><label for='introduction'>".__( 'Introduction:','sppb')."</label></th>";
		echo "<td>";
		echo "<p>The Shopp Extra menu facilitates plugins created by <a href='http://www.shoppdeveloper.com' title='Shoppdeveloper.com website'>Shoppdeveloper.com</a>.</p>";
		echo "<p>You can find the plugins we have developed so far, on <a href='http://profiles.wordpress.org/users/Shoppdeveloper.com/' title='Shoppdeveloper.com on WordPress.org'>WordPress.org</a>.</p>";
		echo "<p>We'd love to hear what you like or don't like about our plugins.<br />
			What works and what doesn't.</p>";
		echo "<p></p>";
		echo "<p>Thanks in advance.</p>";
		echo "<p></p>";
		echo "<p>Shoppdeveloper.com Team</p>";
		echo "</td>";
		echo "</tr>";
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	} // End function shoppExtraMenuPage

   	function createPage_SFLB(){
		// variables 
		$sflb_options;		// array to store the settings
		$sflb_send;		// display send-button 'true', or 'false'
		$sflb_layout;		// standard, button_count, or box_count
		$sflb_show_faces;	// display facebook avatar 'true', or 'false'
		$sflb_width;		// width of button default 450px
		$sflb_action;		// text on button, options 'like', or 'recommend'
		$sflb_font;		// font to use, options are arial,lucida grande,
					// segoe ui,tahoma,trebuchet ms,verdana 
		$sflb_colorscheme;	// display colorscheme options 'light', or 'dark'
		$sflb_ref;		// label for tracking referrals (max 50 characters)
		$sflb_og_type;		// Open Graph Tag type
		$sflb_og_image_size;	// Open Graph Tag image size
		$sflb_og_fb_type;	// Open Graph Tag Facebook ID type
		$sflb_og_fb_id;		// Open Graph Tag Facebook ID
		$sflb_submit_hidden;	// flag to save new settings

		// Read existing option values from database, use default value if empty.
		$sflb_options		= get_option( 'sflb_options' );
		$sflb_send		= ($sflb_options['send'] == '')?'false':$sflb_options['send'];
		$sflb_layout		= ($sflb_options['layout'] == '')?'standard':$sflb_options['layout'];
		$sflb_show_faces 	= ($sflb_options['show_faces'] == '')?'false':$sflb_options['show_faces'];
		switch($sflb_layout){
			case 'standard':
				$sflb_width	= ($sflb_options['width'] == '')?'450':$sflb_options['width'];
				break;
			case 'button_count':
				$sflb_width	= ($sflb_options['width'] == '')?'90':$sflb_options['width'];
				break;
			case 'box_count':
				$sflb_width	= ($sflb_options['width'] == '')?'55':$sflb_options['width'];
				break;
		}
		$sflb_action		= ($sflb_options['action'] == '')?'like':$sflb_options['action'];
		$sflb_font	 	= ($sflb_options['font'] == '')?'arial':$sflb_options['font'];
		$sflb_colorscheme 	= ($sflb_options['colorscheme'] == '')?'light':$sflb_options['colorscheme'];
		$sflb_ref	 	= $sflb_options['ref'];	
		$sflb_ref		= ($sflb_ref == '')?'':substr($sflb_ref,50);
		$sflb_og_type		= ($sflb_options['og_type'] == '')?'product':$sflb_options['og_type'];
		$sflb_og_image_size	= (($sflb_options['og_image_size'] == '') || (intval($sflb_options['og_image_size']) < 50))?'96':$sflb_options['og_image_size'];
		$sflb_og_fb_type	= ($sflb_options['og_fb_type'])?'admins':$sflb_options['og_fb_type'];
		$sflb_og_fb_id		= $sflb_options['og_fb_id'];

		// If changes are made, this hidden field will be set to 'Y'
		if(isset($_POST[ 'sflb_submit_hidden' ]) && $_POST[ 'sflb_submit_hidden' ] == 'Y' ) {

			// Read values entered in the form
			$sflb_send 		= $_POST[ 'sflb_send'];
			$sflb_layout 		= $_POST[ 'sflb_layout'];
			$sflb_show_faces 	= $_POST[ 'sflb_show_faces'];
			$sflb_width 		= $_POST[ 'sflb_width'];
			$sflb_action	 	= $_POST[ 'sflb_action'];
			$sflb_font	 	= $_POST[ 'sflb_font'];
			$sflb_colorscheme 	= $_POST[ 'sflb_colorscheme'];
			$sflb_ref	 	= $_POST[ 'sflb_ref'];
			$sflb_ref		= stripslashes(str_replace('"','&quot;',$sflb_ref));
			$sflb_og_type		= $_POST[ 'sflb_og_type'];
			$sflb_og_image_size	= $_POST[ 'sflb_og_image_size'];
			$sflb_og_fb_type	= $_POST[ 'sflb_og_fb_type'];
			$sflb_og_fb_id		= $_POST[ 'sflb_og_fb_id'];

			// Check the posted values
			$sflb_options['send']		= $sflb_send;
			$sflb_options['layout']		= $sflb_layout;
			$sflb_options['show_faces'] 	= $sflb_show_faces;
			switch($sflb_options['layout']){
				case 'standard':
					$sflb_width	= (($sflb_width == '') || (intval($sflb_width)<450))?'450':$sflb_width;
					break;
				case 'button_count':
					$sflb_width	= (($sflb_width == '') || (intval($sflb_width)<90))?'90':$sflb_width;
					break;
				case 'box_count':
					$sflb_width	= (($sflb_width == '') || (intval($sflb_width)<55))?'55':$sflb_width;
					break;
			}
			$sflb_options['width']		= $sflb_width;
			$sflb_options['action']		= $sflb_action;
			$sflb_options['font']	 	= $sflb_font;
			$sflb_options['colorscheme'] 	= $sflb_colorscheme;
			$sflb_options['ref']	 	= $sflb_ref;
			$sflb_options['og_type']	= $sflb_og_type;
			$sflb_options['og_image_size']	= $sflb_og_image_size;
			$sflb_options['og_fb_type']	= $sflb_og_fb_type;
			$sflb_options['og_fb_id']	= $sflb_og_fb_id;

			// Save the posted values
			update_option( 'sflb_options', $sflb_options );

    		// Put an options updated message on the screen
			if($this->sflbError){
				$errorMessage = __('Some invalid input has been discarded.','sflb');
			}
?>
      			<div id="message" class="updated fade">
        			<p><strong><?php _e( 'Options saved.', 'sflb' );echo " ".$errorMessage; ?></strong></p>
      			</div>
<?php
		} //endif
?>
		<div class="wrap shopp">
			<div id="icon-options-general" class="icon32"><br /></div>
				<h2><?php _e( 'Shopp Facebook Like Button (sflb) Settings', 'sflb' ); ?></h2>
				<form name="sflb_settings" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
					<input type="hidden" name="sflb_submit_hidden" value="Y">
					<table class="form-table">
						<tbody>
							<tr>
								<th scope="row" valign="top"><label for="send"><?php _e( 'Send:','sflb'); ?></label></th>
								<td>
									<select name="sflb_send">
                							<option value="false" <?php echo ($sflb_send == "false") ? 'selected' : ''; ?> /><?php _e( 'No', 'sflb');?></option>  
									<option value="true" <?php echo ($sflb_send == "true") ? 'selected' : ''; ?> /><?php _e( 'Yes', 'sflb'); ?></option>
									</select>
									<?php _e('Display a Send button next to the Like button.','sflb'); ?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="layout"><?php _e( 'Layout:','sflb'); ?></label></th>
								<td>
									<select name="sflb_layout">
									<option value="standard" <?php echo ($sflb_layout == "standard") ? 'selected' : ''; ?> /><?php _e( 'Standard', 'sflb');?></option> 
									<option value="button_count" <?php echo ($sflb_layout == "button_count") ? 'selected' : ''; ?> /><?php _e( 'Button Count', 'sflb'); ?></option> 
									<option value="box_count" <?php echo ($sflb_layout == "box_count") ? 'selected' : ''; ?> /><?php _e( 'Box Count', 'sflb'); ?></option>
									</select>
									<?php _e( 'Default is Standard.','sflb' );?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="width"><?php _e( 'Width:','sflb'); ?></label></th>
								<td>
									<input type="text" name="sflb_width" size="3" value="<?php echo $sflb_width; ?>" />
									<?php _e( 'Default/Minimum for Standard = 450, Button Count = 90, Box Count = 55.','sflb' );?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="show_faces"><?php _e( 'Show Faces:','sflb'); ?></label></th>
								<td>
									<select name="sflb_show_faces">
									<option  value="false" <?php echo ($sflb_show_faces == "false") ? 'selected' : ''; ?> /><?php _e( 'No', 'sflb');?></option>  
									<option value="true" <?php echo ($sflb_show_faces == "true") ? 'selected' : ''; ?> /><?php _e( 'Yes', 'sflb'); ?></option>
									</select>
									<?php _e('Display Facebook profile pictures of people who liked your product.','sflb'); ?>
								</td>
							</tr>

							<tr>
								<th scope="row" valign="top"><label for="action"><?php _e( 'Action:','sflb'); ?></label></th>
								<td>
									<select name="sflb_action">
									<option value="like" <?php echo ($sflb_action == "like") ? 'selected' : ''; ?> /><?php _e( 'Like', 'sflb');?></option> 
									<option value="recommend" <?php echo ($sflb_action == "recommend") ? 'selected' : ''; ?> /><?php _e( 'Recommend', 'sflb'); ?></option>
									</select>
									<?php _e('Specify the verb you want to display.','sflb'); ?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="font"><?php _e( 'Font:','sflb'); ?></label></th>
								<td>
									<select name="sflb_font">
									<option value="arial" <?php echo ($sflb_font == "arial") ? 'selected' : ''; ?> /><?php _e( 'Arial', 'sflb'); ?></option>
<option value="lucida grande" <?php echo ($sflb_font == "lucida grande") ? 'selected' : ''; ?> /><?php _e( 'Lucida Grande', 'sflb'); ?></option> 
<option value="segoe ui" <?php echo ($sflb_font == "segoe ui") ? 'selected' : ''; ?> /><?php _e( 'Segoe ui', 'sflb'); ?></option>
<option value="tahoma" <?php echo ($sflb_font == "tahoma") ? 'selected' : ''; ?> /><?php _e( 'Tahoma', 'sflb'); ?></option> 
<option value="trebuchet ms" <?php echo ($sflb_font == "trebuchet ms") ? 'selected' : ''; ?> /><?php _e( 'Trebuchet ms', 'sflb'); ?></option>
<option value="verdana" <?php echo ($sflb_font == "verdana") ? 'selected' : ''; ?> /><?php _e( 'Verdana', 'sflb'); ?></option> 
									</select>
									<?php _e( "Specify the font you want to use.",'sflb'); ?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="colorscheme"><?php _e( 'Colorscheme:','sflb'); ?></label></th>
								<td>
									<select name="sflb_colorscheme">
									<option value="light" <?php echo ($sflb_colorscheme == "light") ? 'selected' : ''; ?> /><?php _e( 'Light', 'sflb');?></option> 
									<option value="dark" <?php echo ($sflb_colorscheme == "dark") ? 'selected' : ''; ?> /><?php _e( 'Dark', 'sflb'); ?></option>
									</select>
									<?php _e( 'Select the colorscheme you want to use. Default is Light.','sflb' );?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="ref"><?php _e( 'Referrer:','sflb'); ?></label></th>
								<td>
                							<input type="text" name="sflb_ref" value="<?php echo $sflb_ref; ?>" maxlength="50" />
									<?php _e('Optional. Max. 50 characters.','sflb'); ?>
								</td>
							</tr>
							<tr>
							<th scope="row" valign="top" colspan="4"><label for="og"><h2><?php _e( 'Open Graph Tags','sflb'); ?></h2><br /><?php _e( 'If you want to use \'Open Graph Tags\', you need to specify all *-marked fields.','sflb'); ?></label></th>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="og_type"><?php _e( 'Type','sflb'); ?>*:</label></th>
								<td>
									<select name="sflb_og_type">
                							<option value="activity" <?php echo ($sflb_og_type == "activity") ? 'selected' : ''; ?> /><?php _e( 'Activity', 'sflb');?></option>
									<option value="actor" <?php echo ($sflb_og_type == "actor") ? 'selected' : ''; ?> /><?php _e( 'Actor', 'sflb');?></option>
									<option value="album" <?php echo ($sflb_og_type == "album") ? 'selected' : ''; ?> /><?php _e( 'Album', 'sflb');?></option>
									<option value="article" <?php echo ($sflb_og_type == "article") ? 'selected' : ''; ?> /><?php _e( 'Article', 'sflb');?></option>
									<option value="athlete" <?php echo ($sflb_og_type == "athlete") ? 'selected' : ''; ?> /><?php _e( 'Athlete', 'sflb');?></option>
									<option value="author" <?php echo ($sflb_og_type == "author") ? 'selected' : ''; ?> /><?php _e( 'Author', 'sflb');?></option>
									<option value="band" <?php echo ($sflb_og_type == "band") ? 'selected' : ''; ?> /><?php _e( 'Band', 'sflb');?></option>
									<option value="bar" <?php echo ($sflb_og_type == "bar") ? 'selected' : ''; ?> /><?php _e( 'Bar', 'sflb');?></option>
									<option value="blog" <?php echo ($sflb_og_type == "blog") ? 'selected' : ''; ?> /><?php _e( 'Blog', 'sflb');?></option>
									<option value="book" <?php echo ($sflb_og_type == "book") ? 'selected' : ''; ?> /><?php _e( 'Book', 'sflb');?></option>
									<option value="cafe" <?php echo ($sflb_og_type == "cafe") ? 'selected' : ''; ?> /><?php _e( 'Cafe', 'sflb');?></option>
									<option value="cause" <?php echo ($sflb_og_type == "cause") ? 'selected' : ''; ?> /><?php _e( 'Cause', 'sflb');?></option>
									<option value="city" <?php echo ($sflb_og_type == "city") ? 'selected' : ''; ?> /><?php _e( 'City', 'sflb');?></option>
									<option value="company" <?php echo ($sflb_og_type == "company") ? 'selected' : ''; ?> /><?php _e( 'Company', 'sflb');?></option>
									<option value="country" <?php echo ($sflb_og_type == "country") ? 'selected' : ''; ?> /><?php _e( 'Country', 'sflb');?></option>
									<option value="director" <?php echo ($sflb_og_type == "director") ? 'selected' : ''; ?> /><?php _e( 'Director', 'sflb');?></option>
									<option value="drink" <?php echo ($sflb_og_type == "drink") ? 'selected' : ''; ?> /><?php _e( 'Drink', 'sflb');?></option>
									<option value="food" <?php echo ($sflb_og_type == "food") ? 'selected' : ''; ?> /><?php _e( 'Food', 'sflb');?></option>
									<option value="game" <?php echo ($sflb_og_type == "game") ? 'selected' : ''; ?> /><?php _e( 'Game', 'sflb');?></option>
									<option value="government" <?php echo ($sflb_og_type == "government") ? 'selected' : ''; ?> /><?php _e( 'Government', 'sflb');?></option>
									<option value="hotel" <?php echo ($sflb_og_type == "hotel") ? 'selected' : ''; ?> /><?php _e( 'Hotel', 'sflb');?></option>
									<option value="landmark" <?php echo ($sflb_og_type == "landmark") ? 'selected' : ''; ?> /><?php _e( 'Landmark', 'sflb');?></option>
									<option value="movie" <?php echo ($sflb_og_type == "movie") ? 'selected' : ''; ?> /><?php _e( 'Movie', 'sflb');?></option>
									<option value="musician" <?php echo ($sflb_og_type == "musician") ? 'selected' : ''; ?> /><?php _e( 'Musician', 'sflb');?></option>
									<option value="non_profit" <?php echo ($sflb_og_type == "non_profit") ? 'selected' : ''; ?> /><?php _e( 'Non Profit', 'sflb');?></option>
									<option value="politician" <?php echo ($sflb_og_type == "politician") ? 'selected' : ''; ?> /><?php _e( 'Politician', 'sflb');?></option>
									<option value="product" <?php echo ($sflb_og_type == "product") ? 'selected' : ''; ?> /><?php _e( 'Product', 'sflb');?></option>
									<option value="public_figure" <?php echo ($sflb_og_type == "public_figure") ? 'selected' : ''; ?> /><?php _e( 'Public Figure', 'sflb');?></option>
									<option value="restaurant" <?php echo ($sflb_og_type == "restaurant") ? 'selected' : ''; ?> /><?php _e( 'Restaurant', 'sflb');?></option>
									<option value="school" <?php echo ($sflb_og_type == "school") ? 'selected' : ''; ?> /><?php _e( 'School', 'sflb');?></option>
									<option value="song" <?php echo ($sflb_og_type == "song") ? 'selected' : ''; ?> /><?php _e( 'Song', 'sflb');?></option>
									<option value="sport" <?php echo ($sflb_og_type == "sport") ? 'selected' : ''; ?> /><?php _e( 'Sport', 'sflb');?></option>
									<option value="sports_league" <?php echo ($sflb_og_type == "sports_league") ? 'selected' : ''; ?> /><?php _e( 'Sports League', 'sflb');?></option>
									<option value="sports_team" <?php echo ($sflb_og_type == "sports_team") ? 'selected' : ''; ?> /><?php _e( 'Sports Team', 'sflb');?></option>
									<option value="state_province" <?php echo ($sflb_og_type == "state_province") ? 'selected' : ''; ?> /><?php _e( 'State Province', 'sflb');?></option>
									<option value="tv_show" <?php echo ($sflb_og_type == "tv_show") ? 'selected' : ''; ?> /><?php _e( 'TV Show', 'sflb');?></option>
									<option value="university" <?php echo ($sflb_og_type == "university") ? 'selected' : ''; ?> /><?php _e( 'University', 'sflb');?></option>
									<option value="website" <?php echo ($sflb_og_type == "website") ? 'selected' : ''; ?> /><?php _e( 'Website', 'sflb');?></option>
								</select>
								<?php _e('Chose a type. Default is \'product\'.','sflb'); ?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="og_image_size"><?php _e( 'Size of Image:','sflb'); ?></label></th>
								<td>
                							<input type="text" name="sflb_og_image_size" value="<?php echo $sflb_og_image_size; ?>" size="3"/>
									<?php _e('Specify the size of the image to use. Default is 96, minimum is 50.','sflb'); ?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="og_fb_type"><?php _e( 'Type of ID','sflb'); ?>*:</label></th>
								<td>
									<select name="sflb_og_fb_type">
                							<option value="admins" <?php echo ($sflb_og_fb_type == "admins") ? 'selected' : ''; ?> /><?php _e( 'Facebook ID', 'sflb');?></option>  
									<option value="app_id" <?php echo ($sflb_og_fb_type == "app_id") ? 'selected' : ''; ?> /><?php _e( 'Facebook Platform application ID', 'sflb'); ?></option>
									</select>
									<?php _e( 'Default is Facebook ID.','sflb' );?>
								</td>
							</tr>
							<tr>
								<th scope="row" valign="top"><label for="og_fb_id"><?php _e( 'ID-number(s)','sflb'); ?>*:</label></th>
								<td>
                							<input type="text" name="sflb_og_fb_id" value="<?php echo $sflb_og_fb_id; ?>" /><br />
									<?php _e('Comma separate multiple ID\'s.','sflb'); ?>
								</td>
							</tr>
						</tbody>
					</table>
					<p class="submit"><input type="submit" class="button-primary" name="save" value="<?php _e('Save Changes','sflb'); ?>"></p>
				</form>

<?php
   			} //End of IF-statement

} // End of Class


?>