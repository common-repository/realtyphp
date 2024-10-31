jQuery(document).ready(function($){
	
	if($('#page_status').val() == 'update'){
	    
		$.post(ajaxurl, { action:'country_action', id: $('#country').val(), sp_id: $('#sp_id').val() },
		        function(response) {        	
		        	$('#tr_state_province').html(response);
		        }
		    );				
		
        $('#country').change(function(){
	    	
	        $.post(ajaxurl, { action:'country_action', id: $(this).val() },
	            function(response) {        	
	        	    $('#tr_state_province').html(response);
	        	}
	        );
	                        
	    });
        
        $.post(ajaxurl, { action:'photo_upload', id_listing: $('#id_listing').val() },
    	        function(response) {
                        $('#uploaded_photos').html(response);                                             
    	        }
    	 );
        
                
        $('#photo_upload').ajaxForm({ 
        	type: 'post',
        	url: ajaxurl,    	
        	data: { action: 'photo_upload', id_listing: $('#id_listing').val() },
        	success: function(response) {                                                		
        		$('#photo').val('');
        		$('#uploaded_photos').hide().html(response).fadeIn(1000);        		
        	} 
        });
        
        
        $('a.delete_photo').live('hover', function(){
        	
        	$('a.delete_photo').attr("style","cursor:pointer");
        	
        });
        
        $('a.delete_photo').live('click',function(){    		    	
        	
        	$('a.delete_photo').attr("style","cursor:wait");
        	$.post(ajaxurl, { action:'photo_delete', id_photo: $(this).attr('id'), id_listing: $('#id_listing').val() },     				
        		function(response) {                               	
        		    $('#uploaded_photos').hide().html(response).fadeIn(1000);                            
            	}    		
            );
        
        });
        
	}else{
		
		$('#country').change(function(){
	    	
	        $.post(ajaxurl, { action:'country_action', id: $(this).val() },
	            function(response) {        	
	        	    $('#tr_state_province').html(response);
	        	}
	        );
	                        
	    });
		
	}
    
    
    $('#realtyphp_add_listing').submit(function() {
    	tinyMCE.triggerSave();
    	});
    
       	
        $('#realtyphp_add_listing').validate({
    	    ignore: "",
    	    rules:{
			    "title"       : "required",
			    "description" : "required",
			    "price"       : "required",
			    "area_size"   : "required",
			    "city"        : "required",
			    "country"     : "required",
			    "contact_name": "required",
			    "contact_phone" : "required"			    
			
		    },
		
        });
        
    
    $('.span_country').toggle(function(){
	    
    	$('.span_country').attr("style","cursor:wait");
    	var attribute = '#list_state_province_' + $(this).attr('id') + '';
    	
	    $.post(ajaxurl, { action:'country_action2', id: $(this).attr('id') },
	        function(response) {
	    	   $('.span_country').removeAttr("style");
	    	   $(attribute).html(response);	    	   
	        }	    	       
	    );
	                        
	}, function(){
		
		var attribute = '#list_state_province_' + $(this).attr('id') + '';
		$(attribute).html('');
		
	});                  
    

    
 });

