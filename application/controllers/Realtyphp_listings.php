<?php
/**
 * Realtyphp_listings class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package application.controllers
 * @since 1.0
 */ 

/**
 * Realtyphp_listings class coordinates the data flow between the model and the views.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package application.controllers
 * @since 1.0
 */
class Realtyphp_listings
{
		
	/**
	 * This is the index function.
	 * This function returns and renders the Listings.
	 * Uses the Wordpress WP_List_Table class.
	 */
	public function index()
	{
					
		$listings_table = new All_Listings_Admin();
		$listings_table->prepare_items();
						
		View::render('realtyphp_listings', 'index', array(		   
		    'listings_table' => $listings_table
		));	
		
	}
	
	
	/**
	 * This is the create function.
	 * This function creates the item for the Listings.	 
	 */
	public function create()
	{
		
		
		$model = new MRealtyphp_Listings();			
		
		$error         = null;
		$updated       = null;
		$class_error   = null;
		$class_updated = null;
		$error_hash    = array();
		$id_listing    = null;		
		
		if(isset($_POST['title']))
		{		    									
			
		    //Validation
		    $validator = new FormValidator();
		    $model->validation($validator);
			
			if(!$validator->ValidateForm())
			{
								
                $error_hash = $validator->GetErrors();
				$class_error = 'error';				                									  
		    
		    }else{		    					
														    												
				//Insert to database
				$id_listing = $model->save();				
				
				$updated         = __("Item is saved. You must min. 1 photo upload!", 'realtyphp');
				$class_updated   = 'updated';								
			
		    }						
					
		}		
			
					
		View::render('realtyphp_listings', 'create', array(
		    'offers'         => $model->getOffers(),
		    'types'          => $model->getTypes(),
		    'countries'      => $model->getCountries(),
		    'error_hash'     => $error_hash,
		    'updated'        => $updated,
		    'class_error'    => $class_error,
		    'class_updated'	 => $class_updated,	
		    'id_listing'     => $id_listing		       
		   
		));	
	}

	
	/**
	 * This is the aStpr function.
	 * This function is an Ajax response. 
	 * Returns and renders the States/Provinces for the specified Country.	 
	 */
	public static function aStpr()
	{
		
		$model = new MRealtyphp_Listings();				
		$state_provinces = $model->getStateProvinces((int)$_POST['id']);	
		$sp_id = isset($_POST['sp_id']) ? (int)$_POST['sp_id'] : 0;	
		
		if($state_provinces == true)
		{			
		    View::render('realtyphp_listings', 'a_stpr', array(
		        'sp_id'           => $sp_id,		       
		        'state_provinces' => $state_provinces,		   		   
		    ));
	    }
		
		die();
	}
	
	
	/**
	 * This is the update function.
	 * This function updates the specified item.	 
	 */
	public function update()
	{
				
		$model   = new MRealtyphp_Listings();
		$item    = $model->getItem((int)$_GET['id']); 
			
		if(!$item)
		{
			wp_redirect('?page=realtyphp_listings');
			exit();
		}		
		
		$error         = null;
		$updated       = null;
		$class_error   = null;
		$class_updated = null;
		$error_hash    = array();
		
		if(isset($_POST['title']))
		{		    									
			
		    //Validation
		    $validator = new FormValidator();
		    $model->validation($validator);
			
			if(!$validator->ValidateForm())
			{
								
                $error_hash = $validator->GetErrors();
				$class_error = 'error';				                									  
		    
		    }else{		    					
														    												
				//Insert to database
				$model->update();								    
				wp_redirect("?page=realtyphp_listings&action=update&id=". $_POST['id'] ."");
							
		    }						
					
		}		
					
		View::render('realtyphp_listings', 'update', array(
		    'item'           => $item,
		    'offers'         => $model->getOffers(),
		    'types'          => $model->getTypes(),
		    'countries'      => $model->getCountries(),
		    'error_hash'     => $error_hash,		    
		    'class_error'    => $class_error,		       
		   
		));	
	}

    
	/**
	 * This is the delete function.
	 * This function deletes the selected item.	 
	 */
	public function delete()
	{
		
		$model   = new MRealtyphp_Listings();
		$photos = $model->getPhotos((int)$_GET['id']);
		
		foreach($photos as $photo)
		{
		    unlink( REALTYPHP_PATH . 'uploads/'.$photo->name );
		    unlink( REALTYPHP_PATH . 'uploads/thumbs/'.$photo->name );						
		}
		
		
		$model->delete((int)$_GET['id']);
				
		wp_redirect("?page=realtyphp_listings");
		exit();
		
	}
	
	
	/**
	 * This is the index function.
	 * This function delete the selected items(with bulk action).	 
	 */
	public function deleteSelected()
	{
		
		$model   = new MRealtyphp_Listings();
		$item  = $_GET['item']; 
		
		foreach($item as $id)
		{
					
			$photos = $model->getPhotos($id);
		
		    foreach($photos as $photo)
		    {
		        unlink( REALTYPHP_PATH . 'uploads/'.$photo->name );
		        unlink( REALTYPHP_PATH . 'uploads/thumbs/'.$photo->name );						
			}
			
		}
		
				
		$model->deleteSelected($item);
				
		wp_redirect("?page=realtyphp_listings");
		exit();
		
	}
			
	
	/**
	 * This is the aPhotoUpload function.
	 * This function is an Ajax response.
	 * Uploads photo for the selected item.
	 * Uses a php upload class.
	 */
	public static function aPhotoUpload()
	{
		
		$model = new MRealtyphp_Listings();
			
		if(isset($_POST['hphoto']))
		{	
		
		$handle = new upload($_FILES['photo']);
        if ($handle->uploaded) 
        {
							        
			$handle->image_resize = true;
            $handle->image_ratio_no_zoom_in = true; 			          
            $handle->image_x = 500; 
            $handle->image_y = 400;                                                             
            $handle->process( REALTYPHP_PATH . 'uploads/' ); 
			          
            if ($handle->processed) {            	                
				
				$handle->image_resize = true;           
                $handle->image_x = 100;
                $handle->image_ratio_y = true;
                $handle->Process(REALTYPHP_PATH . 'uploads/thumbs/');
				
				if ($handle->processed) {
                    echo __('File uploaded: ', 'realtyphp'). $handle->file_src_name;
										    
		                $model->savePhoto((int)$_POST['id_listing'], $handle->file_dst_name);					                
					
                }else{
            	    echo $handle->error;
					unlink( REALTYPHP_PATH . 'uploads/'.$handle->file_dst_name );
                }
				
            }else{
            	echo $handle->error;
            }                                                                       
          
        }

        }
                           
		$photos     = $model->getPhotos((int)$_POST['id_listing']);
												
		View::render('realtyphp_listings', 'a_uploaded_photos', array(		   
		    'photos' => $photos
		));
			
		die();
		
		
	}

    /**
	 * This is the index function.
	 * This function is an Ajax response.
	 * Deletes the selected photo of the selected item.
	 */
	public static function aPhotoDelete()
	{
		
		$model = new MRealtyphp_Listings();
		$photo = $model->getPhoto((int)$_POST['id_photo']);
		unlink( REALTYPHP_PATH . 'uploads/'.$photo[0]->name );
		unlink( REALTYPHP_PATH . 'uploads/thumbs/'.$photo[0]->name );
		$model->deletePhoto((int)$_POST['id_photo']);
		
		$photos     = $model->getPhotos((int)$_POST['id_listing']);
												
		View::render('realtyphp_listings', 'a_uploaded_photos', array(		   
		    'photos' => $photos
		));
			
		die();
		
		
	}
	
					
	
}

?>
