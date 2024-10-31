<?php foreach($photos as $photo): ?>   	    
   	<div id="cont_photo">
   		<p></div><img id="img_photo" src='<?php echo REALTYPHP_URL ?>uploads/thumbs/<?php echo $photo->name ?>' />
   		<a id="<?php echo $photo->id ?>" class="delete_photo"><?php _e('Delete', 'realtyphp') ?></a></p>    	 		
   	</div>   	       
<?php endforeach; ?> 
<?php if(empty($photos)): ?>
    <p><?php _e('You must min. 1 photo upload!', 'realtyphp') ?></p>  
<?php endif; ?> 
