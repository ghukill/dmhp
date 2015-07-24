// autocomplete


var MIN_LENGTH = 2;


// address
/* --------------------------------------------------------------------------------------------------------------------------------------------- */
$( document ).ready(function() {
	$("#address_auto").keyup(function() {
		var keyword = $("#address_auto").val();
		if (keyword.length >= MIN_LENGTH) {
			$.get( "db/autocomplete.php", { 
				type: "address",
				keyword: keyword
			} )
			.done(function( data ) {

				// clear debris 
				$('#address_auto_results').html('');
				$("#found_address_id").val('NULL');

				var results = jQuery.parseJSON(data);

				$(results).each(function(i) {
					var row= results[i]
					$('#address_auto_results').append('<div class="auto_item" id="'+row.id+'">' + row.address + '</div>');
				})

			    $('.auto_item').click(function() {

			    	// insert value
			    	var text = $(this).html();
			    	$('#address_auto').val(text);

			    	// indicate address is found and NOT to add to DB
			    	$("#found_address_id").val( $(this).attr('id') )
			    })

			});
		} else {
			$('#address_auto_results').html('');
		}
	});

    $("#address_auto").blur(function(){
    		$("#address_auto_results").fadeOut(500);
    	})
        .focus(function() {		
    	    $("#address_auto_results").show();
    	});
});
/* --------------------------------------------------------------------------------------------------------------------------------------------- */

// affiliation name
/* --------------------------------------------------------------------------------------------------------------------------------------------- */
$( document ).ready(function() {
	$("#affiliation_name").keyup(function() {
		var keyword = $("#affiliation_name").val();
		if (keyword.length >= MIN_LENGTH) {
			$.get( "db/autocomplete.php", { 
				type: "affiliation_name",
				affiliation_autocomplete_table: affiliation_autocomplete_table,
				keyword: keyword 
			} )
			.done(function( data ) {

				// clear debris 
				$('#affiliation_name_results').html('');
				$("#found_address_id").val('NULL');

				var results = jQuery.parseJSON(data);

				$(results).each(function(i) {
					var row = results[i] // we have the address at this point
					$('#affiliation_name_results').append('<div class="auto_item" id="'+row.id+'">' + row.name + '</div>');
				})

			    $('.auto_item').click(function() {

			    	// insert value
			    	var text = $(this).html();
			    	$('#affiliation_name').val(text);

			    	// indicate address is found and NOT to add to DB
			    	$("#found_affiliation_name").val( $(this).attr('id') )
			    })

			});
		} else {
			$('#affiliation_name_results').html('');
		}
	});

    $("#affiliation_name").blur(function(){
    		$("#affiliation_name_results").fadeOut(500);
    	})
        .focus(function() {		
    	    $("#affiliation_name_results").show();
    	});
});
/* --------------------------------------------------------------------------------------------------------------------------------------------- */

