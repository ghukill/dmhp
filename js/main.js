// main js



// use plugin (http://jquery.malsup.com/form/) to submit forms
$(document).ready(function() { 
    // bind 'myForm' and provide a simple callback function 
    $('.entry_form').ajaxForm(function() { 
        console.log('form submitted');
    }); 
}); 

