<?php
/*
*
* SFLB options - Provides Shopp Facebook Like Button (sflb) option page in Shopp Extra menu.
*
*/
?>

<div class="wrap shopp">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2><?php _e( 'Shopp Facebook Like Button (sflb) Settings', 'sflb' ); ?></h2>

<?php	global $Shopp;

		$shopp_first_run = shopp_setting('display_welcome');

    	// Check for Shopp version and Shopp mode
		if (SHOPP_VERSION >= '1.3') {
	    	$errors = array();
        	$errors['start'] = array(); // errors on Shopp mode

			if (isset($shopp_first_run) ) {
            	if ("off" != $shopp_first_run) $errors['start'][] = 'Shopp first run status should read "off" your Shopp first run mode status reads '.$shopp_first_run.'. <BR />';
			} else {
		    	$errors['start'][] = 'Could not read Shopp first run mode status from database. <BR />';
			}

		} else {
	    	exit("<h2>Shopp Facebook Like Button</h2><p>This version of the Shopp Facebook plug-in needs Shopp version 1.3 or higher.<br />
	    	Please update to Shopp version 1.3 or higher, or download the Shopp Facebook plug-in version that matches your Shopp version from wordpress.org.</p>");
			return false;
		}

    	if ( ! empty($errors['start']) ){
        	$can_not_Start = '<p>Fix the following errors: <p />';

        	foreach ( $errors['start'] as $error ){
            	$can_not_start .= $error.'<br />';
        	}

			exit("<h2>Shopp Facebook Like Button</h2><p>Could not start due to some Shopp settings.</p>".$can_not_start);
			return false;
		}

		$this->load_settings();
		$og_types = array(
					"activity" 			=> __( 'Activity', 'sflb'),
					"actor" 			=> __( 'Actor', 'sflb'),
					"album" 			=> __( 'Album', 'sflb'),
					"article" 			=> __( 'Article', 'sflb'),
					"athlete" 			=> __( 'Athlete', 'sflb'),
					"author" 			=> __( 'Author', 'sflb'),
					"band"				=> __( 'Band', 'sflb'),
					"bar" 				=> __( 'Bar', 'sflb'),
					"blog" 				=> __( 'Blog', 'sflb'),
					"book" 				=> __( 'Book', 'sflb'),
					"cafe" 				=> __( 'Cafe', 'sflb'),
					"cause" 			=> __( 'Cause', 'sflb'),
					"city" 				=> __( 'City', 'sflb'),
					"company" 			=> __( 'Company', 'sflb'),
					"country" 			=> __( 'Country', 'sflb'),
					"director" 			=> __( 'Director', 'sflb'),
					"drink" 			=> __( 'Drink', 'sflb'),
					"food" 				=> __( 'Food', 'sflb'),
					"game" 				=> __( 'Game', 'sflb'),
					"government" 		=> __( 'Government', 'sflb'),
					"hotel" 			=> __( 'Hotel', 'sflb'),
					"landmark" 			=> __( 'Landmark', 'sflb'),
					"movie" 			=> __( 'Movie', 'sflb'),
					"musician" 			=> __( 'Musician', 'sflb'),
					"non_profit" 		=> __( 'Non Profit', 'sflb'),
					"politician" 		=> __( 'Politician', 'sflb'),
					"product" 			=> __( 'Product', 'sflb'),
					"public_figure" 	=> __( 'Public Figure', 'sflb'),
					"restaurant" 		=> __( 'Restaurant', 'sflb'),
					"school" 			=> __( 'School', 'sflb'),
					"song" 				=> __( 'Song', 'sflb'),
					"sport" 			=> __( 'Sport', 'sflb'),
					"sports_league" 	=> __( 'Sports League', 'sflb'),
					"sports_team" 		=> __( 'Sports Team', 'sflb'),
					"state_province" 	=> __( 'State Province', 'sflb'),
					"tv_show" 			=> __( 'TV Show', 'sflb'),
					"university" 		=> __( 'University', 'sflb'),
					"website" 			=> __( 'Website', 'sflb')
				);
	?>				
	<form enctype="multipart/form-data" name="settings" id="general" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">
		<?php wp_nonce_field('shopp-facebook'); ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row" valign="top"><label for="send"><?php _e( 'Share:','sflb'); ?></label></th>
					<td>
						<select name="settings[sflb_share]" id="sflb_share">
   							<option value="like" <?php echo ('like' == $this->share ) ? 'selected' : ''; ?> /><?php _e( 'Like', 'sflb');?></option>  
							<option value="likeshare" <?php echo ( 'likeshare' == $this->share ) ? 'selected' : ''; ?> /><?php _e( 'Like and Share', 'sflb'); ?></option>
							<option value="share" <?php echo ( 'share' == $this->share ) ? 'selected' : ''; ?> /><?php _e( 'Share', 'sflb'); ?></option>
						</select>
						<?php _e('Select which button to display.','sflb'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="layout"><?php _e( 'Layout:','sflb'); ?></label></th>
					<td>
						<select name="settings[sflb_layout]" id="sflb_layout">
							<option value="standard" <?php echo ( 'standard' == $this->layout ) ? 'selected' : ''; ?> <?php echo ( 'share' == $this->share ) ? 'disabled' : ''; ?> /><?php _e( 'Standard', 'sflb');?></option> 
							<option value="button_count" <?php echo ( 'button_count' == $this->layout ) ? 'selected' : ''; ?> /><?php _e( 'Button Count', 'sflb'); ?></option> 
							<option value="box_count" <?php echo ( 'box_count' == $this->layout ) ? 'selected' : ''; ?> /><?php _e( 'Box Count', 'sflb'); ?></option>
							<option value="button" <?php echo ( 'button' == $this->layout ) ? 'selected' : ''; ?> /><?php _e( 'Button', 'sflb'); ?></option>
							<option value="link" <?php echo ( 'link' == $this->layout ) ? 'selected' : ''; ?> <?php echo ( 'share' != $this->share ) ? 'disabled' : ''; ?> /><?php _e( 'Link', 'sflb'); ?></option>
							<option value="icon_link" <?php echo ( 'icon_link' == $this->layout ) ? 'selected' : ''; ?> <?php echo ( 'share' != $this->share ) ? 'disabled' : ''; ?> /><?php _e( 'Icon Link', 'sflb'); ?></option>
							<option value="icon" <?php echo ( 'icon' == $this->layout ) ? 'selected' : ''; ?> <?php echo ( 'share' != $this->share ) ? 'disabled' : ''; ?> /><?php _e( 'Icon', 'sflb'); ?></option>
						</select>
						<?php _e( 'Default for Like is Standard. Default for Share is Icon Link.','sflb' );?>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="width"><?php _e( 'Width:','sflb'); ?></label></th>
					<td>
						<input type="text" name="settings[sflb_width]" id="sflb_width" size="3" value="<?php echo $this->width; ?>" />
						<?php _e( 'Minimum for Standard = 450, Button Count = 90, Box Count = 55, Button = 47.','sflb' );?>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="show_faces"><?php _e( 'Show Faces:','sflb'); ?></label></th>
					<td>
						<select name="settings[sflb_show_faces]" id="sflb_show_faces">
							<option  value="false" <?php echo ( 'false' == $this->show_faces ) ? 'selected' : ''; ?> /><?php _e( 'No', 'sflb');?></option>  
							<option value="true" <?php echo ( 'true' == $this->show_faces ) ? 'selected' : ''; ?> /><?php _e( 'Yes', 'sflb'); ?></option>
						</select>
						<?php _e('Display Facebook profile pictures of people who liked your product.','sflb'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="action"><?php _e( 'Action:','sflb'); ?></label></th>
					<td>
						<select name="settings[sflb_action]" id="sflb_action">
							<option value="like" <?php echo ( 'like' == $this->action ) ? 'selected' : ''; ?> /><?php _e( 'Like', 'sflb');?></option> 
							<option value="recommend" <?php echo ( 'recommend' == $this->action ) ? 'selected' : ''; ?> /><?php _e( 'Recommend', 'sflb'); ?></option>
						</select>
						<?php _e('Specify the verb you want to display.','sflb'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="font"><?php _e( 'Font:','sflb'); ?></label></th>
					<td>
						<select name="settings[sflb_font]" id="sflb_font">
							<option value="arial" <?php echo ( 'arial' == $this->font ) ? 'selected' : ''; ?> /><?php _e( 'Arial', 'sflb'); ?></option>
							<option value="lucida grande" <?php echo ( 'lucida grande' == $this->font ) ? 'selected' : ''; ?> /><?php _e( 'Lucida Grande', 'sflb'); ?></option> 
							<option value="segoe ui" <?php echo ( 'segoe ui' == $this->font ) ? 'selected' : ''; ?> /><?php _e( 'Segoe ui', 'sflb'); ?></option>
							<option value="tahoma" <?php echo ( 'tahoma' == $this->font ) ? 'selected' : ''; ?> /><?php _e( 'Tahoma', 'sflb'); ?></option> 
							<option value="trebuchet ms" <?php echo ( 'trebuchet ms' == $this->font ) ? 'selected' : ''; ?> /><?php _e( 'Trebuchet ms', 'sflb'); ?></option>
							<option value="verdana" <?php echo ( 'verdana' == $this->font ) ? 'selected' : ''; ?> /><?php _e( 'Verdana', 'sflb'); ?></option> 
						</select>
						<?php _e( "Specify the font you want to use.",'sflb'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="colorscheme"><?php _e( 'Colorscheme:','sflb'); ?></label></th>
					<td>
						<select name="settings[sflb_colorscheme]" id="sflb_colorscheme">
							<option value="light" <?php echo ( 'light' == $this->colorscheme ) ? 'selected' : ''; ?> /><?php _e( 'Light', 'sflb');?></option> 
							<option value="dark" <?php echo ( 'dark' == $this->colorscheme ) ? 'selected' : ''; ?> /><?php _e( 'Dark', 'sflb'); ?></option>
						</select>
						<?php _e( 'Select the colorscheme of your website. Default is Light.','sflb' );?>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="kiddirected"><?php _e( 'Kid Directed Content:','sflb'); ?></label></th>
					<td>
						<select name="settings[sflb_kiddirected]" id="sflb_kiddirected">
							<option value="false" <?php echo ( 'false' == $this->kiddirected ) ? 'selected' : ''; ?> /><?php _e( 'No', 'sflb');?></option> 
							<option value="true" <?php echo ( 'true' == $this->kiddirected ) ? 'selected' : ''; ?> /><?php _e( 'Yes', 'sflb'); ?></option>
						</select>
						<?php _e( 'Your web site or online service, or a portion of your service, is directed to children under 13. Default is No.','sflb' );?>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="ref"><?php _e( 'Tracking Referral:','sflb'); ?></label></th>
					<td>
            			<input type="text" name="settings[sflb_ref]" id="sflb_ref" value="<?php echo $this->ref; ?>" maxlength="50" />
						<?php _e('Optional. Max. 50 characters.','sflb'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top" colspan="4"><label for="og"><h2><?php _e( 'Open Graph Tags','sflb'); ?></h2><br /><?php _e( 'If you want to use \'Open Graph Tags\', you need to specify all *-marked fields.','sflb'); ?></label></th>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="og_type"><?php _e( 'Type','sflb'); ?>*:</label></th>
					<td>
						<select name="settings[sflb_og_type]" id="sflb_og_type">
							<?php if ( empty($this->og_type) ) $this->og_type = 'product'; ?>
							<?php 
								foreach( $og_types as $key => $value ) {
									if ($this->og_type == $key) echo "<option value='$key' selected='selected'>$value</option>";
									else echo "<option value='$key'>$value</option>";
								}
							?>

						</select>
						<?php _e('Chose a type. Default is \'product\'.','sflb'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="og_image_size"><?php _e( 'Size of Image:','sflb'); ?></label></th>
					<td>
						<input type="text" name="settings[sflb_og_image_size]" id="sflb_og_image_size" value="<?php echo $this->og_image_size; ?>" size="3"/>
						<?php _e('Specify the size of the image to use. Default is 96, minimum is 50.','sflb'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="og_fb_type"><?php _e( 'Type of ID','sflb'); ?>*:</label></th>
					<td>
						<select name="settings[sflb_og_fb_type]" id="sflb_og_fb_type">
							<option value="admins" <?php echo ( 'admins' == $this->og_fb_type ) ? 'selected' : ''; ?> /><?php _e( 'Facebook ID', 'sflb');?></option>  
							<option value="app_id" <?php echo ( 'app_id' == $this->og_fb_type ) ? 'selected' : ''; ?> /><?php _e( 'Facebook Platform application ID', 'sflb'); ?></option>
						</select>
						<?php _e( 'Default is Facebook ID.','sflb' );?>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top"><label for="og_fb_id"><?php _e( 'ID-number(s)','sflb'); ?>*:</label></th>
					<td>
    					<input type="text" name="settings[sflb_og_fb_id]" id="sflb_og_fb_id" value="<?php echo $this->og_fb_id; ?>" /><br />
						<?php _e('Comma separate multiple ID\'s.','sflb'); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" class="button-primary" name="save" value="<?php _e('Save Changes','sflb'); ?>"></p>
	</form>