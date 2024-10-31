<?php
/**
 * MRealtyphp_frontend class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package application.models
 * @since 1.0
 */ 

/**
 * MRealtyphp_frontend class is a model for the specified controller.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package application.models
 * @since 1.0
 */
class MRealtyphp_Frontend
{			
	
	
	/**
	 * This is the getNrItems function.
	 * This function counts the number of all, or the searched items.
	 * @return int. Number of the the items. 
	 */
	public function getNrItems()
	{
		global $wpdb;
		$search = null;
		
		if(isset($_POST['offer']))
		{
				
			$area_size = $_POST['area_size'] != null ? $wpdb->escape($_POST['area_size']) : 10000000;
			$price_max = $_POST['price_max'] != null ? $wpdb->escape($_POST['price_max']) : 1000000000000;
			
			$search = "WHERE offer = '".$wpdb->escape($_POST['offer'])."'
			           AND type = '".$wpdb->escape($_POST['type'])."'
			           AND city LIKE '%".$wpdb->escape($_POST['city'])."%' 			           			           
			           AND area_size <= '".$area_size."'
			           AND price <= '".$price_max."' 
			           "; 
			
		}
		return $wpdb->get_var( "SELECT COUNT(id) FROM ".$wpdb->prefix."realtyphp_listings $search" );		
	}
	
	
	/**
	 * This is the getItems function.
	 * This function returns with all or the searched items.
	 * @param int $start. Start row of mysql query for pagination.
	 * @param int $limit. Limit for mysql query for pagination.	 
	 */
	public function getItems($start, $limit)
	{
			
		global $wpdb;
		$search = null;
		
		if(isset($_POST['offer']))
		{
				
			$area_size = $_POST['area_size'] != null ? $wpdb->escape($_POST['area_size']) : 10000000;
			$price_max = $_POST['price_max'] != null ? $wpdb->escape($_POST['price_max']) : 1000000000000;
			
			$search = "AND (t1.offer = '".$wpdb->escape($_POST['offer'])."'
			           AND t1.type = '".$wpdb->escape($_POST['type'])."'
			           AND t1.city LIKE '%".$wpdb->escape($_POST['city'])."%' 			           			           
			           AND t1.area_size <= '".$area_size."'
			           AND t1.price <= '".$price_max."' 
			           )"; 
			
		}
		
		return  $wpdb->get_results("
		        SELECT t1.city,t1.area_size,t1.price,t1.zip,t1.listing_name,t1.id AS id_listing, t2.id AS id_offer, t3.id as id_type, 
		            t4.id as id_photo,t5.id as id_country,t6.id as id_stpr,t2.label as label_offer, 
		            t3.label as label_type, t4.name as name_photo,t5.label as label_country,t6.label as label_stpr
		        FROM ".$wpdb->prefix."realtyphp_listings as t1, ".$wpdb->prefix."realtyphp_offer as t2, 
		            ".$wpdb->prefix."realtyphp_property_types as t3, ".$wpdb->prefix."realtyphp_listings_pictures as t4,
		            ".$wpdb->prefix."realtyphp_countries as t5,".$wpdb->prefix."realtyphp_state_province as t6
		        WHERE t1.offer = t2.id AND t1.type = t3.id AND t1.id = t4.listing_id AND t1.country = t5.id
		            AND (t1.state_province = t6.id OR t1.state_province = 0) $search
		        GROUP BY t1.id ORDER BY t1.id DESC LIMIT $start,$limit");
		
	}
	
	
	/**
	 * This is the getPhoto function.
	 * This function returns with a selected photo.	
	 * @param int $id. Id of the photo. 
	 */
	public function getPhoto($id)
	{
		global $wpdb;		
		
		return $wpdb->get_results($wpdb->prepare(
		
		       "SELECT * FROM ".$wpdb->prefix."realtyphp_listings_pictures
		        WHERE id = %d LIMIT 1",$id
		        
		        ));		
	}
	
	
	/**
	 * This is the getItem function.
	 * This function returns with a selected item.
	 * @param int $rp_id. Id of the item.
	 */
	public function getItem($rp_id)
	{
			
		global $wpdb;
		
		return  $wpdb->get_results("
		        SELECT *, t1.id AS id_listing, t2.id AS id_offer, 
		            t3.id as id_type, t4.id as id_country, t5.id as id_stpr, t2.label as label_offer, 
		            t3.label as label_type, t4.label as label_country, t5.label as label_stpr		        
		        FROM ".$wpdb->prefix."realtyphp_listings as t1, ".$wpdb->prefix."realtyphp_offer as t2, 
		            ".$wpdb->prefix."realtyphp_property_types as t3, ".$wpdb->prefix."realtyphp_countries as t4,
		            ".$wpdb->prefix."realtyphp_state_province as t5
		        WHERE t1.offer = t2.id AND t1.type = t3.id AND t1.country = t4.id AND t1.state_province = t5.id 
		            AND t1.id = $rp_id");
		
	}
	
	
	/**
	 * This is the getPhotos function.
	 * This function returns with the photos of an item.
	 * @param int $id. Id of the item.
	 */
	public function getPhotos($id)
	{
		global $wpdb;		
		
		return $wpdb->get_results($wpdb->prepare(
		
		       "SELECT * FROM ".$wpdb->prefix."realtyphp_listings_pictures
		        WHERE listing_id = %d",$id
		        
		        ));		
	}
	
	
	/**
	 * This is the getTypes function.
	 * This function returns the types of Properties.
	 */
	public function getTypes()
	{
		global $wpdb;
		return $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."realtyphp_property_types");		
	}
	
	
	/**
	 * This is the validation function.
	 * This function validate the message sender form.
	 * @param $validator string. Instance of the validator class.
	 */
	public function validation($validator)
	{
				
	    $validator->addValidation("rp_subject", "req",__("Subject", 'realtyphp').' '.__(" is required!", 'realtyphp'));
	    $validator->addValidation("rp_subject", "maxlen=50",__("Subject", 'realtyphp').' '.__(" is too long(max. 50 character)!", 'realtyphp'));			
	    $validator->addValidation("rp_message", "req",__("Message", 'realtyphp').' '.__("is required!", 'realtyphp'));
	    $validator->addValidation("rp_message", "maxlen=300",__("Message", 'realtyphp').' '.__(" is too long(max. 300 character)!", 'realtyphp'));					
						
		return $validator;
	}
	
}


?>
