<?php
/**
 * View class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package lib
 * @since 1.0
 */ 

/**
 * View class serving(render) the pages for controllers.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package lib
 * @since 1.0
 */
class View
{
	
	/**
	 * @var string $controller. String of the controller class.
	 */
	private static $controller;
	/**
	 * @var string $page. String of the controller called page.
	 */
	private static $page;
	/**
	 * @var array $arr_variables. Array of variables for page.
	 */
	private static $arr_variables;
	
	
	/**
	 * This is the render function
	 * This function render a page for an action of a controller.
	 * @param string $controller. String of the controller class.
	 * @param string $page. String of the controller called page.
	 * @param array $arr_variables. Array of variables for page.
	 */
	public static function render($controller, $page, $arr_variables)
	{
		
		self::$controller    = $controller;
		self::$page          = $page;
		self::$arr_variables = $arr_variables;
		
		extract(self::$arr_variables);
		require_once(REALTYPHP_PATH . "application/views/".self::$controller."/".self::$page.".php");
		
	}
	
}
?>