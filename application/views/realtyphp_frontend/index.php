<div id="div_frontent_listing">
<div id="rp_searchbox">
	
	<form id="rp_search_form" method="post">		
		<div><label><?php echo _e('Offer', 'realtyphp') ?></label>
		<select name="offer">
            <option value="1"><?php echo _e('For sale', 'realtyphp') ?></option>
	        <option value="2"><?php echo _e('Rent', 'realtyphp') ?></option>
		</select>
		<label><?php echo _e('Type', 'realtyphp') ?></label>
		<select id="type" name="type">        				
        <?php foreach($types as $type): ?>        			
        	<option value="<?php echo $type->id ?>">        		                
            <?php echo defined($type->label) ? constant($type->label) : $type->label ?>      		        	
        	</option>    
            <?php endforeach; ?>        		
       </select>
       <label><?php echo _e('City', 'realtyphp') ?></label><input type="text" name="city" size="20" maxlength="45" /></div>
       <div><label><?php echo _e('Area size max.', 'realtyphp') ?></label><input type="text" name="area_size" size="3" maxlength="10" />
       <label><?php echo _e('Price max.', 'realtyphp') ?></label><input type="text" name="price_max" size="10" maxlength="45" />
	   <input type="submit" value="<?php _e('Search', 'realtyphp') ?>" /></div>
	</form>

</div>


<table class="frontend_listings" id="frontend_listings">
    <thead>
        <tr>        	
        	<th>&nbsp;</th>
        	<th><?php _e('ID', 'realtyphp') ?></th>
            <th><?php _e('Offer', 'realtyphp') ?></th>
            <th><?php _e('Type', 'realtyphp') ?></th>
            <th><?php _e('Location', 'realtyphp') ?></th>
            <th><?php _e('Area', 'realtyphp') ?></th>
            <th><?php _e('Price', 'realtyphp') ?></th>
        </tr>
    </thead>
    <tbody>
    	<?php foreach($items as $item): ?>
         <tr>
			<td><?php echo HHtml::link('view&rp_id='.$item->id_listing.'&rp_ln='.$item->listing_name.
			    '', "<img src=" . REALTYPHP_URL . 
			    "/uploads/thumbs/" . $item->name_photo . " />"); ?></td>
			<td><?php echo $item->id_listing ?></td>
			<td><?php echo defined($item->label_offer) ? constant($item->label_offer) : $item->label_offer; ?></td>
			<td><?php echo defined($item->label_type) ? constant($item->label_type) : $item->label_type; ?></td>
			<td><?php echo $item->city. ($item->label_stpr == '-' ? null : '/<br /> '.$item->label_stpr) ?></td>
			<td class="area_size"><?php echo $item->area_size; ?></td>
			<td class="price"><?php echo $item->price; ?></td>
		</tr>  
		<?php endforeach; ?>
    </tbody>
</table>

<?php foreach($pagination as $pag): ?>
	<?php echo $pag . ' '; ?>
<?php endforeach; ?>

</div>