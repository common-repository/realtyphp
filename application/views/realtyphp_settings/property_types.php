<div class="wrap">


	
    <h2 class="nav-tab-wrapper">
	    <?php _e('Settings', 'realtyphp'); ?>
	    <a href="?page=realtyphp_settings&action=countries" class="nav-tab"><?php _e('Countries', 'realtyphp') ?></a>	
	    <a href="?page=realtyphp_settings&action=propertyTypes" class="nav-tab"><?php _e('Property types', 'realtyphp') ?></a>	
    </h2>



    <div class="<?php echo $class_error; ?>"><?php echo $error; ?></div>



    <form id="realtyphp_add_type" method="post" action="">
    	
        <p>
    	    <?php _e('Property type', 'realtyphp'); ?> <span> *</span> 
    	    <input type="text" id="type" name="type" value="" size="10" maxlength="45" />
    	    <input id="sm" class="button-primary" type="submit" value="<?php _e('Add new', 'realtyphp') ?>" />
        </p>
                        
    </form>



    <h3><?php _e('List of property types', 'realtyphp') ?></h3>
    

    <p>
    <table>
		
	    <?php foreach($types as $type): ?>    
            <tr valign="top">        		
                <td><?php echo defined($type->label) ? constant($type->label) : $type->label ?></td>
                <td>
                	<span class="delete"><a href="?page=realtyphp_settings&action=deleteType&id=<?php 
                        echo $type->id ?>"><?php _e('Delete', 'realtyphp') ?></a></span>                                     
                </td>        	
            </tr>
        <?php endforeach; ?>
            		
    </table>
    </p>



</div>
