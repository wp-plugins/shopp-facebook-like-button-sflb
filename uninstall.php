//remove sflb_options from database on plugin uninstall/delete
if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
    exit();
 
delete_option('sflb_options');
global $wpdb;
$query = "DELETE FROM {$wp->prefix}shopp_meta
		WHERE name LIKE 'sfbl_%' ";
$wpdb->query($query);