function add_ref(){
	$('#add_ref').addClass('hidden');
	$('#add_ref_btn').addClass('hidden');
	$('#add_refdiv').removeClass('hidden');
	
}
function cancel_add_ref(){
	$('#add_refdiv').addClass('hidden');
	$('#add_ref').removeClass('hidden');
	$('#add_ref_btn').removeClass('hidden');
	
}

function edit_ref(id){
	var ddiv = "#disp_ref"+id;
	var ediv = "#edit_refdiv"+id;
	$(ddiv).addClass('hidden');
	$(ediv).removeClass('hidden');
	
}

function cancel_edit_ref(id){
	var ddiv = "#disp_ref"+id;
	var ediv = "#edit_refdiv"+id;
	$(ediv).addClass('hidden');
	$(ddiv).removeClass('hidden');
	
}

function save_ref(id){
	var eform = "#edit_refform"+id;
	var data = $(eform).serialize();
	 $.post("edit_save", data)

        .done(function(data){
        	if(data=='true'){
	reload();
	} else {
		$('#ref_feedback').html(data);
	}
	  })

 .fail(function(data){
 // $("#ticker").remove();
 // alert(data);
 $('#ref_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
 });
}

function del_ref(id){
	bootbox.confirm({
	    message: "Do you want to delete the Referee?",
	    callback: function (result) {
	        if (result) {
				var eform = "#edit_refform"+id;
				var data = $(eform).serialize();
				 $.post("delete_item", data)

			        .done(function(data){
			        	if(data=='true'){
				reload();
				} else {
					$('#ref_feedback').html(data);
				}
				  })

			 .fail(function(data){
	         // $("#ticker").remove();
             // alert(data);
	             $('#ref_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
			}
		}
	});
}

function new_ref(){
	var data = $('#addref_form').serialize();
	 $.post("add_save", data)

        .done(function(data){
        	if(data=='true'){
	// $('#addcon_form').addClass('hidden');
	// $('#disp_con').removeClass('hidden');
	reload();
} else {
	$('#ref_feedback').html(data);
}
  })

 .fail(function(data){
 // $("#ticker").remove();
 // alert(data);
 $('#ref_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
 });
}