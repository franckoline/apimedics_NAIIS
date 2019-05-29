function add_edu(){
	$('#add_edu').addClass('hidden');
	$('#add_edu_btn').addClass('hidden');
	$('#add_edudiv').removeClass('hidden');
	
}
function cancel_add_edu(){
	$('#add_edudiv').addClass('hidden');
	$('#add_edu').removeClass('hidden');
	$('#add_edu_btn').removeClass('hidden');
	
}

function edit_edu(id){
	var ddiv = "#disp_edu"+id;
	var ediv = "#edit_edudiv"+id;
	$(ddiv).addClass('hidden');
	$(ediv).removeClass('hidden');
	
}

function cancel_edit_edu(id){
	var ddiv = "#disp_edu"+id;
	var ediv = "#edit_edudiv"+id;
	$(ediv).addClass('hidden');
	$(ddiv).removeClass('hidden');
	
}

function save_edu(id){
	var eform = "#edit_eduform"+id;
	var data = $(eform).serialize();
	 $.post("edit_save", data)

        .done(function(data){
        	if(data=='true'){
	reload();
	} else {
		$('#edu_feedback').html(data);
	}
	  })

 .fail(function(data){
 // $("#ticker").remove();
 // alert(data);
 $('#edu_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
 });
}

function del_edu(id){
	bootbox.confirm({
	    message: "Do you want to delete the Education Record?",
	    callback: function (result) {
	        if (result) {
				var eform = "#edit_eduform"+id;
				var data = $(eform).serialize();
				 $.post("delete_item", data)

			        .done(function(data){
			        	if(data=='true'){
				reload();
				} else {
					$('#edu_feedback').html(data);
				}
				  })

			 .fail(function(data){
	         // $("#ticker").remove();
             // alert(data);
	             $('#edu_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
			}
		}
	});
}

function new_edu(){
	var data = $('#addedu_form').serialize();
	 $.post("add_save", data)

        .done(function(data){
        	if(data=='true'){
	// $('#addcon_form').addClass('hidden');
	// $('#disp_con').removeClass('hidden');
	reload();
} else {
	$('#edu_feedback').html(data);
}
  })

 .fail(function(data){
 // $("#ticker").remove();
 // alert(data);
 $('#edu_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
 });
}