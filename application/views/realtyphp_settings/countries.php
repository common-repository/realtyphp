<div class="wrap">


	
    <h2 class="nav-tab-wrapper">
	    <?php _e('Settings'); ?>
	    <a href="?page=realtyphp_settings&action=countries" class="nav-tab"><?php _e('Countries', 'realtyphp') ?></a>	
	    <a href="?page=realtyphp_settings&action=propertyTypes" class="nav-tab"><?php _e('Property types', 'realtyphp') ?></a>	
    </h2>



    <div class="<?php echo $class_error; ?>"><?php echo $error; ?></div>



    <form id="realtyphp_add_country" method="post" action="">
    	
        <p>
    	    <?php _e('Country', 'realtyphp'); ?> <span> *</span> 
    	    <input type="text" id="country" name="country" value="" size="10" maxlength="45" />
    	    <input id="sm" class="button-primary" type="submit" value="<?php _e('Add new', 'realtyphp') ?>" />
        </p>
                        
    </form>



    <h3><?php _e('List of countries', 'realtyphp') ?></h3>

    <p><?php _e('Click to + for states/provinces.', 'realtyphp') ?></p>

    <p>
    <table>
		
	    <?php foreach($countries as $country): ?>    
            <tr valign="top">        		
                <td>
                	<span id="<?php echo $country->id ?>" class="span_country">+</span>
                	<?php echo defined($country->label) ? constant($country->label) : $country->label ?>
                	<div class="list_state_province" id="list_state_province_<?php echo $country->id ?>"></div>
                </td>
                <td>
                	<span class="delete"><a href="?page=realtyphp_settings&action=deleteCountry&id=<?php 
                        echo $country->id ?>"><?php _e('Delete', 'realtyphp') ?></a></span>                                     
                </td>        	
            </tr>
        <?php endforeach; ?>
    
        
		
    </table>
    </p>



</div>
