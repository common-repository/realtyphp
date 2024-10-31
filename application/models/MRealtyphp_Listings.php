<?php
/**
 * MRealtyphp_Listings class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package application.models
 * @since 1.0
 */ 

/**
 * MRealtyphp_Listings class is a model for the specified controller.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package application.models
 * @since 1.0
 */
class MRealtyphp_Listings
{
				
	
	/**
	 * This is the getOffers function.
	 * This function returns with the types of Offers.	 
	 */
	public function getOffers()
	{
		global $wpdb;
		return $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."realtyphp_offer");		
		
	}
	
	
	/**
	 * This is the getTypes function.
	 * This function returns with the types of Properties.	 
	 */
	public function getTypes()
	{
		global $wpdb;
		return $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."realtyphp_property_types");		
	}
	
	
	/**
	 * This is the getCountries function.
	 * This function returns with the list of Countries.	 
	 */
	public function getCountries()
	{		
		global $wpdb;
		return $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."realtyphp_countries");		
	}
	
	
	/**
	 * This is the getStateProvinces function.
	 * This function returns with the list of States/Provinces of a Country.
	 * @param int $id. Id of the Country.	 
	 */
	public function getStateProvinces($id)
	{		
		global $wpdb;				
		
		return $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."realtyphp_state_province
		                            WHERE country_id = $id" );		
	}
	
	
	/**
	 * This is the validation function.
	 * This function validates the listings form.
	 * @param string $validator. Instance of the validator class.
	 * @return array $validator	 
	 */
	public function validation($validator)
	{
				
	    $validator->addValidation("title",             "req",__("Title", 'realtyphp').' '.__(" is required!", 'realtyphp'));			
	    $validator->addValidation("description",       "req",__("Description", 'realtyphp').' '.__("is required!", 'realtyphp'));
		$validator->addValidation("price",             "req",__("Price", 'realtyphp').' '.__("is required!", 'realtyphp'));
		$validator->addValidation("price",             "num",__("Price", 'realtyphp').' '.__("must be numeric!", 'realtyphp'));
		$validator->addValidation("area_size",         "req",__("Area size", 'realtyphp').' '.__("is required!", 'realtyphp'));
		$validator->addValidation("area_size",         "req",__("Area size", 'realtyphp').' '.__("must be numeric!", 'realtyphp'));			
		$validator->addValidation("city",              "req",__("City", 'realtyphp').' '.__("is required!", 'realtyphp'));
		$validator->addValidation("country",           "req",__("Country", 'realtyphp').' '.__("is required!", 'realtyphp'));
		$validator->addValidation("contact_name",      "req",__("Contact name", 'realtyphp').' '.__("is required!"));
		$validator->addValidation("contact_phone",     "req",__("Contact phone", 'realtyphp').' '.__("is required!", 'realtyphp'));		
		
						
		return $validator;
	}

    
	/**
	 * This is the save function.
	 * This function save the item into the database.	 
	 */
    public function save()
	{
		
		global $wpdb;			
		
		$wpdb->query( $wpdb->prepare(
				
		    "INSERT INTO " . $wpdb->prefix . "realtyphp_listings( 
		    user_id,offer,type,price,area_size,nr_rooms,zip,city,
			state_province,country,title,description,contact_name,
			contact_email,contact_phone,contact_display,last_updated,date_added,listing_name)
		    VALUES( %d,%s,%s,%d,%d,%d,%d,%s,%s,%s,%s,%s,%s,%s,%s,%d,%s,%s,%s )",
			$_POST['user_id'],$_POST['offer'],$_POST['type'],$_POST['price'],$_POST['area_size'],
			$_POST['nr_rooms'],$_POST['zip'],$_POST['city'],$_POST['state_province'],$_POST['country'],
			$_POST['title'],$_POST['description'],$_POST['contact_name'],$_POST['contact_email'],
			$_POST['contact_phone'],$_POST['contact_display'],date("Y-m-d H:i:s"),
			date("Y-m-d H:i:s"),HFilter::slugify($_POST['title'])
				
				) );
				
		return $wpdb->insert_id;
	}
				
	
	/**
	 * This is the getItem function.
	 * This function returns with the selected item.
	 * @param int $id. Id of the selected item.	 
	 */
	public function getItem($id)
	{
		
		global $wpdb;		
		
		$add_to_query     = null;
		$add_to_query_val = null;
		
		if(!current_user_can('administrator'))
		{
		    $add_to_query     = "AND user_id = ". get_current_user_id() ."";
		    $add_to_query_val = get_current_user_id();
		}
						
		return $wpdb->get_results($wpdb->prepare(
		
		       "SELECT * FROM ".$wpdb->prefix."realtyphp_listings
		        WHERE id = %d $add_to_query",$id,$add_to_query_val
		        
		        ));
		
	}
	
	
	/**
	 * This is the update function.
	 * This function update the item in the database.	 
	 */
	public function update()
	{
		
		global $wpdb;	
		
		$add_to_query     = null;
		$add_to_query_val = null;
		
		if(!current_user_can('administrator'))
		{
		    $add_to_query     = "AND user_id = %d";
		    $add_to_query_val = get_current_user_id();
		}
		
		
		$wpdb->query( $wpdb->prepare(
				
		    "UPDATE " . $wpdb->prefix . "realtyphp_listings SET
		    user_id = %s, offer = %d, type = %d, price = %d, area_size = %d ,nr_rooms = %d,
		    zip = %d, city = %s, state_province = %s, country = %s, title = %s, description = %s,
		    contact_name = %s, contact_email = %s, contact_phone = %s, contact_display = %d, 
		    last_updated = %s, listing_name = %s WHERE id = %d $add_to_query",
			$_POST['user_id'], $_POST['offer'], $_POST['type'], $_POST['price'], $_POST['area_size'],
			$_POST['nr_rooms'], $_POST['zip'], $_POST['city'], $_POST['state_province'], $_POST['country'],
			$_POST['title'], $_POST['description'], $_POST['contact_name'], $_POST['contact_email'],
			$_POST['contact_phone'], $_POST['contact_display'],
			date("Y-m-d H:i:s"), HFilter::slugify($_POST['title']), $_POST['id'], $add_to_query_val
				
				) );
		
	}
	
	
	/**
	 * This is the delete function.
	 * This function delete the item from the database.
	 * @param int $id. Id of the selected item.	 
	 */
	public function delete($id)
	{
		
		global $wpdb;		
		
		$add_to_query     = null;
		$add_to_query_val = null;
		
		if(!current_user_can('administrator'))
		{
		    $add_to_query     = "AND user_id = %d";
		    $add_to_query_val = get_current_user_id();
		}
		
		$wpdb->query($wpdb->prepare(
		    "DELETE FROM " . $wpdb->prefix . "realtyphp_listings
		     WHERE id = %d $add_to_query",$id, $add_to_query_val
		));
		
	}
	
	
	/**
	 * This is the deleteSelected function.
	 * This function delete the selected items.
	 * @param array $item. Array of the ids of items.	 
	 */
	public function deleteSelected($item)
	{
		
		global $wpdb;		
		
		foreach($item as $id)
		{
					
		    $wpdb->query($wpdb->prepare(
		        "DELETE FROM " . $wpdb->prefix . "realtyphp_listings
		         WHERE id = %d",$id
		    ));
			
		}
						
	}
			
	
	/**
	 * This is the savePhoto function.
	 * This function save the data of the photo(not the file!) into the database.
	 * @param $id_listing int. Id of the item.
	 * @param $name string. Name of the photo uploaded.	 
	 */
	public function savePhoto($id_listing, $name)
	{
		
		global $wpdb;		
		
		$wpdb->insert($wpdb->prefix."realtyphp_listings_pictures",
		    array( 'listing_id' => $id_listing, 'name' => $name ),
			array('%d','%s')
			);
		
	}
	
	
	/**
	 * This is the getPhotos function.
	 * This function returns with the photos of the selected item.	 
	 * @param $id_listing int. Id of the selected item.
	 */
	public function getPhotos($id_listing)
	{
		global $wpdb;		
		
		return $wpdb->get_results($wpdb->prepare(
		
		       "SELECT * FROM ".$wpdb->prefix."realtyphp_listings_pictures
		        WHERE listing_id = %d",$id_listing
		        
		        ));		
	}
	
	
	/**
	 * This is the getPhoto function.
	 * This function returns with the selected photo.
	 * @param int $id. Id of the photo.	 
	 */
	public function getPhoto($id)
	{
		global $wpdb;		
		
		return $wpdb->get_results($wpdb->prepare(
		
		       "SELECT * FROM ".$wpdb->prefix."realtyphp_listings_pictures
		        WHERE id = %d",$id
		        
		        ));		
	}
	
	
	/**
	 * This is the deletePhoto function.
	 * This function delete the selected Photo.	 
	 */
	public function deletePhoto($id)
	{
		
		global $wpdb;		
								
		$wpdb->query($wpdb->prepare(
		    "DELETE FROM " . $wpdb->prefix . "realtyphp_listings_pictures
		     WHERE id = %d",$id
		));
						
	}
	
}

?>
