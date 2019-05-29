				function add_ski(){
					$('#add_ski').addClass('hidden');
					$('#add_ski_btn').addClass('hidden');
					$('#add_skidiv').removeClass('hidden');
					
				}
				function cancel_add_ski(){
					$('#add_skidiv').addClass('hidden');
					$('#add_ski').removeClass('hidden');
					$('#add_ski_btn').removeClass('hidden');
					
				}

				function edit_ski(id){
					var ddiv = "#disp_ski"+id;
					var ediv = "#edit_skidiv"+id;
					$(ddiv).addClass('hidden');
					$(ediv).removeClass('hidden');
					
				}

				function cancel_edit_ski(id){
					var ddiv = "#disp_ski"+id;
					var ediv = "#edit_skidiv"+id;
					$(ediv).addClass('hidden');
					$(ddiv).removeClass('hidden');
					
				}

				function save_ski(id){
					var eform = "#edit_skiform"+id;
					var data = $(eform).serialize();
					 $.post("edit_save", data)

				        .done(function(data){
				        	if(data=='true'){
					reload();
					} else {
						$('#ski_feedback').html(data);
					}
					  })

				 .fail(function(data){
		         // $("#ticker").remove();
	             // alert(data);
	             $('#ski_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
				}

				function del_ski(id){
					bootbox.confirm({
					    message: "Do you want to delete the skill?",
					    callback: function (result) {
					        if (result) {
								var eform = "#edit_skiform"+id;
								var data = $(eform).serialize();
								 $.post("delete_item", data)

							        .done(function(data){
							        	if(data=='true'){
								reload();
								} else {
									$('#ski_feedback').html(data);
								}
								  })

							 .fail(function(data){
					         // $("#ticker").remove();
				             // alert(data);
					             $('#ski_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
						         });
							}
						}
					});
				}

				function new_ski(){
					var data = $('#addski_form').serialize();
					 $.post("add_save", data)

				        .done(function(data){
				        	if(data=='true'){
					// $('#addcon_form').addClass('hidden');
					// $('#disp_con').removeClass('hidden');
					reload();
				} else {
					$('#ski_feedback').html(data);
				}
				  })

				 .fail(function(data){
		         // $("#ticker").remove();
	             // alert(data);
	             $('#ski_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
				}