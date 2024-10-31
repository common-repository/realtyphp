<?php 
/*
Plugin Name: RealtyPHP
Plugin URI:
Description: Real Estate listing plugin for Wordpress.
Author: Elod Horvath
Version: 1.0.4
Author URI: http://www.tunedthemes.com
License: http://www.gnu.org/licenses/gpl.html
Copyright &copy; 2012- Elod Horvath
*/

define('realtyphp', 'realtyphp');
define('REALTYPHP_PATH', plugin_dir_path(__FILE__));
define('REALTYPHP_URL', plugins_url() . '/realtyphp/');
define('REALTYPHP_ROLE', 'read');


require_once(REALTYPHP_PATH.'lib/Bootstrap.php');
Bootstrap::load();

register_activation_hook(__FILE__,array('Realtyphp_installer', 'install') );
register_deactivation_hook(__FILE__,array('Realtyphp_installer', 'uninstall') );

?>
