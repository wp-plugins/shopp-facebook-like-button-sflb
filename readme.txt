=== Shopp Facebook Like Button ===
Contributors: Shoppdeveloper.com
Donate link: http://www.shoppdeveloper.com/
Tags: shopp, products, ecommerce, webshop, facebook, like, plugin
Requires at least: 2.0.2
Tested up to: 4.1.1
Stable tag: 1.3.1
Author: Shoppdeveloper.com
Author URI: http://www.shoppdeveloper.com
License: GPLv2

Add the Facebook Like-Button to your Shopp product pages. The link on Facebook will link back to the actual product page.

== Description ==

With this plugin installed you can supply your customers with the Facebook Like-button. The link provided on Facebook will redirect to the actual product page. When you use Open Graph Tags as well, an image and description will be displayed on Facebook.

Make sure you download the correct version.

- Shopp version 1.1.x - download 1.0
- Shopp version 1.2.x - download 1.2
- Shopp version 1.3.x - download most current

(Older versions can be found in Changelog)

== Installation ==

Download and install the plugin through your WordPress Admin Panel, or

1. Dowload the right plugin zip-file. (Version 1.0 for Shopp 1.1.9, version 1.2 for Shopp 1.2.x, 1.3 for Shopp 1.3.x)
2. Unzip the zip-file.
3. Upload the folder to the `/wp-content/plugins/` directory
4. The plugin is NOT going to change or edit your Shopp files, but just to be sure, back up your files and database.
5. Activate the plugin through the 'Plugins' menu in WordPress
6. Put `<?php shopp('product','facebook'); ?>` in your Shopp product.php template file.
7. Adjust the settings on the settings page (Shopp Extra, Shopp Facebook)
8. Supply <a href='Plugin URI: http://www.shoppdeveloper.com/shopp-facebook-like-button-plugin/' title='Shoppdeveloper.com feedback for Facebook Like Button Plugin'>Feedback</a>. We'd love to hear from you!
 
== Frequently Asked Questions ==

= Will the plugin work without Shopp installed? =

No. Without Shopp installed, the plugin will be useless.

= Will the plugin change or edit my Shopp pages or products? =

No. You will have to add the tag mentioned in the installation instructions but that is it. The plugin will store the settings of the settings page in the database. No other data is written or saved anywhere.

= Can I change the settings for the CSS-classes used? =

Sure. You can override them in your own stylesheet or change the settings in sflb.css. The file is present in the plugin folder.

= Is there a translation available? =

There is not much text in this plugin but a .pot file is included so you can translate the phrases to your needs.
The plugin is in English. Dutch language files are already present. Checkout the /languages folder.

= What version of Shopp do I need? =

This 1.3.1 version of the plugin has been tested with Shopp 1.3.x. There are two other versions available one for Shopp version 1.1.x and one for Shopp version 1.2.x.

== Screenshots ==

1. Settings page in Admin Panel (1.0 and 1.2)
2. Settings page in Admin Panel (1.3.x)
3. Where the code goes in product.php
4. What it can look like on the product page of your Shopp webshop. Settings page settings will change the display of the Facebook Like link.

== Changelog ==
= 1.3.1 =
Fixed a bug which occured when no settings have been saved
Adjusted settings page layout
Added screenshot for 1.3.x
Adjusted images to WP asset system

= 1.3 =
New version to work with Shopp 1.3.x. No need to update if you are using a Shopp version prior to Shopp 1.3

= 1.2 =
New version to work with Shopp 1.2r6 beta. No need to update if you are not using the 1.2 (beta) version of Shopp. Due to changes to the Shopp Menu (in Admin Panel) we have added the 'Shopp Extra' parent menu which will facilitate all our Shopp plugins. 

= 1.0 =
First version on WordPress.com SVN 

= 0.1 =
First version. Ready to go live.

== Upgrade Notice ==
= 1.3.1 =
Bug fix for new installs

= 1.3 =
New version to work with Shopp 1.3.x. No need to update if you are not using the 1.3.x version of Shopp.

= 1.2 =
New version to work with Shopp 1.2r6 beta. No need to update if you are not using the 1.2 (beta) version of Shopp.

= 1.0 =
First version on WordPress.com SVN 