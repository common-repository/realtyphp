<?php
/**
 * HSearch class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package lib.helpers
 * @since 1.0
 */ 

/**
 * HSearch helper class file help for the items search in admin.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package lib.helpers
 * @since 1.0
 */ 
class HSearch
{
	
	/**
	 * Searches by the input of a string.This function currently not used.
	 * @param string $str_input. Searched string.
	 * @param string $column. DB column.
	 */
	public static function byString($str_input, $column)
	{
		global $wpdb;
		
		$words      = $str_input;
		$delimiters = array(' ', ',', ', ', ', ',' , '); 
		$words      = str_replace($delimiters, '-|-', $words);			
		$words      = explode('-|-', $words);
		$search     = null;
			
		foreach($words as $word)
		{
			$search .= " AND $column LIKE '%".$wpdb->escape($word)."%' "; 
		}
		
		return $search;
		
	}
	
	
	/**
	 * Searches by the ID of an Item. 
	 * @param int $nr_input. Searched item ID.
	 * @param string $column. DB column.
	 */
	public static function byId($nr_input, $column)
	{
						
		$nr = (int)$nr_input; 
				
		$search = " AND $column = $nr "; 
				
		return $search;
		
	}
	
}

?>