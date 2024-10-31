<?php
/**
 * Frontend class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package lib
 * @since 1.0
 */ 

/**
 * Frontend class serving common functionalities for the Realtyphp frontend.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package lib
 * @since 1.0
 */
class Frontend
{
	
	
	/**
	 * This is the load function.
	 * This function load the main functions for the frontend.	 
	 */
	public function load()
	{
		
		add_action( 'init', array('Frontend', 'addRewriteRules'));			
		add_action('init', array('Frontend', 'addJS'));	
		add_shortcode('realtyphp-listings', array('Frontend','route'));						
		add_filter('wp_title', array('Frontend', 'addWpTitle'));	
		add_filter('the_title', array('Frontend', 'addTheTitle'));
        		  		
					
		
	}
	
	
	/**
	 * This is the addJS function.
	 * This function load the javascript files for the frontend.	 
	 */
	public static function addJS()
	{
					
		wp_enqueue_script('galleria-1.2.8.js', REALTYPHP_URL . 'js/galleria-1.2.8.min.js');							
		if(file_exists(REALTYPHP_PATH . 'js/' . WPLANG . '/realtyphp-' . WPLANG . '-frontend.js'))
		{
		    wp_enqueue_script( 'realtyphp-lang.js', REALTYPHP_URL . 'js/'.WPLANG.'/realtyphp-'.WPLANG.'-frontend.js');
		}else{
			wp_enqueue_script( 'realtyphp-lang.js', REALTYPHP_URL . 'js/en_US/realtyphp-en_US-frontend.js');
		}
		
	}
			
	
	/**
	 * This is the addRewriteRules function.
	 * This function add the Rewrite rules for seo friendly urls for frontend.	 
	 */
	public static function addRewriteRules()
	{
		global $wp_rewrite;	
		add_rewrite_tag('%action%','([^&]+)');	
		add_rewrite_tag('%rp_page%','([^&]+)');
		add_rewrite_tag('%rp_limit%','([^&]+)');		
		add_rewrite_tag('%rp_id%','([^&]+)');
		add_rewrite_tag('%rp_ln%','([^&]+)');
		
		add_rewrite_rule('^([^/]*)/index/([^/]*)/([^/]*)$','index.php?pagename=$matches[1]&action=index&rp_page=$matches[2]&rp_limit=$matches[3]','top');
		add_rewrite_rule('^([^/]*)/view/([^/]*)/([^/]*)$','index.php?pagename=$matches[1]&action=view&rp_id=$matches[2]&rp_ln=$matches[3]','top');			
		$wp_rewrite->flush_rules();		
	}
	
	
	/**
	 * This is the route function.
	 * This function route and call the frontend classes and objects.	 
	 */	
	public static function route()
	{
			
		global $wp_query;	
		
		$get_action = 'index';
		$get_action = isset($wp_query->query_vars['action']) ? $wp_query->query_vars['action'] : $get_action;			
		
		$dispatch = new Realtyphp_frontend();		
		$dispatch->$get_action();			
			
		
	}
	
	
    /**
     * This is the routeForTitle function.
     * This function give dinamic title for 'wp_title' and 'the_title'.    
     */ 
    public static function routeForTitle()
    {
        
        global $wp_query;
        $post_title = $wp_query->post->post_title;
        $get_action = 'index';
        $get_action = isset($wp_query->query_vars['action']) ? $wp_query->query_vars['action'] : $get_action;       
        
        if(!isset($wp_query->query_vars['action']))
        {
                                
            return $post_title . ' | ';           
        }
            
        $rp_limit = isset($wp_query->query_vars['rp_limit']) ? (is_numeric($wp_query->query_vars['rp_limit']) ? 
            $wp_query->query_vars['rp_limit'] : 10) : 10;     
        $rp_page  = isset($wp_query->query_vars['rp_page']) ? $wp_query->query_vars['rp_page'] : null;      
        
        $num_page = ' #'.(($rp_page/$rp_limit)+1).' '; 
        
        $dispatch = new Realtyphp_frontend();
        $action   = $get_action.'Title';        
        return $dispatch->$action($post_title, $num_page);  
        
    } 
    
	/**
	 * This is the addWpTitle function.
	 * This function provides the title(wp_title) for frontend pages.	 
	 */	
	public static function addWpTitle()
	{
				
		return self::routeForTitle();												
		
	}	
	
	
	/**
	 * This is the addTheTitle function.
	 * This function provides the title(the_title) for frontend pages.	 
	 */	
	public static function addTheTitle($title)
	{
		if(in_the_loop())
        {
		    return str_replace('|', '', self::routeForTitle());
        }
		
		return $title;
		
	}
	
	
	
	
}

?>