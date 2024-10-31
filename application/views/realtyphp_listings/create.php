<div class="wrap">
	
    <h2><?php _e('Add listing', 'realtyphp'); ?></h2>
    
    <div class="metabox-holder has-right-sidebar">
    	
    	<div class="inner-sidebar">
    		
    			<div class="postbox">
                    <h3><span><?php _e('Photo upload', 'realtyphp') ?></span></h3>
                    <div class="inside">
                    
                        <p><?php _e('Photos can be uploaded once the listing is added. You must min. 1 photo upload!', 'realtyphp') ?></p>                                      	                   
                        
                    </div>
                </div>                               
    		
    	</div>
    
        <div id="post-body">
        		
        	<div id="post-body-content">
        			
        		        		
    			<div class="<?php echo $class_updated; ?>">
    				<p><?php echo $updated; ?> 
    					<?php if($updated != null): ?>
    					    <a href="?page=realtyphp_listings&action=update&id=<?php echo $id_listing ?>">    					
    					    <input type="button" class="button-primary" value="<?php _e('Go to Photo upload', 'realtyphp') ?>" /></a>
    					<?php endif; ?>
    				</p>
    			</div>
    
    			<div class="<?php echo $class_error; ?>">
    			<?php foreach($error_hash as $inpname => $inp_err): ?>                
            		<?php echo "<p>$inpname : $inp_err</p>\n"; ?>
				<?php endforeach; ?>	                
    			</div>
    
    			<form id="realtyphp_add_listing" method="post" action="">    	
					<table class="form-table">
        	        	
        			    <tr valign="top">
        					<th scope="row">
        		    			<label for="title"><?php _e('Title', 'realtyphp'); ?><span> *</span></label>	
        					</th>
        					<td>        			
        						<input type="text" id="title" name="title" value="" size="60" maxlength="100" />
        					</td>
            			</tr>
                        
            			<tr valign="top">
        					<th scope="row">
        		    			<label for="description"><?php _e('Description', 'realtyphp'); ?>
        		    				<span> *</span></label>	
        					</th>
        					<td> 
        						<div id="textarea_error"></div>       			        			
        						<?php wp_editor('', 'description', array('textarea_name' => 'description')); ?> 
        					</td>
            			</tr>
        	
        	
        				<tr valign="top">
        					<th scope="row">
        		    			<label for="offer"><?php _e('Offer', 'realtyphp'); ?></label>	
        					</th>
        					<td>        			
        						<select id="offer" name="offer">        				
        		        			<?php foreach($offers as $offer): ?>        		        	       		
        		            			<option value="<?php echo $offer->id ?>">        		        	            		                
        		                			<?php echo defined($offer->label) ? constant($offer->label) : 
        		                		    	$offer->label ?>
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
        		            			<option value="<?php echo $type->id ?>">        		                
        		                			<?php echo defined($type->label) ? constant($type->label) : 
        		                			    $type->label ?>      		        	
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
        						<input type="text" id="price" name="price" value="" size="10" maxlength="45" />
        						<span id="currency"> </span>
        					</td>
           		 		</tr>
            
            
            			<tr valign="top">
        					<th scope="row">
        		    			<label for="area_size"><?php _e('Area size', 'realtyphp'); ?><span> *</span></label>	
        					</th>
        					<td>        			
        						<input type="text" id="area_size" name="area_size" value="" size="5" maxlength="45" />
        					</td>
            			</tr>
            
            
            			<tr valign="top">
        					<th scope="row">
        		    			<label for="nr_rooms"><?php _e('Nr. rooms', 'realtyphp'); ?></label>	
        					</th>
        					<td>        			
        						<input type="text" id="nr_rooms" name="nr_rooms" value="" size="5" maxlength="45" />
        					</td>
            			</tr>
            
            
            			<tr valign="top">
        					<th scope="row">
        		    			<label for="zip"><?php _e('Zip', 'realtyphp'); ?></label>	
        					</th>
        					<td>        			
        						<input type="text" id="zip" name="zip" value="" size="5" maxlength="45" />
        					</td>
            			</tr>
            
            
            			<tr valign="top">
        					<th scope="row">
        		   				<label for="city"><?php _e('City', 'realtyphp'); ?><span> *</span></label>	
        					</th>
        					<td>        			
        						<input type="text" id="city" name="city" value="" size="20" maxlength="100" />
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
        		            			<option value="<?php echo $country->id ?>">        		                
        		                			<?php echo defined($country->label) ? constant($country->label) : 
        		                		    	$country->label ?>        		        	
        		            			</option>    
        		        			<?php endforeach; ?>        		
        	        			</select>
        					</td>
           		 		</tr>
            
            
            			<tr id="tr_state_province" valign="top">
	
            			</tr>
            
            
            			<tr valign="top">
        					<th scope="row">
        		    			<label for="contact_name"><?php _e('Contact name', 'realtyphp'); ?>
        		    				<span> *</span></label>	
        					</th>
        					<td>        			
        						<input type="text" id="contact_name" name="contact_name" value="" size="20" 
        					    	maxlength="45" />
        					</td>
            			</tr>
            
            
            			<tr valign="top">
        					<th scope="row">
        		    			<label for="contact_email"><?php _e('Contact email', 'realtyphp'); ?></label>	
        					</th>
        					<td>        			
        						<input type="text" id="contact_email" name="contact_email" value="" size="20" 
        					    	maxlength="45" />
        					</td>
           		 		</tr>
            
            
            			<tr valign="top">
        					<th scope="row">
        		    			<label for="contact_phone"><?php _e('Contact Phone', 'realtyphp'); ?>
        		    				<span> *</span></label>	
        					</th>
        					<td>        			
        						<input type="text" id="contact_phone" name="contact_phone" value="" size="20" 
        					    	maxlength="45" />
        					</td>
            			</tr>
            
            
            			<tr valign="top">
        					<th scope="row">
        		    			<label for="contact_display"><?php _e('Contact display', 'realtyphp'); ?></label>	
        					</th>
        					<td>        			
        						<select id="contact_display" name="contact_display">
        							<option value="1"><?php _e('Display contact form', 'realtyphp'); ?></option>   
        							<option value="2"><?php _e('Display contact information', 'realtyphp'); ?></option> 
        							<option value="3"><?php _e('Do not display', 'realtyphp'); ?></option>
        							<option value="4"><?php _e('Display both', 'realtyphp'); ?></option>      		               		
        	        			</select>
        					</td>
            			</tr>                                    			
            
            
            			<tr>
            				<td><input id="sm" class="button-primary" type="submit" value="<?php 
            			    	_e('Submit', 'realtyphp') ?>" /></td>
            			</tr>
        	         	        	        	          
					</table>
        			        
        			<input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>" />
        			        
    			</form>
    
            </div><!-- postbody content -->
            
        </div><!-- postbody -->
    

    </div><!-- .metabox-holder -->
    
      	
</div><!-- wrap -->


    
    




