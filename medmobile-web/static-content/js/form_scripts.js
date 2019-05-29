$(document).ready(function(){
      $("#FPF").hide();
})

function forgotit(){
  $("#SIF").hide();
  $("#FPF").show();
}

function backtoLogin(){
  $("#FPF").hide();
  $("#SIF").show();
}



$("#signInForm").on('submit',(function(e) {
      $("#ProcessGif").html('<img src="<?php echo base_url() ?>assets/img/loader.GIF"/>');
        var siEmail = $('#siEmail').val();
        // var siPswd = $('#siPswd').val();
        $.ajax({
            url: "signin",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data)
            {          
            	// alert(data);
            if(data =='true'){ 
            	window.location.href = 'dashboard';

            } 
            	else{
             $("#errorzz").html(data);  
            
            // $("#ProcessGif").html(data);   
            } 
            },
            error: function(data) 
            {
              alert(data);
            }           
       });e.preventDefault();  //$('#uploadForm')[0].reset();
    }));



$("#forgotPswd").on('submit',(function(e) {
      $("#ProcessGif").html('<img src="<?php echo base_url() ?>assets/img/loader.GIF"/>');
        var fEmail = $('#fEmail').val();
        $.ajax({
            url: "forgot",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data)
            {          
              // alert(data);
            // if(data =='true'){ 
            //   window.location.href = 'reset';

            // } 
            //   else{
             $("#errorzf").html(data);              
            // $("#ProcessGif").html(data);   
            // } 
            console.log($data);
            },
            error: function(data) 
            {
              alert(data);
              console.log(data);
            }           
       });e.preventDefault();  //$('#uploadForm')[0].reset();
    }));



$("#signupForm").on('submit',(function(e) {
      $("#ProcessGif").html('<img src="<?php echo base_url() ?>assets/img/loader.GIF"/>');
        $.ajax({
            url: "register",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data)
            {          
            	// alert(data);
            if(data =='true'){ 
            window.location.href = 'verify';
    } 
            	else{
             $("#errorz").html(data);  
            
            // $("#ProcessGif").html(data);   
            } 
            },
            error: function(data) 
            {
              alert(data);
            }           
       });e.preventDefault();  //$('#uploadForm')[0].reset();
    }));

