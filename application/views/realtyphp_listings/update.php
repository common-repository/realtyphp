<div class="wrap">
	
    <h2><?php printf(__('Update listing(ID:%d)', 'realtyphp'), $item[0]->id); ?></h2>            
    
    <p><a class="button-secondary" href="javascript:history.back()"><?php _e('Back', 'realtyphp') ?></a></p>
    
    <div class="<?php echo $class_error; ?>">
    	<?php foreach($error_hash as $inpname => $inp_err): ?>                
            <?php echo "<p>$inpname : $inp_err</p>\n"; ?>
		<?php endforeach; ?>	
                
    </div>
    
    <div class="metabox-holder has-right-sidebar">
    
    	<div class="inner-sidebar">
    		
    		<div class="postbox">
                    <h3><span><?php _e('Photo upload', 'realtyphp') ?></span></h3>
                    <div class="inside">
                                        	
                    	<p>
                    		<form id="photo_upload" enctype="multipart/form-data">
                    			<input type="file" id="photo" name="photo" />
                    			<input type="hidden" id="id_listing" name="id_listing" value="<?php 
                    			    echo (int)$_GET['id'] ?>" />
                    			<input type="hidden" name="hphoto" />
                    			<input type="submit" value="upload" />
                    		</form>
                    	</p>                    	                  
                        
                    </div>
                </div>
                
                <div class="postbox">
                    <h3><span><?php _e('Uploaded photos', 'realtyphp') ?></span></h3>                   
                    <div id="uploaded_photos" class="inside"></div>
                </div>
    		
    		</div>
    		
    		
    		<div id="post-body">
        		
        	<div id="post-body-content"> 
    		
    		
    
    <form id="realtyphp_add_listing" method="post" action="">
    	
        <table class="form-table">
        	
        	
        	<tr valign="top">
        		<th scope="row">
        		    <label for="title"><?php _e('Title', 'realtyphp'); ?><span> *</span></label>	
        		</th>
        		<td>        			
        			<input type="text" id="title" name="title" value="<?php echo $item[0]->title ?>" 
        			    size="60" maxlength="100" />
        		</td>
            </tr>
            
            
            <tr valign="top">
        		<th scope="row">
        		    <label for="description"><?php _e('Description', 'realtyphp'); ?><span> *</span></label>	
        		</th>
        		<td> 
        			<div id="textarea_error"></div>       			        			
        			<?php wp_editor( $item[0]->description, 'description',array('textarea_name' => 'description') ); ?> 
        		</td>
            </tr>
        	
        	
        	<tr valign="top">
        		<th scope="row">
        		    <label for="offer"><?php _e('Offer', 'realtyphp'); ?></label>	
        		</th>
        		<td>        			
        			<select id="offer" name="offer">        				
        		        <?php foreach($offers as $offer): ?>        		        	       		
        		            <option value="<?php echo $offer->id ?>"
        		            	<?php echo $offer->id == $item[0]->offer ? "selected=\"selcected\"" : null ?>>        		        	            		                
        		                <?php echo defined($offer->label) ? constant($offer->label) : $offer->label ?>
        		            </option>    
        		        <?php endforeach; ?>        		
        	        </select>
        		</td>
            </tr>
        	
        	
        	<tr valign="top">
        		<th scope="row">
        		    <label for="type"><?php _e('Type', 'realtyphp'); ?></label>	
        		</th>
        		<td>        			
        			<select id="type" name="type">        				
        		        <?php foreach($types as $type): ?>        			
        		            <option value="<?php echo $type->id ?>"
        		            	<?php echo $type->id == $item[0]->type ? "selected=\"selcected\"" : null ?>>        		                
        		                <?php echo defined($type->label) ? constant($type->label) : $type->label ?>      		        	
        		            </option>    
        		        <?php endforeach; ?>        		
        	        </select>
        		</td>
            </tr>
            
            
            <tr valign="top">
        		<th scope="row">
        		    <label for="price"><?php _e('Price', 'realtyphp'); ?><span> *</span></label>	
        		</th>
        		<td>        			
        			<input type="text" id="price" name="price" value="<?php echo $item[0]->price ?>" 
        			    size="10" maxlength="45" />
        			<span id="currency"> </span>
        		</td>
            </tr>
            
            
            <tr valign="top">
        		<th scope="row">
        		    <label for="area_size"><?php _e('Area size', 'realtyphp'); ?><span> *</span></label>	
        		</th>
        		<td>        			
        			<input type="text" id="area_size" name="area_size" value="<?php echo $item[0]->area_size ?>" 
        			    size="5" maxlength="45" />
        		</td>
            </tr>
            
            
            <tr valign="top">
        		<th scope="row">
        		    <label for="nr_rooms"><?php _e('Nr. rooms', 'realtyphp'); ?></label>	
        		</th>
        		<td>        			
        			<input type="text" id="nr_rooms" name="nr_rooms" value="<?php echo $item[0]->nr_rooms ?>" 
        			    size="5" maxlength="45" />
        		</td>
            </tr>
            
            
            <tr valign="top">
        		<th scope="row">
        		    <label for="zip"><?php _e('Zip', 'realtyphp'); ?></label>	
        		</th>
        		<td>        			
        			<input type="text" id="zip" name="zip" value="<?php echo $item[0]->zip ?>" 
        			    size="5" maxlength="45" />
        		</td>
            </tr>
            
            
            <tr valign="top">
        		<th scope="row">
        		    <label for="city"><?php _e('City', 'realtyphp'); ?><span> *</span></label>	
        		</th>
        		<td>        			
        			<input type="text" id="city" name="city" value="<?php echo $item[0]->city ?>" 
        			    size="20" maxlength="100" />
        		</td>
            </tr>
            
            
            <tr valign="top">
        		<th scope="row">
        		    <label for="country"><?php _e('Country', 'realtyphp'); ?><span> *</span></label>	
        		</th>
        		<td>        			
        			<select id="country" name="country">
        				<option></option> 
        		        <?php foreach($countries as $country): ?>        			
        		            <option value="<?php echo $country->id ?>"
        		            	<?php echo $country->id == $item[0]->country ? "selected=\"selcected\"" : null ?>>
        		                <?php echo defined($country->label) ? constant($country->label) : $country->label ?>        		        	
        		            </option>    
        		        <?php endforeach; ?>        		
        	        </select>
        		</td>
            </tr>
            
            
            <tr id="tr_state_province" valign="top">
	
            </tr>
            
            
            <tr valign="top">
        		<th scope="row">
        		    <label for="contact_name"><?php _e('Contact name', 'realtyphp'); ?><span> *</span></label>	
        		</th>
        		<td>        			
        			<input type="text" id="contact_name" name="contact_name" 
        			    value="<?php echo $item[0]->contact_name ?>" size="20" maxlength="45" />
        		</td>
            </tr>
            
            
            <tr valign="top">
        		<th scope="row">
        		    <label for="contact_email"><?php _e('Contact email', 'realtyphp'); ?></label>	
        		</th>
        		<td>        			
        			<input type="text" id="contact_email" name="contact_email" 
        			    value="<?php echo $item[0]->contact_email ?>" size="20" maxlength="45" />
        		</td>
            </tr>
            
            
            <tr valign="top">
        		<th scope="row">
        		    <label for="contact_phone"><?php _e('Contact Phone', 'realtyphp'); ?><span> *</span></label>	
        		</th>
        		<td>        			
        			<input type="text" id="contact_phone" name="contact_phone" 
        			    value="<?php echo $item[0]->contact_phone ?>" size="20" maxlength="45" />
        		</td>
            </tr>
            
            
            <tr valign="top">
        		<th scope="row">
        		    <label for="contact_display"><?php _e('Contact display', 'realtyphp'); ?></label>	
        		</th>
        		<td>        			
        			<select id="contact_display" name="contact_display">
        				<option value="1" <?php echo $item[0]->contact_display === 1 ? 
        				    "selected=\"selcected\"" : null ?>><?php _e('Display contact form'); ?></option>   
        				<option value="2" <?php echo $item[0]->contact_display == 2 ? 
        				    "selected=\"selcected\"" : null ?>><?php _e('Display contact information'); ?></option> 
        				<option value="3" <?php echo $item[0]->contact_display == 3 ? 
        				    "selected=\"selcected\"" : null ?>><?php _e('Do not display'); ?></option>
        				<option value="4" <?php echo $item[0]->contact_display == 4 ? 
        				    "selected=\"selcected\"" : null ?>><?php _e('Display both'); ?></option>      		               		
        	        </select>
        		</td>
            </tr>                                    
            
            
            <tr valign="top">
        		<th scope="row">
        		    <?php _e('Date added', 'realtyphp'); ?>
        		</th>
        		<td>        			
        			<?php echo $item[0]->date_added; ?>
        		</td>
            </tr>
            
            <tr valign="top">
        		<th scope="row">
        		    <?php _e('Last updated', 'realtyphp'); ?>
        		</th>
        		<td>        			
        			<?php echo $item[0]->last_updated; ?>
        		</td>
            </tr>
            
          
            <tr>
            	<td><input id="sm" class="button-primary" type="submit" value="<?php _e('Update', 'realtyphp') ?>" /></td>
            </tr>
        	 
        	        	        	           
        </table>
        
        <input type="hidden" id="id" name="id" value="<?php echo $item[0]->id ?>" />
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $item[0]->user_id ?>" />
        <input type="hidden" id="sp_id" name="sp_id" value="<?php echo $item[0]->state_province ?>" />
        <input type="hidden" id="page_status" name="page_status" value="update" />
        
    </form>
    
    
			</div><!-- postbody content -->
            
		</div><!-- postbody -->
    

    </div><!-- .metabox-holder -->
    
      	
</div><!-- wrap -->   
    
