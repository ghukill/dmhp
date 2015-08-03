// autocomplete


var MIN_LENGTH = 3;

// place
/* --------------------------------------------------------------------------------------------------------------------------------------------- */
$( document ).ready(function() {
	$("#place_auto").keyup(function() {
		var keyword = $("#place_auto").val();
		if (keyword.length >= MIN_LENGTH) {
			$.get( "db/autocomplete.php", { 
				table_name: "place",
				table_column: "name",
				keyword: keyword
			} )
			.done(function( data ) {
				console.log('firing!');

				// clear debris 
				$('#place_auto_results').html('');
				$("#found_place_id").val('NULL');

				var results = jQuery.parseJSON(data);
				console.log()

				$(results).each(function(i) {
					var row = results[i];
					$('#place_auto_results').append('<div class="auto_item" id="'+row.id+'">' + row.name + '</div>');
				})

			    $('.auto_item').click(function() {

			    	// insert value
			    	var text = $(this).html();
			    	$('#place_auto').val(text);

			    	// indicate place is found and NOT to add to DB
			    	$("#found_place_id").val( $(this).attr('id') )
			    })

			});
		} else {
			$('#place_auto_results').html('');
		}
	});

    $("#place_auto").blur(function(){
    		$("#place_auto_results").fadeOut(500);
    	})
        .focus(function() {		
    	    $("#place_auto_results").show();
    	});
});
/* --------------------------------------------------------------------------------------------------------------------------------------------- */


// address
/* --------------------------------------------------------------------------------------------------------------------------------------------- */
$( document ).ready(function() {
	$("#address_auto").keyup(function() {
		var keyword = $("#address_auto").val();
		if (keyword.length >= MIN_LENGTH) {
			$.get( "db/autocomplete.php", { 
				table_name: "address",
				table_column: "address",
				keyword: keyword
			} )
			.done(function( data ) {
				console.log('firing!');

				// clear debris 
				$('#address_auto_results').html('');
				$("#found_address_id").val('NULL');

				var results = jQuery.parseJSON(data);

				$(results).each(function(i) {
					var row = results[i];
					console.log(row);
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


