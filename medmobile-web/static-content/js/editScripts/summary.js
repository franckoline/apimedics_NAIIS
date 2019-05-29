				function add_sum(){
					$('#add_sum').addClass('hidden');
					$('#add_sumdiv').removeClass('hidden');
					
				}

				function edit_sum(){
					$('#disp_sum').addClass('hidden');
					$('#edit_sumdiv').removeClass('hidden');
					
				}
				function save_sum(){
					var data = $('#editsum_form').serialize();
					 $.post("edit_save", data)

				        .done(function(data){
				        	if(data=='true'){
					reload();
				} else {
					$('#sum_feedback').html(data);
				}
				  })

				 .fail(function(data){
		         // $("#ticker").remove();
	             // alert(data);
	             $('#sum_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
				}

				function new_sum(){
					var data = $('#addsum_form').serialize();
					 $.post("add_save", data)

				        .done(function(data){
				        	if(data=='true'){
					// $('#addcon_form').addClass('hidden');
					// $('#disp_con').removeClass('hidden');
					reload();
				} else {
					$('#sum_feedback').html(data);
				}
				  })

				 .fail(function(data){
		         // $("#ticker").remove();
	             // alert(data);
	             $('#sum_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
				}
		