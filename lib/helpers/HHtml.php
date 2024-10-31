<?php
/**
 * HHtml class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package lib.helpers
 * @since 1.0
 */ 

/**
 * HHtml helper class file render html tags and help for the pagination.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package lib.helpers
 * @since 1.0
 */ 
class HHtml
{
	
	/** 
	 * This renders a link for Realtyphp plugin.
	 * @param string $action.
	 * @param string $label. Label of the 'a' tag.
	 * @return string. String of the link.
	 */
	public static function link($action, $label)
	{
	    
		$href = get_page_link().'&action='.$action;	
		
		
	    if( get_option('permalink_structure') )
		{
		    $action = str_replace(array('&rp_id=', '&rp_ln='), '/', $action);	
		    $href = get_page_link().$action;
		}
		
		return "<a href='$href' >$label</a>";
		
	}
	
	
	/** 
	 * This renders a link for the pagination of the frontend of the Realtyphp plugin.
	 * @param int $rp_page. Number of the start row for mysql query.
	 * @param int $per_page. Item per page(LIMIT).
	 * @param string $label. Label of the 'a' tag.
	 * @return string. String of the link.
	 */
	public static function plink($rp_page, $per_page, $label)
	{
	    
		$href = get_page_link().'&action=index&rp_page='.$rp_page.'&rp_limit='.$per_page;	
		
	    if( get_option('permalink_structure') )
		{
		    $href = get_page_link().'index/'.$rp_page.'/'.$per_page;
		}
		
		return "<a href='$href' >$label</a>";
		
	}
	
	
	/** 
	 * Pagination.
	 * @param int $nr_items. Number of the items.
	 * @param int $per_page. Number of the items per page.
	 * @return string $pnums. Pagination link.
	 */
	public static function pagination($nr_items, $per_page){
		
		 $pnums = array();		 		 	    	
		 $count = ceil($nr_items/$per_page);		 
		 
		 for($i=1;$i<=$count;$i++){
		     
			 $n = ($i-1)*$per_page;
			 $pnums[] = HHtml::plink($n, $per_page, $i).' ';
		 }
		 
		 if($count < 2)
		     $pnums = array();
			 	 
		 return $pnums;
		
	}
		
}


?>