function add_cus(){
	$('#add_cus').addClass('hidden');
	$('#add_cus_btn').addClass('hidden');
	$('#add_cusdiv').removeClass('hidden');
	
}
function cancel_add_cus(){
	$('#add_cusdiv').addClass('hidden');
	$('#add_cus').removeClass('hidden');
	$('#add_cus_btn').removeClass('hidden');
	
}

function edit_cus(id){
	var ddiv = "#disp_cus"+id;
	var ediv = "#edit_cusdiv"+id;
	$(ddiv).addClass('hidden');
	$(ediv).removeClass('hidden');
	
}

function cancel_edit_cus(id){
	var ddiv = "#disp_cus"+id;
	var ediv = "#edit_cusdiv"+id;
	$(ediv).addClass('hidden');
	$(ddiv).removeClass('hidden');
	
}

function save_cus(id){
	var eform = "#edit_cusform"+id;
	var data = $(eform).serialize();
	 $.post("edit_save", data)

        .done(function(data){
        	if(data=='true'){
	reload();
	} else {
		$('#cus_feedback').html(data);
	}
	  })

 .fail(function(data){
 // $("#ticker").remove();
 // alert(data);
 $('#cus_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
 });
}

function del_cus(id){
	bootbox.confirm({
	    message: "Do you want to delete the Custom Section?",
	    callback: function (result) {
	        if (result) {
				var eform = "#edit_cusform"+id;
				var data = $(eform).serialize();
				 $.post("delete_item", data)

			        .done(function(data){
			        	if(data=='true'){
				reload();
				} else {
					$('#cus_feedback').html(data);
				}
				  })

			 .fail(function(data){
	         // $("#ticker").remove();
             // alert(data);
	             $('#cus_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
		         });
			}
		}
	});
}

function new_cus(){
	var data = $('#addcus_form').serialize();
	 $.post("add_save", data)

        .done(function(data){
        	if(data=='true'){
	// $('#addcon_form').addClass('hidden');
	// $('#disp_con').removeClass('hidden');
	reload();
} else {
	$('#cus_feedback').html(data);
}
  })

 .fail(function(data){
 // $("#ticker").remove();
 // alert(data);
 $('#cus_feedback').html('<p class="alert alert-danger">Am having some issues connecting to my server, please ensure you have an active connection </p></div>');
 });
}