<?php
/**
 * Realtyphp_frontend class file.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @link http://www.tunedthemes.com/
 * @copyright Copyright &copy; 2012 Elod Horvath
 * @license http://www.gnu.org/licenses/gpl.html
 * @package application.controllers
 * @since 1.0
 */ 

/**
 * Realtyphp_frontend class coordinates the data flow between the model and the views.
 * 
 * @author Elod Horvath <info@tunedthemes.com>
 * @package application.controllers
 * @since 1.0
 */
class Realtyphp_frontend
{
		
	/**
	 * This is the index function.
	 * This function returns and renders the index(Listings) page of the Realtyphp frontend area.
	 */
	public function index()
	{
		    
		add_filter( 'edit_post_link', '__return_false' );						
		global $wp_query;			
		$model = new MRealtyphp_Frontend();	
		$types = $model->getTypes();
		
		$start  = isset($wp_query->query_vars['rp_page']) ? $wp_query->query_vars['rp_page'] : 0;		
		$limit  = isset($wp_query->query_vars['rp_limit']) ? (is_numeric($wp_query->query_vars['rp_limit']) ? 
		    $wp_query->query_vars['rp_limit'] : 10) : 10;		
		
		$items      = $model->getItems($start, $limit);					
		$pagination = HHtml::pagination($model->getNrItems(), $limit);				
						
		View::render('realtyphp_frontend', 'index', array(
		    'model'      => $model,		   
		    'items'      => $items,
		    'pagination' => $pagination,
		    'types'      => $types		    
		));	
		
	}
	
	
	/**
	 * This is the indexTitle function.
	 * @param string $title. Title of the page.
	 * @param int $num_page. Number of the page.
	 * @return string. Title of the index page.
	 */
	public function indexTitle($post_title, $num_page)
	{				
		return $post_title . $num_page . ' | ';						
	}
	
	
	/*
	 * This is the view function.
	 * This function returns and renders the view page of the selected item.
	 */
	public function view()
	{
		
        add_filter( 'edit_post_link', '__return_false' );	
		$updated       = null;
		$class_error   = null;
		$class_updated = null;
		$error_hash    = array();		
	    
		global $wp_query;								
		$model  = new MRealtyphp_Frontend();	
		$rp_id  = isset($wp_query->query_vars['rp_id']) ? $wp_query->query_vars['rp_id'] : null;		
		$item   = $model->getItem($rp_id);
		$photos = $model->getPhotos($rp_id);
		
		if(isset($_POST['rp_subject']))
		{
		    //Validation
		    $validator = new FormValidator();
		    $model->validation($validator);
		
		    if(!$validator->ValidateForm())
			    {							
                    $error_hash = $validator->GetErrors();
				    $class_error = 'rp_message_error';				                									  		    
		        }else{
		        	$user_info = get_userdata($item[0]->user_id);
					$headers = 'From: '.get_bloginfo('name').' <'.get_bloginfo('admin_email').'>' . "\r\n";			
		        	wp_mail($user_info->user_email, 
		        	        HFilter::encode($_POST['rp_subject']), 
		        	        HFilter::encode($_POST['rp_message']),
		        	        $headers
					);					
		    	    $updated         = __("Mail sent", 'realtyphp');
				    $class_updated   = 'rp_message_updated';
			    }
		}
					
		View::render('realtyphp_frontend', 'view', array(		   
		    'item'   => $item,
		    'photos' => $photos,
		    'error_hash'     => $error_hash,
		    'updated'        => $updated,
		    'class_error'    => $class_error,
		    'class_updated'	 => $class_updated
		));	
		
	}
	
	/**
	 * This is the viewTitle function.
	 * @param string $title. Title of the page.
	 * @param int $num_page. Number of the page.
	 * @return string. Title of the view page.
	 */
	public function viewTitle($title = null, $num_page = null)
	{
			
		global $wp_query;								
		$model  = new MRealtyphp_Frontend();	
		$rp_id  = isset($wp_query->query_vars['rp_id']) ? $wp_query->query_vars['rp_id'] : null;		
		$item   = $model->getItem($rp_id);	
		return $item[0]->title . ' | ';						
	}
	
		
	
}


?>
