<?php foreach($state_provinces as $state_province): ?>  
	<div class="state_province_left"><?php echo $state_province->label ?></div>
	<?php if($state_province->label != '-'): ?>
	<div class="state_province_right"><span class="delete"><a href="?page=realtyphp_settings&action=deleteSP&id=<?php 
        echo $state_province->id ?>"><?php _e('Delete', 'realtyphp') ?></a></span></div>
    <?php endif; ?>
	<div style="clear: both"></div>
<?php endforeach; ?>



<form id="realtyphp_add_sp" method="post" action="?page=realtyphp_settings&action=saveSP">
    	
    <p>
    	<?php _e('State/province', 'realtyphp'); ?> <span> *</span> 
    	<input type="text" name="sp_label" value="" size="10" maxlength="45" />
    	<input type="hidden" name="sp_country_id" value="<?php echo $country_id ?>" />
    	
    	<input id="sm" class="button-secondary" type="submit" value="<?php _e('Add new', 'realtyphp') ?>" />
    </p>
                        
</form>

 
