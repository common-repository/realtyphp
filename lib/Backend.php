<?php 
/**
 * Backend class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package lib
 * @since 1.0
 */ 

/**
 * Backend class handling with admin functions.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package lib
 * @since 1.0
 */
class Backend
{
	
	
	/**
	 * This is the load function.
	 * This function load the main functions for the backend.	 
	 */
	public static function load()
	{
		    
		add_action('init', array('Backend', 'outputBuffer') ); 						
		add_action('init', array('Backend', 'addJS'));				
		add_action('admin_menu', array('Backend', 'addPages'));
		add_action('admin_menu', array('Backend', 'route'));
		self::addAjax();
		self::addVendor();	
		
	}	
    
    
     /**
     * This is the outputBuffer function.        
     */
    public static function outputBuffer() 
    {
        ob_start();
        
    }		
	
	
	/**
	 * This is the addJS function.
	 * This function load the javascript files for the backend.	 
	 */
	public static function addJS()
	{
		
		wp_enqueue_script( 'jquery-form' ); 
		wp_enqueue_script( 'jquery.validate.js', REALTYPHP_URL . 'js/jquery.validate.js' );
		wp_enqueue_script( 'jquery.validate.messages.js', REALTYPHP_URL . 'js/' . WPLANG . '/validate_messages_' 
		    . WPLANG.'.js');
		wp_enqueue_script( 'autoNumeric.js', REALTYPHP_URL . 'js/autoNumeric-1.7.5.js' ); 
		wp_enqueue_script( 'realtyphp.js', REALTYPHP_URL . 'js/realtyphp-backend.js' );	
		
		if(file_exists(REALTYPHP_PATH . 'js/' . WPLANG . '/realtyphp-' . WPLANG . '-backend.js'))
		{
		    wp_enqueue_script( 'realtyphp-lang.js', REALTYPHP_URL . 'js/'.WPLANG.'/realtyphp-'.WPLANG.'-backend.js');
		}else{
			wp_enqueue_script( 'realtyphp-lang.js', REALTYPHP_URL . 'js/en_US/realtyphp-en_US-backend.js');
		}		
		
	}			
	
	
	/**
	 * This is the route function.
	 * This function route and call the backend classes and objects.	 
	 */	
	public static function route()
	{
			
		global $wp_query;	
		$get_controller = 'Realtyphp_admin_home';		
		$get_controller     = isset($_GET['page']) ? HFilter::stripHtml($_GET['page']) : $get_controller;	
		
		$get_action = 'index';		
		$get_action = isset($_GET['action']) ? HFilter::stripHtml($_GET['action']) : $get_action;
		
		$controller = ucfirst($get_controller);		
		
		add_submenu_page('realtyphp_admin_home', 
		    ' ', ' ', REALTYPHP_ROLE, $get_controller, 
		    array($controller, $get_action));	
		
		
		
	}
	
	
	/**
	 * This is the addPages function.
	 * This function adds the admin pages.	 
	 */
	public static function addPages()
	{
					
	    $pagename = current_user_can('administrator') ? __('All listings', 'realtyphp') : __('My listings', 'realtyphp');
		  				
		add_menu_page('RealtyPHP', 'RealtyPHP', REALTYPHP_ROLE, 'realtyphp_admin_home', 
		    array('Realtyphp_admin_home', 'index'));
		
		add_submenu_page('realtyphp_admin_home', 
		    $pagename, $pagename, REALTYPHP_ROLE, 'realtyphp_listings&action=index', 
		    array('Realtyphp_listings', 'index'));
		add_submenu_page('realtyphp_admin_home', 
		    __('Add new', 'realtyphp'), __('Add new', 'realtyphp'), REALTYPHP_ROLE, 'realtyphp_listings&action=create', 
		    array('Realtyphp_Listings', 'create'));
		add_submenu_page('realtyphp_admin_home', 
		    __('Settings', 'realtyphp'), __('Settings', 'realtyphp'), 'administrator', 'realtyphp_settings&action=index', 
		    array('Realtyphp_settings', 'index'));
											
																
	}
	
	
	/**
	 * This is the addAjax function.
	 * This function adds the Ajax called functions for backend.	 
	 */
	public static function addAjax()
	{
		
		add_action('wp_ajax_country_action', array('Realtyphp_listings', 'aStpr'));
		add_action('wp_ajax_country_action2', array('Realtyphp_settings', 'aStpr'));
		add_action('wp_ajax_photo_upload', array('Realtyphp_listings', 'aPhotoUpload'));
		add_action('wp_ajax_photo_delete', array('Realtyphp_listings', 'aPhotoDelete'));
		
	}	
	
	
	/**
	 * This is the addVendor function.
	 * This function add the vendor files, classes, programs for the backend.	 
	 */
	public static function addVendor()
	{								
		
		if(file_exists(REALTYPHP_PATH . 'lib/vendor/class.upload_0.31/class.upload.php'))
            require_once(REALTYPHP_PATH . 'lib/vendor/class.upload_0.31/class.upload.php');
		
	}
	
	
	
	
	
}


?>