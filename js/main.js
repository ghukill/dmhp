// main js

// PHYSICIAN FORM LISTENER
// use plugin (http://jquery.malsup.com/form/) to submit forms
$(document).ready(function() { 
    // bind 'myForm' and provide a simple callback function 
    $('#physician_entry').ajaxForm({
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


// AFFILIATION FORM LISTENER
$(document).ready(function() { 
    $('#affiliation_entry').ajaxForm({
        success: success    
    }); 

    function success(data){
        console.log('form submitted');
        $("#affiliation_entry").css("color","green");
        $("#affiliation_msg").html("SET");
    }
}); 



