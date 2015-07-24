// main js

var affiliation_autocomplete_table = '';


// use plugin (http://jquery.malsup.com/form/) to submit forms
$(document).ready(function() { 
    // bind 'myForm' and provide a simple callback function 
    $('.entry_form').ajaxForm({
    	success: success	
    }); 

    function success(data){
    	console.log('form submitted');
    	console.log(data);
    	$("#physician_id").val(data);
    	$("#physician_entry").css("color","green");
    	$("#physician_msg").html("SET");
    }
}); 



$(document).ready(function() {
  $("#affiliation_type_combined").on("change",function() {    
    affiliation_autocomplete_table = this.value.split("|")[1]
    console.log(affiliation_autocomplete_table); 
  }); 
});