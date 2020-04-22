<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Signup</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.6 -->
<!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/dist/css/skins/_all-skins.min.css')}}" >

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
<!-- load jQuery and jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<!-- load jQuery UI CSS theme -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">  
  

<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('public/adminlte/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('public/adminlte/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{ asset('public/adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('public/adminlte/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/adminlte/dist/js/app.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('public/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" ></script>
<!-- DataTables -->
<script src="{{ asset('public/adminlte/plugins/datatables/jquery.dataTables.min.js')}}" ></script>
<script src="{{ asset('public/adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}" ></script>

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('public/adminlte/plugins/datepicker/datepicker3.css')}}">
<!-- bootstrap datepicker -->
<!--<script src="{{ asset('adminlte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>-->


<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{ asset('public/adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<!-- bootstrap time picker -->
<script src="{{ asset('public/adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>



<!-- Waitme -->
<link rel="stylesheet" href="{{ asset('public/waitme/waitMe.css')}}">
<script src="{{ asset('public/waitme/waitMe.min.js')}}" ></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.js"></script>

</head>

<style>
.main-header .navbar {
    -webkit-transition: margin-left .3s ease-in-out;
    -o-transition: margin-left .3s ease-in-out;
    transition: margin-left .3s ease-in-out;
    margin-bottom: 0;
    margin-left: 230px;
    border: none;
    min-height: 100px !important;
    border-radius: 0;
}    
.skin-blue .main-header .navbar {
    background-color: #3c8dbc!important;
}    
.content-wrapper, .right-side {
    min-height: 100%;
    background-color: #fff !important;  
    z-index: 800;
}
</style>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
           <center><h1 style='color:#fff'></h1></center>  
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
        
        
      <!-- Content Header (Page header) -->
      <section class="content-header">
          
      

    
      </section>

      <!-- Main content -->
      <section class="content">
        <center>  
        
        
        <h1>Thank you for your interest in {{ env('APP_NAME') }} </h1><br>
        <p style="font-size:19px">We are currently only accepting new members who have an invite code. If you have an invite code please enter it below. Otherwise please leave your email and we will notify you when new spots are available. </p><br>
        
       
        
            <div class='row'>
                	<div class="col-sm-12">					
                	
                                <div class="input-group" style="width:50%;">
                                  <input type="text"  required style="" name="invite_code" id="invite_code" class="form-control xx" placeholder="enter invite code">
                                  <div class="input-group-btn">
                                   <button type="button" form="check_invite_code" class="btn btn-primary btn1xx" id="submit_code" >Submit</button> 
                                  </div>
                                </div>
                        
                
                	</div>
            </div>	
            
            
             <style>
            
            .xx {
           
                height: 44px !important;
               
            }
            
            .btn1xx {
                 font-size: 22px !important;
            }
        </style>
                
                <!--
                @if(session()->has('message'))
                
                  <div class="callout callout-success" style="width:60%">
                    <h4>Thank you for submmiting your email</h4>
                  </div>
                
                @elseif(session()->has('error'))
                
                 <div class="callout callout-danger" style="width:60%">
                    <h4>You email address is aready saved!</h4>
                  </div>
            
                @endif
    
               <p>Otherwise please enter your email to be notified when a new spots become available.</p>
               <form method="POST" action="{{ route('submit_email_temporary') }}" id='form_register'>
                @csrf
                    <div class="input-group" style="width:60%">
                      <input type="email"  required style="" name="email" id="email" class="form-control" placeholder="email address">
        
                      <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-envelope-o"></i> Send
                        </button>
                      </div>
                    </div>
                  </form>
             -->
        
                <br>
                <br>
                <br>
                
                @if(session()->has('message'))
                
                  <div class="callout callout-success" style="width:60%">
                    <h4>Thank you for submmiting your email</h4>
                  </div>
                
                @elseif(session()->has('error'))
                
                 <div class="callout callout-danger" style="width:60%">
                    <h4>You email address is aready saved!</h4>
                  </div>
            
                @endif
                
             <div id='email_notif'>
                    
                 
    
               <p><b><i>I don't have an invite code, Please notify me when <br> new spots are available</i></b></p>
               <form method="POST" action="{{ route('submit_email_temporary') }}" id='form_register'>
                @csrf
                    <div class="input-group" style="width:90%">
                      <input type="email"  required style="" name="email" id="email" class="form-control" placeholder="email address">
        
                      <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-envelope-o"></i> Send
                        </button>
                      </div>
                    </div>
                  </form>      
                          
             </div>
                        
                <style> 
                    #email_notif {
                      border-radius: 5px;
                      background: #5accd8eb;
                      padding: 2px; 
                      width:40%;
                      padding:20px;
                      border: 2px solid #de4d5d;
                    }
                </style>
                
                <!--
                <div class='row'>
                	<div class="col-sm-12">					
                		<p>If you have an invite code enter it below:</p>
                         
                                <div class="input-group" style="width:30%">
                                  <input type="text"  required style="" name="invite_code" id="invite_code" class="form-control" placeholder="enter invite code">
                                  <div class="input-group-btn">
                                   <button type="button" form="check_invite_code" class="btn btn-primary" id="submit_code" >Submit</button> 
                                  </div>
                                </div>
                        
                
                	</div>
                </div>	
                -->
              
               </center>
       
       
      </section>
      
      
      
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs"></div>
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->
</body>
</html>



<script>
var loading;

$(document).on("click", "#submit_code", function()
{
    
    
    var invite_code =  $("#invite_code").val();
    
  

     // save data template
        $.ajax({
    		url: "{{ asset('verify_invite_code') }}", 
    		type	: "POST",
    		data: {"_token":$('#token').val(),"invite_code":invite_code},
    		dataType: 'json',
    		beforeSend: function() {
    					
    
    			loading = $("body").waitMe({
    				effect: 'timer',
    				text: 'verifying Invite Code ........',
    				bg: 'rgba(255,255,255,0.90)',
    				color: '#555'
    			}); 
    				
    		},
            success: function(data)
            {
    
    	    	loading.waitMe('hide');
              
        
    	    	if(data.result == "exist")
    	    	{
    	    	        
    	    	        swal({
        					  title: 'Invite Code Verified',
        					  text:  "you may continue your registration",
        					  type: 'success',
        					}).then(function (result) {
        					    
        					     window.location.href = "{{asset('signup')}}";
        					
        				       // window.location.href = "{{asset('signup/application/1')}}";
        				       
        				      // window.location.href="{{asset('signup/application/2/02y05V18O')}}";
        				        
        				})
    	    	    
    	    	}
    	    	else
    	    	{
    	    	      swal({
        					  title: 'Invalid Code',
        					  text:  "",
        					  type: 'warning',
        					});
        				return false;
    	    	}
    	    
              
              
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
    			loading.waitMe('hide');
                alert('Error adding / submiting data');
            }
        });
        
    

});




</script>


                      
