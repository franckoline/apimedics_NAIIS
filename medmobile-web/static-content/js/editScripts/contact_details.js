				function edit_con(){
					$('#disp_con').addClass('hidden');
					$('#edit_con').removeClass('hidden');
					
				}

				function add_con(){
					$('#add_con').addClass('hidden');
					$('#add_conform').removeClass('hidden');
					
				}

				function save_con(){
					var data = $('#con_form').serialize();
					 $.post("edit_save", data)

				        .done(function(data){
				        	if(data=='true'){
					$('#edit_con').addClass('hidden');
					$('#disp_con').removeClass('hidden');
					reload();
				} else {
					$('#con_feedback').html(data);
				}
				  })

				 .fail(function(data){
		         // $("#ticker").remove();
	             // alert(data);
	             $('#con_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
				}

				function save_addcon(){
					var data = $('#addcon_form').serialize();
					 $.post("add_save", data)

				        .done(function(data){
				        	if(data=='true'){
					// $('#addcon_form').addClass('hidden');
					// $('#disp_con').removeClass('hidden');
					reload();
				} else {
					$('#con_feedback').html(data);
				}
				  })

				 .fail(function(data){
		         // $("#ticker").remove();
	             // alert(data);
	             $('#con_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
				}