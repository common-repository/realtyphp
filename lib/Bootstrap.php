<?php
/**
 * Bootstrap class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package lib
 * @since 1.0
 */ 

/**
 * Bootstrap class serving common functionalities for the Realtyphp plugin.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package lib
 * @since 1.0
 */
class Bootstrap
{
	
	
    
	/**
	 * This is the load function.
	 * This function load the main functions for the plugin.	 
	 */
    public static function load()
	{
		    		   			
		add_action( 'init', array('Bootstrap', 'addJS') );	
		add_action( 'init', array('Bootstrap', 'addCss') );
		spl_autoload_register(array('Bootstrap','autoload'));
		add_action( 'init', array('Bootstrap', 'addLanguage'));
        add_action( 'admin_notices', array('Bootstrap', 'rpWarning') );
		
		if(is_admin())
		    Backend::load();
		else
			Frontend::load();
		
		self::addVendor();	
		
	} 
    
    
    public static function rpWarning()
    {
        if(!is_dir(REALTYPHP_PATH . 'uploads/thumbs'))
            echo "<div class='error'><b>RealtyPHP error: </b>". REALTYPHP_PATH ."<b>uploads/thumbs</b> path is not exists!
            You must create manually!</div>";
    }          
	
	
	/**
	 * This is the addJS function.
	 * This function load the javascript files for the plugin.	 
	 */
	public static function addJS()
	{
		
		wp_enqueue_script( 'jquery' ); 
		wp_enqueue_script( 'prettynumber.js', REALTYPHP_URL . 'js/jquery.prettynumber.js' );		
		
	}
	
	
	/**
	 * This is the addCss function.
	 * This function load the css files for the plugin.	 
	 */
	public static function addCss()
	{		
		wp_enqueue_style( 'realtyphp.css', REALTYPHP_URL . 'css/realtyphp.css' );		
	}



    /**
	 * This is the autoload function.
	 * This function load the classes from lib,helpers,controllers,models... direcories.
	 * @param string $class.	 
	 */
    public static function autoload($class)
	{
		
		if (file_exists(REALTYPHP_PATH . 'lib/' . $class . '.php')) {
			require_once (REALTYPHP_PATH . 'lib/' . $class . '.php');
		}
		
		if (file_exists(REALTYPHP_PATH . 'lib/helpers/' . $class . '.php')) {
			require_once (REALTYPHP_PATH . 'lib/helpers/' . $class . '.php');
		}
		
		if (file_exists(REALTYPHP_PATH . 'application/controllers/' . $class . '.php')) {
			require_once (REALTYPHP_PATH . 'application/controllers/' . $class . '.php');
		}
		
		if (file_exists(REALTYPHP_PATH . 'application/models/' . $class . '.php')) {
			require_once (REALTYPHP_PATH . 'application/models/' . $class . '.php');
		}
		
	}
	
	
	/**
	 * This is the addLanguage function.
	 * This function load the language files for the plugin.	 
	 */
	public static function addLanguage()
	{
					
		load_plugin_textdomain('realtyphp', false, '' . realtyphp . '/application/languages/'. WPLANG .'/' );
		
		if(file_exists(REALTYPHP_PATH . 'application/languages/'. WPLANG .'/realtyphp-'. WPLANG .'.php'))
		{	
		    require_once(REALTYPHP_PATH . 'application/languages/'. WPLANG .'/realtyphp-'. WPLANG .'.php');
		}
	}
	
	
	/**
	 * This is the addVendor function.
	 * This function load the vendors for the plugin.	 
	 */
	public static function addVendor()
	{				
		
		if(file_exists(REALTYPHP_PATH . 'lib/vendor/formvalidator.php'))
            require_once(REALTYPHP_PATH . 'lib/vendor/formvalidator.php');				
		
	}
	
	

}
?>