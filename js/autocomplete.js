// autocomplete


var MIN_LENGTH = 2;

$( document ).ready(function() {
	$("#address_auto").keyup(function() {
		var keyword = $("#address_auto").val();
		if (keyword.length >= MIN_LENGTH) {
			$.get( "db/autocomplete.php", { keyword: keyword } )
			.done(function( data ) {

				// clear debris 
				$('#results').html('');
				$("#found_address_id").val('NULL');

				var results = jQuery.parseJSON(data);

				$(results).each(function(i) {
					var row= results[i]
					$('#results').append('<div class="auto_item" id="'+row.id+'">' + row.address + '</div>');
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
			$('#results').html('');
		}
	});

    $("#address_auto").blur(function(){
    		$("#results").fadeOut(500);
    	})
        .focus(function() {		
    	    $("#results").show();
    	});

});