    $('#kycForm').submit(function(e){
        e.preventDefault();
        $.ajax({
        url:'form/kycform',
        type:"post",
        data:new FormData(this), //this is formData
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(data){
         if (data == "success") {window.location.href = "application-status";}
             else{
            $('.form-results').html('<p class="alert alert-danger">' + data + '</p>');
            $('.form-results-btm').html('<p class="alert alert-danger">There are errors on the form. Scroll up to see and rectify them </p> <br/>');
             }
         }
        });
        return false; 
    });

    $('#checkDiagnose').submit(function(e){
        var token = '';
        var uri = "https://sandbox-authservice.priaid.ch/login";
        var secret_key = "e5T7Nzw6YEq24Fgd3";
        var computedHash = CryptoJS.HmacMD5(uri, secret_key);
        var computedHashString = computedHash.toString(CryptoJS.enc.Base64);
        $.ajax({
         url:uri,
         type:"POST",
         headers: {
            'Authorization': 'Bearer olatunbozadeniyi@gmail.com:' + computedHashString
            }, //this is formData
             success: function(rsp){
             token = rsp.Token;
        
        var year_of_birth = $('#year_of_birth').val();
        var gender = $('#gender').val();
        var symptom_id = $('#symptoms').val();
        var lang = "en-gb";
        var symptoms = "["+$('#symptoms').val()+"]";
        // var data = new FormData();
        var data = {'token': token, 'year_of_birth': year_of_birth, 'gender':gender,'language': lang, symptoms: symptoms};

        e.preventDefault();
          $.ajax({
             url:'https://sandbox-healthservice.priaid.ch/diagnosis',
             type:"GET",
             data: data, 
             success: function(data){
                 if(data==''){ 
                     $('#form-results').html('<p class="alert alert-warning"> Invalid ID: No result found </p>');
                 } else {
                    var patID = $('#patientID').val(); 
                    $('#form-results').html(""); 
                    $('form-results').addClass("tile-item tile-light");
                    $('#form-results').html("<br /><hr><h4> Results </h4><hr>"); 

                    for(i in data){
                         $('#form-results').append('<p> <div id="result-results"> </div> Name: '+data[i].Issue.Name+'</p><p> Accuracy: '+data[i].Issue.Accuracy+'</p><p> ICD: '+data[i].Issue.Icd+'</p><p> Icd Name: '+data[i].Issue.IcdName+'</p><p> Professional Name: '+data[i].Issue.ProfName+'</p><p> Ranking: '+data[i].Issue.Ranking+'</p><div class="btn-group" style=""><a href="#?profName='+data[i].Issue.ProfName+'&icdName='+data[i].Issue.IcdName+'&issueName='+data[i].Issue.Name+'&pat_id='+patID+'&symptom_id='+symptom_id+'&issue_id='+data[i].Issue.ID+'" onclick="invalidForm('+i+')" class="btn btn-sm btn-warning btn-inline" id="iv'+i+'">Invalid </a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="#?profName='+data[i].Issue.ProfName+'&icdName='+data[i].Issue.IcdName+'&issueName='+data[i].Issue.Name+'&pat_id='+patID+'&symptom_id='+symptom_id+'&issue_id='+data[i].Issue.ID+'" onclick="validForm('+i+')" class="btn btn-sm btn-success btn-inline" id="va'+i+'">Valid </a></div><hr>');
                         // $('#form-results').html('<p class="alert alert-danger">' + issue.Issue.Name + '</p>');
                         // console.log(data[i].Issue.Name)
                    } 
                }
             },
             failure: function(data){
                $('#form-results').html( data);
             }
           });
              
        }
        }); 
        return false; 
    });

  
    function invalidForm(id){
        var uri = ($('#iv'+id).attr('href'));
        console.log("url", uri);
        params = getUrlVars(uri);
        var issue_id = params["issue_id"];
        var pat_id = params["pat_id"];
        var issue_name = params["issueName"];
        var icd_name = params["icdName"];
        var prof_name = params["profName"];
        var symptom_id = params["symptom_id"];
        var result = "invalid";
        data = {'issue_id':issue_id, 'pat_id':pat_id, 'issue_name':issue_name, 'icd_name': icd_name, 'prof_name':prof_name,'symptom_id':symptom_id, 'result':result };
        var submitUrl = "http://localhost/apimedic/admin/form/add-report";
        console.log("baseurl", submitUrl);

      $.ajax({
         url:submitUrl,
         type:"post",
         data: data, //this is formData
         // processData:false,
         // contentType:false,
         // cache:false,
         async:false,
         success: function(data){
         if (data == "success") {$('#result-results').html('<p class="alert alert-success"> Report Added</p>');}
             else{
            $('#result-results').html('<p class="alert alert-danger">' + data + '</p>');
             }
         }
       });
        
        return false; 
    }

 function validForm(id){
        var uri = ($('#va'+id).attr('href'));
        console.log("url", uri);
        params = getUrlVars(uri);
        var issue_id = params["issue_id"];
        var pat_id = params["pat_id"];
        var issue_name = params["issueName"];
        var icd_name = params["icdName"];
        var prof_name = params["profName"];
        var symptom_id = params["symptom_id"];
        var result = "valid";
        data = {'issue_id':issue_id, 'pat_id':pat_id, 'issue_name':issue_name, 'icd_name': icd_name, 'prof_name':prof_name,'symptom_id':symptom_id, 'result':result };
        var submitUrl = "http://localhost/apimedic/admin/form/add-report";
        console.log("baseurl", submitUrl);

      $.ajax({
         url:submitUrl,
         type:"post",
         data: data, //this is formData
         // processData:false,
         // contentType:false,
         // cache:false,
         async:false,
         success: function(data){
         if (data == "success") {$('#result-results').html('<p class="alert alert-success"> Report Added</p>');}
             else{
            $('#result-results').html('<p class="alert alert-danger">' + data + '</p>');
             }
         }
       });
        
        return false; 
    }

    function getURLParameter(url, name) {
    return (RegExp(name + '=' + '(.+?)(&|$)').exec(url)||[,null])[1];
    }

$('#userReg').submit(function(e){
    e.preventDefault();
      $.ajax({
         url:'form/add-user',
         type:"post",
         data:new FormData(this), //this is formData
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success: function(data){
         if (data == "success") {$('#form-results').html('<p class="alert alert-success"> User Added</p>');}
             else{
            $('#form-results').html('<p class="alert alert-danger">' + data + '</p>');
             }
         }
       });
        return false; 
    });

$('#invalidForm').submit(function(e){
    e.preventDefault();
      $.ajax({
         url:'form/add-report',
         type:"post",
         data:new FormData(this), //this is formData
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success: function(data){
         if (data == "success") {$('#result-results').html('<p class="alert alert-success"> Report Added</p>');}
             else{
            $('#result-results').html('<p class="alert alert-danger">' + data + '</p>');
             }
         }
       });
        return false; 
    });

$('#validForm').submit(function(e){
    e.preventDefault();
      $.ajax({
         url:'form/add-report',
         type:"post",
         data:new FormData(this), //this is formData
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success: function(data){
         if (data == "success") {$('#result-results').html('<p class="alert alert-success"> Report Added</p>');}
             else{
            $('#result-results').html('<p class="alert alert-danger">' + data + '</p>');
             }
         }
       });
        return false; 
    });


(function($){
	'use strict';
	var $win = $(window), $body_m = $('body'), $navbar = $('.navbar');
	
	// Touch Class
	if (!("ontouchstart" in document.documentElement)) {
		$body_m.addClass("no-touch");
	}
	// Get Window Width
	function winwidth () {
		return $win.width();
	}
	var wwCurrent = winwidth();
	$win.on('resize', function () { 
		wwCurrent = winwidth(); 
	});

	// Sticky
	var $is_sticky = $('.is-sticky');
	if ($is_sticky.length > 0 ) {
		var $navm = $('#mainnav').offset();
		$win.scroll(function(){
			var $scroll = $win.scrollTop();
			if ($win.width() > 991) {
				if($scroll > $navm.top ){
					if(!$is_sticky.hasClass('has-fixed')) {$is_sticky.addClass('has-fixed');}
				} else {
					if($is_sticky.hasClass('has-fixed')) {$is_sticky.removeClass('has-fixed');}
				}
			} else {
				if($is_sticky.hasClass('has-fixed')) {$is_sticky.removeClass('has-fixed');}
			}
		});
	}
	
	// Active page menu when click
	var CurURL = window.location.href, urlSplit = CurURL.split("#");
	var $nav_link = $("a");
	if ($nav_link.length > 0) {
		$nav_link.each(function() {
			if (CurURL === (this.href) && (urlSplit[1]!=="")) {
				$(this).closest("li").addClass("active").parent().closest("li").addClass("active");
			}
		});
	}
    
	// Select
	var $selectbox = $('.input-select, select');
	if ($selectbox.length > 0) {
        $selectbox.each(function() {
			var $this = $(this);
            $this.select2();
		});
	}
    
    
    // Function For Toggle Class On click
    function tglcls(tigger,action,connect,connect2){
        var $toglr = tigger, $tgld = action,$tgcon = connect,$tgcon2 = connect2;
        $toglr.on("click",function(){
            $tgld.toggleClass('active');
            $toglr.toggleClass('active');
            if($tgcon.hasClass('active')){
                $tgcon.removeClass('active');
            }
            if($tgcon2.hasClass('active')){
                $tgcon2.removeClass('active');
            }
            return false;
        });
    }
    var $toggle_action = $('.toggle-action'), 
        $topbar_action = $('.topbar-action'), 
        $toggle_nav = $('.toggle-nav'), 
        $sidebar = $('.user-sidebar'),
        $sidebar_overlay = $('.user-sidebar-overlay');
	if ($toggle_action.length > 0 ) {
		tglcls($toggle_action,$topbar_action,$sidebar,$toggle_nav);
	}
	if ($toggle_nav.length > 0 ) {
		tglcls($toggle_nav,$sidebar,$topbar_action,$toggle_action);
	}
    if ($sidebar_overlay.length > 0 ) {
		$sidebar_overlay.on("click",function(){
            $sidebar.removeClass('active');
            $toggle_nav.removeClass('active');
        });
	}
    if(wwCurrent < 991){
        $sidebar.delay(500).addClass('user-sidebar-mobile');
    }else{
        $sidebar.delay(500).removeClass('user-sidebar-mobile');
    }
    $win.on('resize', function () { 
        if(wwCurrent < 991){
            $sidebar.delay(500).addClass('user-sidebar-mobile');
        }else{
            $sidebar.delay(500).removeClass('user-sidebar-mobile');
        }
	});

    


    // Transation Data Table
    var $tranx_table = $('.tranx-table');
    if($tranx_table.length > 0){
       var $tranx_table_fltr = $tranx_table.DataTable({
           "ordering": false,
           autoWidth: false,
           "dom":'<"row"<"col-10 text-left"f><"col-2 text-right"<"data-table-filter dropdown">>><"row"<"col-12"<"overflow-x-auto"t>>><"row"<"col-sm-6 text-left"p><"col-sm-6 text-sm-right"i>>',
           "pageLength": 7, 
           "bPaginate" : $('.data-table tbody tr').length>7,
           "iDisplayLength": 7,
           "language": {
                "search": "",
                "searchPlaceholder": "Type in to Search",
                "info": "_START_ -_END_ of _TOTAL_",
                "infoEmpty": "No records",
                "infoFiltered": "( Total _MAX_  )",
                "paginate": {
                    "first":      "First",
                    "last":       "Last",
                    "next":       "Next",
                    "previous":   "Prev"
                },
            },
        });
        
        $(".data-table-filter").append('<a href="#" data-toggle="dropdown"><em class="ti ti-settings"></em></a><ul class="dropdown-menu dropdown-menu-right"><li><input class="data-filter data-filter-approved" type="radio" name="filter" id="all" checked value=""><label for="all">All</label></li><li><input class="data-filter data-filter-approved" type="radio" name="filter" id="approved" value="approved"><label for="approved">Approved</label></li><li><input class="data-filter data-filter-pending" type="radio" name="filter" value="pending" id="pending"><label for="pending">Pending</label></li><li><input class="data-filter data-filter-cancled" type="radio" name="filter" value="cancled" id="cancled"><label for="cancled">Cancled</label></li></ul>');
        
        var $tranx_filter = $('.data-filter');
        $tranx_filter.on('change', function(){
            var _thisval = $(this).val();
            $tranx_table_fltr.columns('.tranx-status').search( _thisval ? _thisval : '', true, false ).draw();
        });
        
    }
    
    // Activity Data Table
    var $activity_table = $('.activity-table');
    if($activity_table.length > 0){
        $activity_table.DataTable({
           ordering: false,
           autoWidth: false,
           dom:'<"row"<"col-12"<"overflow-x-auto"t>>><"row align-items-center"<"col-sm-6 text-left"p><"col-sm-6 text-sm-right text-center"<"clear-table">>>',
           pageLength: 7, 
           bPaginate : $('.data-table tbody tr').length>7,
           iDisplayLength: 7,
           language: {
                info: "_START_ -_END_ of _TOTAL_",
                infoEmpty: "No records",
                infoFiltered: "( Total _MAX_  )",
                paginate: {
                    first:      "First",
                    last:       "Last",
                    next:       "Next",
                    previous:   "Prev"
                },
            },
        });
        $(".clear-table").append('<a href="#" class="btn btn-primary btn-xs clear-activity">Clear Activity</a>');
    }
    
    // Activity Data Table
    var $refferal_table = $('.refferal-table');
    if($refferal_table.length > 0){
        $refferal_table.DataTable({
           ordering: false,
           autoWidth: false,
           dom:'<"row"<"col-12"<"overflow-x-auto"t>>><"row align-items-center"<"col-sm-6 text-left"p><"col-sm-6 text-sm-right text-center"i>>',
           pageLength: 5, 
           bPaginate : $('.data-table tbody tr').length>5,
           iDisplayLength: 5,
           language: {
                info: "_START_ -_END_ of _TOTAL_",
                infoEmpty: "No records",
                infoFiltered: "( Total _MAX_  )",
                paginate: {
                    first:      "First",
                    last:       "Last",
                    next:       "Next",
                    previous:   "Prev"
                },
            },
        });
    }
    
    // Payment Chack (token page) 
    var $payment_check = $('.payment-check'), $payment_btn = $('.payment-btn');
    if($payment_check.length > 0){
        $payment_check.on('change', function(){
            var _thisval = $(this).val(), _thisHash = '#'+_thisval;
            $payment_btn.attr('data-target', _thisHash)
        });
    }
    
    
    // Tooltip
    var $tooltip = $('[data-toggle="tooltip"]');
    if($tooltip.length > 0){
        $tooltip.tooltip();
    }
    
    // Date Picker
    var $date_picker = $('.date-picker');
    if($date_picker.length > 0){
        $date_picker.each(function(){
            $date_picker.datepicker({ 
                format: 'mm/dd/yyyy',
                autoclose: true, 
                todayHighlight: true,
                startView: "0", 
                minViewMode: "0",
            }).datepicker('update', new Date());
        });
    }
    
    // Toggle
    function toggleTab(triger,action,connect){
        triger.on('click',function(){
            action.addClass('active');
            if(connect.hasClass('active')){
                connect.removeClass('active');
            }
            return false;
        });
    }
    
    // Make pay
    var $make_pay = $('.make-pay'),
        $pay_done = $('.pay-done'), 
        $tranx_payment_details = $('.tranx-payment-details'), 
        $tranx_purchase_details = $('.tranx-purchase-details');
    if($make_pay.length > 0){
        toggleTab($make_pay,$tranx_payment_details,$tranx_purchase_details)
    }
    if($pay_done.length > 0){
        toggleTab($pay_done,$tranx_purchase_details,$tranx_payment_details)
    }
    
    // Ath Open
    var $ath_trigger = $('.ath-trigger'), $ath_content = $('.ath-content');
    if($ath_trigger.length > 0){
        $ath_trigger.on('click', function(){
            $ath_content.slideDown();
            return false;
        });
    }
    
    // Dropzone
	var $upload_zone = $('.upload-zone');
	if ($upload_zone.length > 0 ) {
        Dropzone.autoDiscover = false;
		$upload_zone.each(function(){
			var $self = $(this);
			$self.addClass('dropzone').dropzone({ url: "/file/post" });
		});
	}

    /*-- @v1.0.1-s */
    // Copyto clipboard
    function feedback (el, state) {
        if (state==='success'){
            $(el).parent().find('.copy-feedback').text('Copied to Clipboard').fadeIn().delay(1000).fadeOut();
        } else {
            $(el).parent().find('.copy-feedback').text('Faild to Copy').fadeIn().delay(1000).fadeOut();
        }
    }
    var clipboard = new ClipboardJS('.copy-clipboard');
    clipboard.on('success', function(e) {
        feedback(e.trigger, 'success'); e.clearSelection();
    }).on('error', function(e) {
        feedback(e.trigger, 'fail');
    });
    
    // Copyto clipboard In Modal
    var clipboardModal = new ClipboardJS('.copy-clipboard-modal', {
        container: document.querySelector('.modal')
    });
    clipboardModal.on('success', function(e) {
        feedback(e.trigger, 'success'); e.clearSelection();
    }).on('error', function(e) {
        feedback(e.trigger, 'fail');
    });
    /*-- @v101-e */
})(jQuery);


function getUrlVars(uri) {
    var vars = {};
    var parts = uri.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
    }