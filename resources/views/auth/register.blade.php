<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <!-- Bootstrap 3.3.6 -->  
  <link rel="stylesheet" href="{{ asset('public/adminlte/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet"  href="{{ asset('public/adminlte/plugins/iCheck/square/blue.css')}}">
  
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.js"></script>
  
  
  <!-- jQuery 2.2.3 -->
<script  src="{{ asset('public/adminlte/plugins/jQuery/jquery-2.2.3.min.js')}}" ></script>
<!-- Bootstrap 3.3.6 -->
<script  src="{{ asset('public/adminlte/bootstrap/js/bootstrap.min.js')}}" ></script>
<!-- iCheck -->
<script  src="{{ asset('public/adminlte/plugins/iCheck/icheck.min.js')}}"></script>



<script  src="{{ asset('public/jquery-ui.js')}}"></script>


<script>
/*
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
*/  
</script>
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
    <style>
.body_register{
background-image: url("{{ asset('public/azmproject_images/signup.jpg') }}");
background-size:100%;
}
</style>
  
  
  
</head>
<body class="hold-transition register-page body_register">
   <form method="POST" action="{{ route('register') }}" id='form_register'>
      @csrf



  <div id="msform">
    <!-- progressbar -->
    <ul id="progressbar">
      <li class="active"><b>Account Setup</b></li>
      <li><b>Products You Like</b></li>
    </ul>
    <!-- fieldsets -->
     <fieldset style='' id='accoun_settings'>
	
      <p class="fs-title">Signup Now</p><br>
	  <div style='text-align:left'>
	      
	     
	     
       <div class="form-group has-feedback">
          <!-- 
       	 <input  placeholder="Full name"  id="name" type="text" class="required form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
								
								
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
          --> 
           
           
        
        <div class='row'>
            
          
   
		<div class='col-lg-6'>  
		<input  placeholder="First name"  id="name" type="text" class="required form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                             @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
								
								
                <span id="name_error" class="invalid-feedback disabled" role="alert"></span>
        </div>
      
    
         <div class='col-lg-6'>  
		 <input  placeholder="Last name"  id="lastname" type="text" class="required form-control{{ $errors->has('v') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>

                            @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                                
                        <span id="lastname_error" class="invalid-feedback disabled" role="alert"></span>        

        </div>
        
    
        
        </div>

      </div>
      
      <div class="form-group has-feedback">
	   
         <input placeholder="Zipcode" id="zipcode" type="text" class="required form-control{{ $errors->has('zipcode') ? ' is-invalid' : '' }}" name="zipcode" value="{{ old('zipcode') }}" required>

			@if ($errors->has('zipcode'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('zipcode') }}</strong>
				</span>
			@endif
        <span class="glyphicon glyphicon-home form-control-feedback"></span>
		
      </div>
	  
	  
      <div class="form-group has-feedback">
         <input placeholder="Email" id="email" type="email" class="required form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                                
                                
               <span id="email_error" class="invalid-feedback disabled" role="alert"></span>                  
                                
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        
        
      </div>
      
      <div class="form-group has-feedback">
   	
		<input  placeholder="Password" id="password" type="password" class="required form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

			@if ($errors->has('password'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
			
			
			<span id="password_error" class="invalid-feedback disabled" role="alert"></span>
			
		
		
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  
	  
      <div class="form-group has-feedback">
		 <input placeholder="Retype password" id="password_confirmation" type="password" class="required form-control" name="password_confirmation" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
	  
	  
	  
	  
	  <hr/>
	  
	  <style>
	      hr {
                display: block;
                height: 2px;
                border: 0;
                border-top: 1px solid #babbbf;
               margin-bottom: 20px;
               margin-top : 30px;
                padding: 0;
            }
	  </style>
	  
	  
	   <div class="form-group has-feedback">
	       <label for="exampleInputEmail1">When Were You Born?</label><br>
	   <div class='row'>
		   <div class='col-lg-6'>
				
				<select name='month' class='required form-control' id='month' >
				<option value='' style='color:#d9dade!important'>Month</option>
				<option value='01'>January</option>
				<option value='02'>February</option>
				<option value='03'>March</option>
				<option value='04'>April</option>
				<option value='05'>May</option>
				<option value='06'>June</option>
				<option value='07'>July</option>
				<option value='08'>August</option>
				<option value='09'>September</option>
				<option value='10'>October</option>
				<option value='11'>November</option>
				<option value='12'>December</option>
				</select>
	   </div>
	   
		
		
		
	<div class='col-lg-6'>
		<input  type="text" placeholder="YYYY" min="1900" max="2200"  id="year" name='year'  class="required form-control" pattern="[0-9]+" onKeyPress="if(this.value.length==4) return false;"   >
	</div>
		
		
		    <script>
             $(function(){
                          $("input[name='year']").on('input', function (e) {
                            $(this).val($(this).val().replace(/[^0-9]/g, ''));
                          });
                        });
            </script>
	   
	   
	</div>
	   
	   
 
			
    </div>
	  
	  
	  
      
	  
	  </div>
      <input type="button" name="next" class="next action-button" value="Next" /><br>
       <!--<a href="{{ route('login') }}" class="text-center">Back to Login Page</a>-->
      
      
   

   </fieldset>
	
	

	
	
    <fieldset style='width:145%!important;margin-left:-110px!important;'>
      <p class="fs-title"><b>Select Product Interest</b></p><br>
		<div class="row">
				
		<div style='text-align:left'>
		
		<div class='col-md-12'>
		<input id="selectall2" name='selectall2'  onchange="checkBoxClicked1()"  type="checkbox" />&nbsp; <label for="selectall2">Select All</label> <br>
		</div>
		<div class='col-md-6'>
			<input id="chk1" name="group_interest[]" value="chk1" type="checkbox">&nbsp; <label for="chk1">Baby</label> <br>
			<input id="chk2" name="group_interest[]" value="chk2" type="checkbox">&nbsp; <label for="chk2">Beauty</label> <br>
			<input id="chk3" name="group_interest[]" value="chk3" type="checkbox">&nbsp; <label for="chk3">Clothing & Accessories</label> <br>
			<input id="chk4" name="group_interest[]" value="chk4" type="checkbox">&nbsp; <label for="chk4">Consumer Electronics</label> <br>
			<input id="chk5" name="group_interest[]" value="chk5" type="checkbox">&nbsp; <label for="chk5">Grocery & Gourmet Foods</label> <br>
			<input id="chk6" name="group_interest[]" value="chk6" type="checkbox">&nbsp; <label for="chk6">Health & Personal Care</label> <br>
			<input id="chk7" name="group_interest[]" value="chk7" type="checkbox">&nbsp; <label for="chk7">Home & Garden</label> <br>
			<input id="chk8" name="group_interest[]" value="chk8" type="checkbox">&nbsp; <label for="chk8">Travel</label> <br>
			<input id="chk9" name="group_interest[]" value="chk9" type="checkbox">&nbsp; <label for="chk9">Music</label> <br>
		</div>
		<div class='col-md-6'>
			<input id="chk10" name="group_interest[]" value="chk10" type="checkbox">&nbsp; <label for="chk10">Office Products</label> <br>
			<input id="chk11" name="group_interest[]" value="chk11" type="checkbox">&nbsp; <label for="chk11">Outdoors</label> <br>
			<input id="chk12" name="group_interest[]" value="chk12" type="checkbox">&nbsp; <label for="chk12">Computers</label> <br>
			<input id="chk13" name="group_interest[]" value="chk13" type="checkbox">&nbsp; <label for="chk13">Pet Supplies</label> <br>
			<input id="chk14" name="group_interest[]" value="chk14" type="checkbox">&nbsp; <label for="chk14">Shoes, Handbags, & Sunglasses</label> <br>
			<input id="chk15" name="group_interest[]" value="chk15" type="checkbox">&nbsp; <label for="chk15">Software</label> <br>
			<input id="chk16" name="group_interest[]" value="chk16" type="checkbox">&nbsp; <label for="chk16">Sports</label> <br>
			<input id="chk17" name="group_interest[]" value="chk17" type="checkbox">&nbsp; <label for="chk17">Tools & Home Improvement</label> <br>
			<input id="chk18" name="group_interest[]" value="chk18" type="checkbox">&nbsp; <label for="chk18">Toys</label> <br>
			
		</div>
		</div>						
					

		</div>
	
	
	
	
	<br>
      <input type="button" name="previous" class="previous action-button" value="Previous" />
      <input type="submit" name="submit" class="submit action-button" value="Submit" />
    </fieldset>
	
	
	
  </div>
  
</form>




	




<!-- /.register-box -->





</body>
</html>

<div id="modalshow" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->

        
        <div class="modal-content">
        <div class="modal-header"></div>
        <div class="modal-body">
            <center><h2>Thank you for answering our questions.</h2></center>
            <div style='clear:both;margin-top:15px'></div>
			<center>
    			<span style='font-size:16px'>We thought about it for a bit, and we think you’ll be a great addition to our Product Tester community!</span><br><br>
    			<span style='font-size:15px'>Join our waitlist so we can let you know when new membership slots are available. </span>
			</center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
        

    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){


	var options = { backdrop : 'static'}
	$('#modalshow').modal(options);


});
</script>


<style>

.enabled
{
    display:block;
}

.disabled
{
    display:none;
}


label {
    
    font-weight: 400 !important;
}


.profilepress-reg-status {
  border-radius: 6px;
  font-size: 17px;
  line-height: 1.471;
  padding: 10px 19px;
  background-color: #e74c3c;
  color: #ffffff;
  font-weight: normal;
  display: block;
  text-align: center;
  vertical-align: middle;
  margin: 5px 0;
}
/*form styles*/

#msform {
  width: 400px;
  /*margin: 50px auto 50px;*/
  margin-right : auto;
  margin-left :auto;
  margin-top:10px;
  text-align: center;
  position: relative;
}

#msform fieldset {
  background: white;
  border: 0 none;
  border-radius: 3px;
  box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
  padding: 20px 30px;
  box-sizing: border-box;
  width: 95%;
  margin: 0 10%;
  /*stacking fieldsets above each other*/
  
  position: absolute;
}
/*Hide all except first fieldset*/

#msform fieldset:not(:first-of-type) {
  display: none;
}
/*inputs*/

/*
#msform input,
#msform textarea {
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin-bottom: 10px;
  width: 100%;
  box-sizing: border-box;
  font-family: montserrat;
  color: #2C3E50;
  font-size: 13px;
}
*/

/*buttons*/

#msform .action-button {
  width: 100px;
  background: #27AE60;
  font-weight: bold;
  color: white;
  border: 0 none;
  border-radius: 1px;
  cursor: pointer;
  padding: 5px 5px;
  margin: 10px 5px;
}

#msform .action-button:hover,
#msform .action-button:focus {
  box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
}
/*headings*/

.fs-title {
  font-size: 15px;
  text-transform: normal;
  color: #2C3E50;
  margin-bottom: 10px;
}

.fs-subtitle {
  font-weight: normal;
  font-size: 13px;
  color: #666;
  margin-bottom: 20px;
}
/*progressbar*/

#progressbar {
  margin-bottom: 30px;
  overflow: hidden;
  /*CSS counters to number the steps*/
  
  counter-reset: step;
}

#progressbar li {
  list-style-type: none;
  color: #616161;
  /*text-transform: uppercase;*/
  font-size: 11px;
  width: 40.33%;
  float: left;
  position: relative;
}

#progressbar li:before {
  content: counter(step);
  counter-increment: step;
  width: 20px;
  line-height: 30px;
  display: block;
  font-size: 20px;
  color: #333;
  background: white;
  border-radius: 4px;
  margin: 0 auto 6px auto;
}

#progressbar li:first-child:after {
  /*connector not needed before the first step*/
  
  content: none;
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/

#progressbar li.active:before,
#progressbar li.active:after {
  background: #27AE60;
  color: white;
}


.highlight
{
    border: 1px solid red !important;
}
</style>



<script>


$('#selectall2').click(function() {
    
    if (this.checked) {
            $("input:checkbox").each(function() {
                this.checked=true;
            });
        } else {
            $("input:checkbox").each(function() {
                this.checked=false;
            });
        }
    
});







(function($) {
    /*
    $("#selectall2").click(function() {
        
        alert('test');
        
    });
    */
    
    
    
    
})(jQuery);


</script>



<script>
/*
$("#selectall").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 }); 
 */
/* 
   $("#selectall").click(function() {
       
       alert('test');
        if (this.checked) {
            $("input:checkbox").each(function() {
                this.checked=true;
            });
        } else {
            $("input:checkbox").each(function() {
                this.checked=false;
            });
        }
    });
*/    
</script>	




<script>

//jQuery time
(function($) {
  var current_fs, next_fs, previous_fs; //fieldsets
  var left, opacity, scale; //fieldset properties which we will animate
  var animating; //flag to prevent quick multi-click glitches

  $(".next").click(function() {
      
      
     var aa = validateinput();
     var myJSON = JSON.parse(JSON.stringify(aa)); 

      if (myJSON != '{"result":"success"}') 
      {
             return false;   
      }
    
    

    var  check =   checkifcomplete();     
    if(check == false)
	{
		
		return false;
	}


	
    if (animating) return false;
    animating = true;

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //activate next step on progressbar using the index of next_fs
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({
      opacity: 0
    }, {
      step: function(now, mx) {
        //as the opacity of current_fs reduces to 0 - stored in "now"
        //1. scale current_fs down to 80%
        scale = 1 - (1 - now) * 0.2;
        //2. bring next_fs from the right(50%)
        left = (now * 50) + "%";
        //3. increase opacity of next_fs to 1 as it moves in
        opacity = 1 - now;
        current_fs.css({
          'transform': 'scale(' + scale + ')'
        });
        next_fs.css({
          'left': left,
          'opacity': opacity
        });
      },
      duration: 800,
      complete: function() {
        current_fs.hide();
        animating = false;
      },
      //this comes from the custom easing plugin
      easing: 'easeInOutBack'
    });
  });

  $(".previous").click(function() {
    if (animating) return false;
    animating = true;

    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

    //show the previous fieldset
    previous_fs.show();
    //hide the current fieldset with style
    current_fs.animate({
      opacity: 0
    }, {
      step: function(now, mx) {
        //as the opacity of current_fs reduces to 0 - stored in "now"
        //1. scale previous_fs from 80% to 100%
        scale = 0.8 + (1 - now) * 0.2;
        //2. take current_fs to the right(50%) - from 0%
        left = ((1 - now) * 50) + "%";
        //3. increase opacity of previous_fs to 1 as it moves in
        opacity = 1 - now;
        current_fs.css({
          'left': left
        });
        previous_fs.css({
          'transform': 'scale(' + scale + ')',
          'opacity': opacity
        });
      },
      duration: 800,
      complete: function() {
        current_fs.hide();
        animating = false;
      },
      //this comes from the custom easing plugin
      easing: 'easeInOutBack'
    });
  });

})(jQuery);

</script>





<script type="text/javascript">

                
function  validateinput(){ 
    
    var xx = false;
     var formData = new FormData($('#form_register')[0]);

             event.preventDefault();
               jQuery.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               
               var response = jQuery.ajax({
                  url: "{{ route('testkomuna') }}",
                  method: 'post',
                  data: formData,
                  contentType: false,
                 cache: false,
                  async: false,
                 processData: false,
                  success: function(data){
                      
                      console.log(data);
                      
                      
                     if (data.email  != undefined) {
                         $("#email_error").removeClass('disabled').addClass('enabled').html("<strong>"+data.email+"</strong>");
                         xx = false;
                     }
                     else
                     {
                          $("#email_error").removeClass('enabled').addClass('disabled');
                     }
                     
                     
                     if (data.name  != undefined) {
                         $("#name_error").removeClass('disabled').addClass('enabled').html("<strong>"+data.name+"</strong>");
                         xx = false;
                     }
                     else
                     {
                          $("#name_error").removeClass('enabled').addClass('disabled');
                     }
                     
                     
                     if (data.lastname  != undefined) {
                         $("#lastname_error").removeClass('disabled').addClass('enabled').html("<strong>"+data.lastname+"</strong>");
                         xx = false;
                     }
                     else
                     {
                          $("#lastname_error").removeClass('enabled').addClass('disabled');
                     }
                     
                     
                     if (data.password  != undefined) {
                         $("#password_error").removeClass('disabled').addClass('enabled').html("<strong>"+data.password+"</strong>");
                         xx = false;
                     }
                     else
                     {
                          $("#password_error").removeClass('enabled').addClass('disabled');
                     }
                     
                     
                     
                                  
                     if (data.result  != undefined && data.result == "success") {
                        xx = true;
                     }   
                  
                    
                 
                   
                }
                
                
                    
         }).responseText;
             
          
          
          return response;
                  
}           
              
</script>





<script>
function checkifcomplete()
{
	var isFormValid = true;

	$("#accoun_settings .required").each(function()
	{
		

		
		if ($.trim($(this).val()).length == 0){
			
			//var id = $(this).attr('id');
				
			$(this).addClass("highlight");
			isFormValid = false;
			$(this).focus();
		}
		else
		{
			$(this).removeClass("highlight");
		}
		 
		 
	});

	if (!isFormValid)
	{ 
		//alert("Please fill in all the required fields ( indicated by *) ");
		
		swal({
			  title: '',
			  text:  "Please fill in all the required fields ",
			  type: 'warning',
		});
	}

	return isFormValid;

} 
</script>
