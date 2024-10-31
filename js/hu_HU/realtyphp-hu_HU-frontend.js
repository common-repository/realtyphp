jQuery(document).ready(function($){
	                
       
    $("td.price").prettynumber({
    	delimiter : ' '
    });                                    
                   
    $('input#area_size').after(' m2');
    $('td.area_size').append(' m2');
    
    $('input#price').after(' Ft');
    $('td.price').append(' Ft');
    
    
    
    
    
    
});
