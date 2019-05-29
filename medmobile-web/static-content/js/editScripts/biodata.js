				function add_bio(){
					$('#add_bio').addClass('hidden');
					$('#add_biodiv').removeClass('hidden');
					
				}

				function edit_bio(){
					$('#disp_bio').addClass('hidden');
					$('#edit_biodiv').removeClass('hidden');
					
				}
				function save_bio(){
					var data = $('#editbio_form').serialize();
					 $.post("edit_save", data)

				        .done(function(data){
				        	if(data=='true'){
					reload();
				} else {
					$('#bio_feedback').html(data);
				}
				  })

				 .fail(function(data){
		         // $("#ticker").remove();
	             // alert(data);
	             $('#bio_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
				}

				function new_bio(){
					var data = $('#addbio_form').serialize();
					 $.post("add_save", data)

				        .done(function(data){
				        	if(data=='true'){
					// $('#addcon_form').addClass('hidden');
					// $('#disp_con').removeClass('hidden');
					reload();
				} else {
					$('#bio_feedback').html(data);
				}
				  })

				 .fail(function(data){
		         // $("#ticker").remove();
	             // alert(data);
	             $('#bio_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
				}