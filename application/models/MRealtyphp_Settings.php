<?php
/**
 * MRealtyphp_Settings class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package application.models
 * @since 1.0
 */ 

/**
 * MRealtyphp_Settings class is a model for the specified controller.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package application.models
 * @since 1.0
 */
class MRealtyphp_Settings
{
	
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
	 * This is the valCountry function.
	 * This function validates the 'Add a Country' form.
	 * @param string $validator. Instance of the validator class.
	 * @return array $validator.	 
	 */
	public function valCountry($validator)
	{
				
	    $validator->addValidation("country", "req",__("Country", 'realtyphp').' '.__(" is required!", 'realtyphp'));			
	    						
		return $validator;
		
	}
	
	
	/**
	 * This is the saveCountry function.
	 * This function save a Country into the database.	 
	 */
	public function saveCountry()
	{
		
		global $wpdb;	
				
		$wpdb->query( $wpdb->prepare(
				
		    "INSERT INTO " . $wpdb->prefix . "realtyphp_countries(label)
		     VALUES( %s )",$_POST['country']
			 
			 ) );
			 
		$country_id = $wpdb->insert_id;
		$wpdb->query( $wpdb->prepare(
				
		    "INSERT INTO " . $wpdb->prefix . "realtyphp_state_province(country_id, label)
		     VALUES( %d, %s )",$country_id, '-'
			 
			 ) );
		
		
	}
	
	
	/**
	 * This is the deletCountry function.
	 * This function delete the selected Country and the States/Provinces of the Country(relation)
	 * from the database.	 
	 * @param int $id. Id of the selected Country.
	 */
	public function deleteCountry($id)
	{
		
		global $wpdb;		
		
		$wpdb->query($wpdb->prepare(
		    "DELETE FROM " . $wpdb->prefix . "realtyphp_countries
		     WHERE id = %d",$id
		));
		
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
	 * This is the deleteSP function.
	 * This function deletes the selected State/Province from the database.
	 * param int $id. Id of the selected SP.	 
	 */
	public function deleteSP($id)
	{
		
		global $wpdb;		
		
		$wpdb->query($wpdb->prepare(
		    "DELETE FROM ".$wpdb->prefix."realtyphp_state_province
		     WHERE id = %d",$id
		));
		
	}
	
	
	/**
	 * This is the saveSP function.
	 * This function save a State/Province into the database.	 
	 */
	public function saveSP()
	{
		
		global $wpdb;	
				
		$wpdb->query( $wpdb->prepare(
				
		    "INSERT INTO " . $wpdb->prefix . "realtyphp_state_province(country_id, label)
		     VALUES( %d, %s )",$_POST['sp_country_id'], $_POST['sp_label']
			 
			 ) );
		
	}
	
	
	/**
	 * This is the valType function.
	 * This function validates the 'Add Property type' form.
	 * @param string $validator. Instance of the validator class.	 
	 */
	public function valType($validator)
	{
				
	    $validator->addValidation("type", "req",__("Property type", 'realtyphp').' '.__(" is required!", 'realtyphp'));			
	    						
		return $validator;
		
	}
	
	
	/**
	 * This is the getTypes function.
	 * This function returns with the list of Property types.	 
	 */
	public function getTypes()
	{		
		global $wpdb;
		return $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."realtyphp_property_types");		
	}
	
	
	/**
	 * This is the saveType function.
	 * This function save the Property type into the database.	 
	 */
	public function saveType()
	{
		
		global $wpdb;	
				
		$wpdb->query( $wpdb->prepare(
				
		    "INSERT INTO " . $wpdb->prefix . "realtyphp_property_types(label)
		     VALUES( %s )",$_POST['type']
			 
			 ) );
		
	}
	
	
	/**
	 * This is the deleteType function.
	 * This function deletes the Property type from the database.
	 * @param int $id. Id of the Property type.	 	 
	 */
	public function deleteType($id)
	{
		
		global $wpdb;		
		
		$wpdb->query($wpdb->prepare(
		    "DELETE FROM ".$wpdb->prefix."realtyphp_property_types
		     WHERE id = %d",$id
		));
		
	}
	
	
	
	
} 


?>
