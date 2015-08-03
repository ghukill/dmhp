// main js

// autocomplete
var MIN_LENGTH = 3;
var global_phys_id = '';


// PHYSICIAN FORM LISTENER
$(document).ready(function() { 
    $('#physician_entry').ajaxForm({
        success: success    
    }); 

    function success(data){        
        setPhysician(data,$("#physician_auto").val());
    }
}); 


// function bindAffiliation(){
//     $('#affiliation_entry').ajaxForm({
//         success: success    
//     }); 

//     function success(data){
//         console.log('form submitted');
//         $("#affiliation_entry").css("color","green");
//         $("#affiliation_msg").html("SET");
//     }
// }


function bindAffiliationForm(){
    $('.affiliation_entry').ajaxForm({
        success: success    
    }); 

    function success(data){
        console.log('form submitted');
        $(this).css("color","green");
    }
}



function addAnotherAffiliation(){
   
    $("#affiliation_container").empty();
    generateAffiliation(global_phys_id);

}

function generateAffiliation(phys_id){
    
    // clone, append, and bind
    var orig_form = $("#affiliation_entry");
    var clone_form = orig_form.clone();
    console.log(clone_form.html());
    $("#affiliation_container").append(clone_form.html());
    bindAffiliationForm();
    bindAffiliationAutos();

    // update with phys_id
    $("#affiliation_container #physician_id").val(phys_id);
    $("#affiliation_container #affiliation_entry").fadeIn();

}


function setPhysician(phys_id, phys_name){
    console.log("setting physician");

    // generate affiliation
    global_phys_id = phys_id;
    generateAffiliation(phys_id);

    // set header
    $("#physician_entry .overlay").hide();
    $("#physician_msg").html("Currently working on: <span style='color:orange;'>" + phys_name + "</span>");

}


/* AUTOCOMPLETE --------------------------------------------------------------------------------------------------------------------------------------------- */

function bindAffiliationAutos(){
    // address
    $("#affiliation_container #address_auto").keyup(function() {
        var keyword = $("#affiliation_container #address_auto").val();
        if (keyword.length >= MIN_LENGTH) {
            $.get( "db/autocomplete.php", { 
                table_name: "address",
                table_column: "address",
                keyword: keyword
            } )
            .done(function( data ) {

                // clear debris 
                $('#affiliation_container #address_auto_results').html('');
                $("#affiliation_container #found_address_id").val('NULL');

                var results = jQuery.parseJSON(data);

                $(results).each(function(i) {
                    var row = results[i];
                    $('#affiliation_container #address_auto_results').append('<div class="auto_item" id="'+row.id+'">' + row.address + '</div>');
                })

                $('#affiliation_container .auto_item').click(function() {

                    // insert value
                    var text = $(this).html();
                    $('#affiliation_container #address_auto').val(text);

                    // indicate address is found and NOT to add to DB
                    $("#affiliation_container #found_address_id").val( $(this).attr('id') )
                })

            });
        } else {
            $('#affiliation_container #address_auto_results').html('');
        }
    });

    $("#affiliation_container #address_auto").blur(function(){
            $("#affiliation_container #address_auto_results").fadeOut(500);
        })
        .focus(function() {     
            $("#affiliation_container #address_auto_results").show();
        });

    // place
    $("#affiliation_container #place_auto").keyup(function() {
        var keyword = $("#affiliation_container #place_auto").val();
        if (keyword.length >= MIN_LENGTH) {
            $.get( "db/autocomplete.php", { 
                table_name: "place",
                table_column: "name",
                keyword: keyword
            } )
            .done(function( data ) {

                // clear debris 
                $('#affiliation_container #place_auto_results').html('');
                $("#affiliation_container #found_place_id").val('NULL');

                var results = jQuery.parseJSON(data);

                $(results).each(function(i) {
                    var row = results[i];
                    $('#affiliation_container #place_auto_results').append('<div class="auto_item" id="'+row.id+'">' + row.name + '</div>');
                })

                $('#affiliation_container .auto_item').click(function() {

                    // insert value
                    var text = $(this).html();
                    $('#affiliation_container #place_auto').val(text);

                    // indicate place is found and NOT to add to DB
                    $("#affiliation_container #found_place_id").val( $(this).attr('id') )
                })

            });
        } else {
            $('#affiliation_container #place_auto_results').html('');
        }
    });

    $("#affiliation_container #place_auto").blur(function(){
            $("#affiliation_container #place_auto_results").fadeOut(500);
        })
        .focus(function() {     
            $("#affiliation_container #place_auto_results").show();
        });
}

// physician
/* --------------------------------------------------------------------------------------------------------------------------------------------- */
$( document ).ready(function() {
    $("#physician_auto").keyup(function() {
        var keyword = $("#physician_auto").val();
        if (keyword.length >= MIN_LENGTH) {
            $.get( "db/autocomplete.php", { 
                table_name: "physician",
                table_column: "name",
                keyword: keyword
            } )
            .done(function( data ) {

                // clear debris 
                $('#physician_auto_results').html('');
                $("#found_physician_id").val('NULL');

                var results = jQuery.parseJSON(data);

                $(results).each(function(i) {
                    var row = results[i];
                    $('#physician_auto_results').append('<div class="auto_item" id="'+row.id+'">' + row.name + '</div>');
                })

                $('.auto_item').click(function() {

                    // insert value
                    var physician_name = $(this).html();
                    var physician_id = $(this).attr('id');
                    $('#physician_auto').val(physician_name);

                    // set name on top, add to affiliation form
                    setPhysician(physician_id,physician_name);
                    
                })

            });
        } else {
            $('#physician_auto_results').html('');
        }
    });

    $("#physician_auto").blur(function(){
            $("#physician_auto_results").fadeOut(500);
        })
        .focus(function() {     
            $("#physician_auto_results").show();
        });
});
