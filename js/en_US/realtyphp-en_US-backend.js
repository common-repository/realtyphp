jQuery(document).ready(function($){
	                
    $('input#price').autoNumeric({
    	aSep: ',',
    	aPad:false	
    });
        
    
    $('input#area_size').autoNumeric({
		aSep: ',',
		aPad:false		
    });
    
    $('input#nr_rooms').autoNumeric({
		aSep: ',',
		aPad:false
    });
    
    $('input#zip').autoNumeric({
		aSep: false,
		aPad:false
    });
    
    
    $("td.price").prettynumber({
    	delimiter : ','
    });
    
    
    $("#realtyphp_add_listing").submit(function(){
    	
    	if($("#realtyphp_add_listing").valid() === true)
    	{
    		    		
    		var price = $("#price").val().replace(/,/g,'');
    		$("#price").val(price);
    		
    		var area_size = $("#area_size").val().replace(/,/g,'');
    		$("#area_size").val(area_size);
    		
    		var nr_rooms = $("#nr_rooms").val().replace(/,/g,'');
    		$("#nr_rooms").val(nr_rooms);    		    		
        	      	
    		
    	}
    	
    });
    
    $('span.delete').live('click', function() {
        return confirm("Are you sure?");
    });
    
    
    $('input#area_size').after(' m2');
    $('td.area_size').append(' m2');
    
    $('input#price').after(' USD');
    $('td.price').prepend('USD ');
    
});