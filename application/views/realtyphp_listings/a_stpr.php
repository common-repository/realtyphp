<th scope="row">
    <label for="state_province"><?php _e('State/Province', 'realtyphp'); ?></label>	
</th>

<td>
    <select id="state_province" name="state_province">       
        <?php foreach($state_provinces as $state_province): ?>        			
            <option value="<?php echo $state_province->id ?>"
            	<?php echo $state_province->id == $sp_id ? "selected=\"selcected\"" : null ?>>
                <?php echo $state_province->label; ?>        		        	
            </option>    
        <?php endforeach; ?> 
    </select>
</td>