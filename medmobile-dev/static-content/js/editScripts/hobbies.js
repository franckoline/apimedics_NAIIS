function add_hob(){
	$('#add_hob').addClass('hidden');
	$('#add_hob_btn').addClass('hidden');
	$('#add_hobdiv').removeClass('hidden');
	
}
function cancel_add_hob(){
	$('#add_hobdiv').addClass('hidden');
	$('#add_hob').removeClass('hidden');
	$('#add_hob_btn').removeClass('hidden');
	
}

function edit_hob(id){
	var ddiv = "#disp_hob"+id;
	var ediv = "#edit_hobdiv"+id;
	$(ddiv).addClass('hidden');
	$(ediv).removeClass('hidden');
	
}

function cancel_edit_hob(id){
	var ddiv = "#disp_hob"+id;
	var ediv = "#edit_hobdiv"+id;
	$(ediv).addClass('hidden');
	$(ddiv).removeClass('hidden');
	
}

function save_hob(id){
	var eform = "#edit_hobform"+id;
	var data = $(eform).serialize();
	 $.post("edit_save", data)

        .done(function(data){
        	if(data=='true'){
	reload();
	} else {
		$('#hob_feedback').html(data);
	}
	  })

 .fail(function(data){
 // $("#ticker").remove();
 // alert(data);
 $('#hob_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
 });
}

function del_hob(id){
	bootbox.confirm({
	    message: "Do you want to delete the Hobby?",
	    callback: function (result) {
	        if (result) {
				var eform = "#edit_hobform"+id;
				var data = $(eform).serialize();
				 $.post("delete_item", data)

			        .done(function(data){
			        	if(data=='true'){
				reload();
				} else {
					$('#hob_feedback').html(data);
				}
				  })

			 .fail(function(data){
	         // $("#ticker").remove();
             // alert(data);
	             $('#hob_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
			}
		}
	});
}

function new_hob(){
	var data = $('#addhob_form').serialize();
	 $.post("add_save", data)

        .done(function(data){
        	if(data=='true'){
	// $('#addcon_form').addClass('hidden');
	// $('#disp_con').removeClass('hidden');
	reload();
} else {
	$('#hob_feedback').html(data);
}
  })

 .fail(function(data){
 // $("#ticker").remove();
 // alert(data);
 $('#hob_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
 });
}