<?php
/**
 * Realtyphp_admin_home class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package application.controllers
 * @since 1.0
 */ 

/**
 * Realtyphp_admin_home class coordinates the data flow between the model and the views.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package application.controllers
 * @since 1.0
 */
class Realtyphp_admin_home
{
	
	/**
	 * This is the index function.
	 * This function renders the index page of the Realtyphp admin area.
	 */
	public function index()
    {
    	
		View::render('realtyphp_admin_home','index' , array(
				
		));
		
    }
	
}


?>