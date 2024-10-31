<?php
/**
 * All_Listings_Admin class file.
 * 
 * @since 1.0
 */ 
/**
 * Create a new list table package that extends the core WP_List_Table class.
 */
class All_Listings_Admin extends WP_List_Table {
	
	
	/**
	 * Constructor
	 */
	function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'item',     
            'plural'    => 'items',   
            'ajax'      => false    
        ) );
        
    }
	
	
	
	/**
     * This method is called when the parent class can't find a method
     * specifically build for a given column. 
     * @param array $item A singular item.
     * @param array $column_name The name/slug of the column to be processed
     * @return string Text or HTML to be placed inside the column <td>
     */
	function column_default( $item, $column_name ) 
	{
		
        switch( $column_name ) {
		case 'id_listing':
			return $item[ $column_name ];
		case 'user_id':
			$user_info = get_userdata($item[ $column_name ]);
			return $user_info->user_login;
		case 'label_offer':
			return defined($item[ $column_name ]) ? constant($item[ $column_name ]) : $item[ $column_name ];
		case 'label_type':
			return defined($item[ $column_name ]) ? constant($item[ $column_name ]) : $item[ $column_name ];
		case 'title':
		case 'city':
		case 'area_size':
		case 'price':
		return $item[ $column_name ];
		default:
			return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
        }

    }
	
	
	/**
	 * displaying checkboxes
	 * @param array $item
	 */
	function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
                $this->_args['singular'],  
                $item['id_listing']            
        );
    }
	
	
	/**
	 * This method dictates the table's columns and titles.
	 */
	function get_columns(){
		
        $columns = array(
            'cb'          => '<input type="checkbox" />',
            'id_listing'  => __('ID', 'realtyphp'),
            'user_id'     => __('User', 'realtyphp'),
            'label_offer' => __('Offer', 'realtyphp'),
            'label_type'  => __('Type', 'realtyphp'),
            'title'       => __('Title', 'realtyphp'),
            'city'        => __('Location', 'realtyphp'),
            'area_size'   => __('Area', 'realtyphp'),
            'price'       => __('Price', 'realtyphp')            
        );
		
        return $columns;
		
    }
	
	
	/** 
	* This method merely defines which columns should be sortable and makes them
    * clickable.
    */
	function get_sortable_columns() 
	{
		
        $sortable_columns = array(
            'id_listing'  => array('id_listing',false),
            'user_id'     => array('user_id',false),
            'label_offer' => array('id_offer',false),
            'label_type'  => array('id_type',false),
            'area_size'   => array('area_size',false),
            'price'       => array('price',false),            
        );
		
        return $sortable_columns;
		
    }
	
	
	/**
    * This checks for sorting input and sorts the data in our array accordingly.     
    */
	function usort_reorder($a,$b)
	{
		
		//If no sort, default to title
        $orderby = (!empty($_REQUEST['orderby'])) ? mysql_real_escape_string($_REQUEST['orderby']) : 'id_listing'; 
	    //If no order, default to asc
        $order = (!empty($_REQUEST['order'])) ? mysql_real_escape_string($_REQUEST['order']) : 'desc'; 
	    //Determine sort order
        $result = strcmp($a[$orderby], $b[$orderby]); 
	    //Send final sort direction to usort
        return ($order==='asc') ? $result : -$result; 
        
    }
	
	
	/**
	 * This is a custom column method and is responsible for what
     * is rendered in any column with a name/slug of 'title'.
	 * @param array $item A singular item (one full row's worth of data)
	 */
	function column_title($item) 
	{
        $actions = array(
            'edit' => sprintf('<a href="?page=%s&action=%s&id=%s">'.__('Edit', 'realtyphp').'</a>',
                $_REQUEST['page'],'update',$item['id_listing']),
            'delete' => sprintf('<a href="?page=%s&action=%s&id=%s">'.__('Delete', 'realtyphp').'</a>',
                $_REQUEST['page'],'delete',$item['id_listing']),
        );
		
        return sprintf('%1$s %2$s', $item['title'], $this->row_actions($actions) );
    }
	
	
	/**
	 * This is a custom column method and is responsible for what
     * is rendered in any column with a name/slug of 'title'.
	 * @param array $item A singular item (one full row's worth of data)
	 */
	function column_id_listing($item) 
	{
        $actions = array(
            'edit' => sprintf('<a href="?page=%s&action=%s&id=%d">Edit</a>',
                $_REQUEST['page'],'update',$item['id_listing']),
            'delete' => sprintf('<a href="?page=%s&action=%s&id=%d">Delete</a>',
                $_REQUEST['page'],'delete',$item['id_listing']),
        );
		
        return sprintf('<a href="?page=%s&action=%s&id=%d">%d</a>', 
            $_REQUEST['page'],'update',$item['id_listing'], $item['id_listing']);
    }
	
	
	/**
	 * Bulk actions.
	 */
	function get_bulk_actions() {
        $actions = array(
            'deleteSelected'    => __('Delete selected', 'realtyphp')
        );
        return $actions;
    }
	
	
	/**
	 * Process bulk actions.
	 */
	function process_bulk_action() {
        
        //Detect when a bulk action is being triggered...
        if( 'delete'===$this->current_action() ) {
            wp_die(__('Items deleted!', 'realtyphp'));
        }
        
    }
	
	
	/**
     * This is where you prepare your data for display. This method will
     * be used to query the database, sort and filter the data, and generally
     * get it ready to be displayed.     
     */		
    function prepare_items() {
    	
		global $wpdb;				
						
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
				
        $this->_column_headers = array($columns, $hidden, $sortable);
		
		$this->process_bulk_action();
		
		$search = null;							
		if( (isset($_POST['s'])) &&  ($_POST['s'] != null) )			
			$search = HSearch::byId($_POST['s'], 't1.id');
		
		if(current_user_can('administrator'))
		{
									                									
		    $data=$wpdb->get_results("SELECT *,t1.id AS id_listing, t2.id AS id_offer, t3.id as id_type,
		        t2.label as label_offer, t3.label as label_type
		        FROM ".$wpdb->prefix."realtyphp_listings as t1, ".$wpdb->prefix."realtyphp_offer as t2, 
		        ".$wpdb->prefix."realtyphp_property_types as t3
		        WHERE t1.offer = t2.id AND t1.type = t3.id $search", ARRAY_A);
			
		}else{
			
	        $data=$wpdb->get_results("SELECT *,t1.id AS id_listing, t2.id AS id_offer, t3.id as id_type,
		        t2.label as label_offer, t3.label as label_type
		        FROM ".$wpdb->prefix."realtyphp_listings as t1, ".$wpdb->prefix."realtyphp_offer as t2, 
		        ".$wpdb->prefix."realtyphp_property_types as t3
		        WHERE t1.offer = t2.id AND t1.type = t3.id $search 
		        AND t1.user_id = ". get_current_user_id() ."", ARRAY_A);
			
		}
		
		//Sorting data
		usort($data, array($this,'usort_reorder'));	
		
		//Pagination
		$per_page = 10;
		$current_page = $this->get_pagenum();
        $total_items = count($data);				
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);	
		
		$this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );						
		
        $this->items = $data;
	
    }
	
	
	
	
	
	
	
	
}




?>