$(document).ready(function(){  
  
    $('#companies').change(function() {  
        $.ajax({  
            url: 'loadCoverages.php?id=' + $('#companies').val(), 
            success: function(data) {  
                $('#coverages').empty();              	
                $('#coverages').append(data);  
            }  
        });  
    });
    
    $('#companies').change(function() {  
        if($('#companies').val() != 0){
        $.ajax({ 
            url: 'loadCommission.php?id=' + $('#companies').val(), 
            success: function(data) {  
                $('#commission').attr('value',data);
                $('#maxDiscount').empty();
                $('#maxDiscount').append(data);               	
            }  
        });  
        }else{
        	    $('#commission').attr('value','0');
                $('#maxDiscount').empty();
                $('#maxDiscount').append('0');
                $('#send').attr('disabled',true);               	
        }
    });    
    
     $('#coverageId').change(function() {  
       if($('#coverageId').val() == 0){
           $('#send').attr('disabled',true);               	      	
       }
    });

     $('#customer').change(function() {  
       if($('#customer').val() == 0){
           $('#send').attr('disabled',true);               	      	
       }
    });    
    
    $('#calculate').click(function() {  
       $('#error').empty();
       if($('#companies').val() == 0){ $('#error').append('* Debe seleccionar una Compañía </br>'); $('#send').attr('disabled',true);}
       if($('#customer').val() == 0){ $('#error').append('* Debe seleccionar un Cliente </br>'); $('#send').attr('disabled',true);}
	   if($('#coverageId').val() == 0){ $('#error').append('* Debe seleccionar una Cobertura </br>'); $('#send').attr('disabled',true);}
	   if(parseInt($('#commissionDis').val()) > parseInt($('#commission').val())){ $('#error').append('* El porcentaje de descuento no puede ser mayor al de la comisión </br>'); $('#send').attr('disabled',true);}
  	   if($('#insuredAmount').val() == ''){ $('#error').append('* Debe ingresar una suma para asegurar </br>'); $('#send').attr('disabled',true);}
	   if($('#error').text() == ''){ 
	   		  $.ajax({ 
	            url: 'getAmount.php?companyId=' + $('#companies').val() + '&customerId=' + $('#customer').val() + '&coverageId=' + $('#coverageId').val()  + 
	            '&amount=' + $('#insuredAmount').val() + '&commissionDisc=' + $('#commissionDis').val(), 
	            success: function(data) {  
	                $('#coverageAmount').attr('value',data);               	
	            }  
       		}); 
       		$('#send').attr('disabled',false);
	   	
	   	 }
    });

});  
