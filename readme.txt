=== Shopp Facebook Like Button ===
Contributors: Shoppdeveloper.com
Donate link: http://www.shoppdeveloper.com/
Tags: shopp,products,ecommerce,webshop,facebook,like,plugin
Requires at least: 2.0.2
Tested up to: 3.2.1
Stable tag: 1.0

Add the Facebook Like-Button to your Shopp product pages. The link on Facebook will link back to the product.

== Description ==

With this plugin installed you can supply your customers with the Facebook Like-button. The link provided will redirect to the product page, instead of to the Shopp main page.

== Installation ==

1. Unzip the plugin file.
1. Upload the folder to the `/wp-content/plugins/` directory
2. The plugin is NOT going to change or edit your Shopp files, but just to be sure, back up your files and database.
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Put `<?php shopp('product','facebook'); ?>` in your Shopp product.php template file.
 
== Frequently Asked Questions ==

= Will the plugin work without Shopp installed? =

No. Without Shopp installed, the plugin will be useless.

= Will the plugin change or edit my Shopp pages or products? =

No. You will have to add the tag mentioned above but that is it. The plugin will store the settings of the settings page in the database. No other data is written or saved anywhere.

= Can I change the settings for the CSS-classes used? =

Sure. You can override them in your own stylesheet or change the settings in sflb.css. The file is present in the plugin folder.

= Is there a translation available? =

There is not much text in this plugin but a .pot file is included so you can translate the phrases to your needs.
The plugin is in English. Dutch language files are already present. Checkout the /languages folder.

= What version of Shopp do I need? =

The plugin has been tested with Shopp version 1.1.9. We'll update the plugin for Shopp 1.2 once it is released.

== Screenshots ==

1. Settings page in Admin Panel
2. Where the code goes in product.php
3. What it looks like on the product page of your webshop

== Changelog ==

= 1.0 =
First version on WordPress.com SVN 

= 0.1 =
First version. Ready to go live.

== Upgrade Notice ==

= 1.0 =
First version on WordPress.com SVN 

