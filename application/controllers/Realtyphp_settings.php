<?php
/**
 * Realtyphp_settings class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package application.controllers
 * @since 1.0
 */ 

/**
 * Realtyphp_settings class coordinates the data flow between the model and the views.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package application.controllers
 * @since 1.0
 */
class Realtyphp_settings
{
			
	/**
	 * This is the index function.
	 * This function renders the index page of Settings.
	 */
	public function index()
	{
		
		View::render('realtyphp_settings', 'index', array(
		    
		));
		
	}
	
	
	/**
	 * This is the countries function.
	 * This function returns and renders the countries for items.
	 * User can add countries. 
	 */
	public function countries()
	{
		
		$model = new MRealtyphp_Settings();
		
		$error       = null;
		$class_error = null;
		
		if(isset($_POST['country']))
		{
			
			$validator = new FormValidator();
		    $model->valCountry($validator);
						
			
			if(!$validator->ValidateForm())
			{
								
                $error = __("Country", 'realtyphp').' '.__("is required!", 'realtyphp');
				$class_error = 'error';				                									  
		    
		    }else{		    					
														    												
				//Insert to database
				$model->saveCountry();
				wp_redirect('?page=realtyphp_settings&action=countries');				
			
		    }
			
		}
				
		View::render('realtyphp_settings', 'countries', array(
		    'countries'   => $model->getCountries(),
		    'error'       => $error,
		    'class_error' => $class_error
		    
		));
		
	}
	
	
	/**
	 * This is the deleteCounty function.
	 * This function deletes the selected Country and the States/Provinces of the Country.
	 */
	public function deleteCountry()
	{
		
		$model = new MRealtyphp_Settings();		
		
		$model->deleteCountry((int)$_GET['id']);
		
		wp_redirect('?page=realtyphp_settings&action=countries');	
		exit();
		
	}
	
	
	/**
	 * This is the aStpr function.
	 * This is an Ajax response.
	 * Returns and renders the States/Provinces   
	 */
	public static function aStpr()
	{
		
		$model = new MRealtyphp_Settings();						
				
		View::render('realtyphp_settings', 'a_stpr', array(		        		      
		    'state_provinces' => $model->getStateProvinces((int)$_POST['id']),
		    'country_id'      => $_POST['id']		   		   
		));	    
		
		die();
	}

    
	/**
	 * This is the deleteSP function.
	 * This function delete the selected State/Province.
	 */
    public function deleteSP()
	{
		
		$model = new MRealtyphp_Settings();				
		$model->deleteSP((int)$_GET['id']);
		
		wp_redirect('?page=realtyphp_settings&action=countries');	
		exit();
		
	}
	
	
	/**
	 * This is the saveSP function.
	 * This function adds a State/Province for Country.
	 */
	public function saveSP()
	{
		
		$model = new MRealtyphp_Settings();				
		$model->saveSP();
		
		wp_redirect('?page=realtyphp_settings&action=countries');	
		exit();
		
	}

    
	/**
	 * This is the propertyTypes function.
	 * This function returns and renders the Types of Properties.
	 * Adds a Property type.
	 */
	public function propertyTypes()
	{
		
		$model = new MRealtyphp_Settings();
		
		$error       = null;
		$class_error = null;
		
		if(isset($_POST['type']))
		{
			
			//Validate
			$validator = new FormValidator();
		    $model->valType($validator);
						
			
			if(!$validator->ValidateForm())
			{
								
                $error = __("Property type", 'realtyphp').' '.__("is required!", 'realtyphp');
				$class_error = 'error';				                									  
		    
		    }else{		    					
														    												
				//Insert to database
				$model->saveType();
				wp_redirect('?page=realtyphp_settings&action=propertyTypes');				
			
		    }
			
		}
				
		View::render('realtyphp_settings', 'property_types', array(
		    'types'   => $model->getTypes(),
		    'error'       => $error,
		    'class_error' => $class_error
		    
		));
		
	}
	
	
	/**
	 * This is the deleteType function.
	 * This function deletes the selected Property type.
	 */
	public function deleteType()
	{
		
		$model = new MRealtyphp_Settings();				
		$model->deleteType((int)$_GET['id']);
		
		wp_redirect('?page=realtyphp_settings&action=propertyTypes');
		exit();
		
	}
    
	
}

?>
