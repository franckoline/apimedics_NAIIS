				function add_exp(){
					$('#add_exp').addClass('hidden');
					$('#add_exp_btn').addClass('hidden');
					$('#add_expdiv').removeClass('hidden');
					
				}
				function cancel_add_exp(){
					$('#add_expdiv').addClass('hidden');
					$('#add_exp').removeClass('hidden');
					$('#add_exp_btn').removeClass('hidden');
					
				}

				function edit_exp(id){
					var ddiv = "#disp_exp"+id;
					var ediv = "#edit_expdiv"+id;
					$(ddiv).addClass('hidden');
					$(ediv).removeClass('hidden');
					
				}

				function cancel_edit_exp(id){
					var ddiv = "#disp_exp"+id;
					var ediv = "#edit_expdiv"+id;
					$(ediv).addClass('hidden');
					$(ddiv).removeClass('hidden');
					
				}

				function save_exp(id){
					var eform = "#edit_expform"+id;
					var data = $(eform).serialize();
					 $.post("edit_save", data)

				        .done(function(data){
				        	if(data=='true'){
					reload();
					} else {
						$('#exp_feedback').html(data);
					}
					  })

				 .fail(function(data){
		         // $("#ticker").remove();
	             // alert(data);
	             $('#exp_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
				}

				function del_exp(id){
					bootbox.confirm({
					    message: "Do you want to delete the Work Experience?",
					    callback: function (result) {
					        if (result) {
								var eform = "#edit_expform"+id;
								var data = $(eform).serialize();
								 $.post("delete_item", data)

							        .done(function(data){
							        	if(data=='true'){
								reload();
								} else {
									$('#exp_feedback').html(data);
								}
								  })

							 .fail(function(data){
					         // $("#ticker").remove();
				             // alert(data);
					             $('#exp_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
						         });
							}
						}
					});
				}

				function new_exp(){
					var data = $('#addexp_form').serialize();
					 $.post("add_save", data)

				        .done(function(data){
				        	if(data=='true'){
					// $('#addcon_form').addClass('hidden');
					// $('#disp_con').removeClass('hidden');
					reload();
				} else {
					$('#exp_feedback').html(data);
				}
				  })

				 .fail(function(data){
		         // $("#ticker").remove();
	             // alert(data);
	             $('#exp_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
				}