<div id="div_frontent_listing">

<p><a href="javascript:history.back()"><?php _e('Back', 'realtyphp') ?></a></p>
<div style="clear: both"></div>

<table class="frontend_listing" id="frontend_listing">
    <thead>
        <tr>        	        	
        	<th id="th_left"><?php _e('ID', 'realtyphp') ?></th>
            <th><?php echo $item[0]->id_listing; ?></th>            
        </tr>
    </thead>
    <tbody>    	
         <tr>			
			<td><?php _e('Offer', 'realtyphp') ?></td>
			<td><?php echo defined($item[0]->label_offer) ? constant($item[0]->label_offer) : $item[0]->label_offer ?></td>
		</tr>  
		<tr>			
			<td><?php _e('Type', 'realtyphp') ?></td>
			<td><?php echo defined($item[0]->label_type) ? constant($item[0]->label_type) : $item[0]->label_type ?></td>
		</tr>
		<tr>			
			<td><?php _e('Location', 'realtyphp') ?></td>
			<td><?php echo ($item[0]->zip != 0 ? $item[0]->zip : null).' '.$item[0]->city.
			    ($item[0]->label_stpr == '-' ? null : '/ '.$item[0]->label_stpr) ?></td>
		</tr> 
		<tr>			
			<td><?php _e('Price', 'realtyphp') ?></td>
			<td class="price"><?php echo $item[0]->price ?></td>
		</tr> 
		<tr>			
			<td><?php _e('Area size', 'realtyphp') ?></td>
			<td class="area_size"><?php echo $item[0]->area_size ?></td>
		</tr>
		<tr>			
			<td><?php _e('Nr. rooms', 'realtyphp') ?></td>
			<td><?php echo $item[0]->nr_rooms ?></td>
		</tr>
		<tr>			
			<td><?php _e('Description', 'realtyphp') ?></td>
			<td><?php echo $item[0]->description ?></td>
		</tr>
		<tr>			
			<td><?php _e('Contact name', 'realtyphp') ?></td>
			<td><?php echo $item[0]->contact_name ?></td>
		</tr>
		<?php if($item[0]->contact_display == 2 || $item[0]->contact_display == 4): ?>        
		<tr>			
			<td><?php _e('Contact email', 'realtyphp') ?></td>
			<td><?php echo $item[0]->contact_email ?></td>
		</tr>
		<tr>			
			<td><?php _e('Contact phone', 'realtyphp') ?></td>
			<td><?php echo $item[0]->contact_phone ?></td>
		</tr>		
		<?php endif; ?>		
		<tr>			
			<td><?php _e('Date added', 'realtyphp') ?></td>
			<td><?php echo date_i18n(get_option('date_format') ,strtotime($item[0]->date_added)); ?></td>
		</tr>
		<tr>			
			<td><?php _e('Last updated', 'realtyphp') ?></td>
			<td><?php echo date_i18n(get_option('date_format') ,strtotime($item[0]->last_updated)); ?></td>
		</tr>		
    </tbody>
</table>
<div id="cont_galleria">
	
    <div id="galleria">
	<?php foreach($photos as $photo): ?>	
	        <a href="<?php echo REALTYPHP_URL . 'uploads/' . $photo->name ?>"><img src="<?php 
	            echo REALTYPHP_URL . 'uploads/thumbs/' . $photo->name ?>" alt="" /></a>
    <?php endforeach; ?>
    </div>

    <?php if($item[0]->contact_display == 1 || $item[0]->contact_display == 4): ?> 
    <div id="rp_message_div">	
    	
    	<div class="<?php echo $class_error; ?>">
        <?php foreach($error_hash as $inpname => $inp_err): ?>                
            <?php echo "<div>$inp_err</div>\n"; ?>
        <?php endforeach; ?>	                
        </div>
        <div class="<?php echo $class_updated; ?>">
    	    <?php echo $updated; ?>			
    	</div>
        
	    <form id="rp_message_form" method="post">
		    <div><label><?php _e('Subject', 'realtyphp') ?></label><br />
		    <input id="rp_message_form_input_text" type="text" name="rp_subject" size="28" maxlength="45" /></div>				
		    <div><label><?php _e('Message', 'realtyphp') ?></label><br />
		    <textarea id="rp_message_form_ta" name="rp_message" cols="27" rows="5"></textarea></div>		
		    <div><input id="rp_message_submit" type="submit" value="<?php _e('Send', 'realtyphp') ?>" /></div>		    	
	    </form>	
    </div>
    <?php endif; ?>
</div>

<script>
    Galleria.loadTheme('<?php echo REALTYPHP_URL ?>js/galleria/galleria.classic.min.js');
    Galleria.run('#galleria');
    Galleria.configure({
        lightbox: true
    })
</script>


</div>