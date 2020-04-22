<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Verify Email</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->  
  <link rel="stylesheet" href="{{ asset('public/adminlte/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/bootstrap/css/AdminLTE.min.css')}}" >
  <link rel="stylesheet" href="{{ asset('public/adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet"  href="{{ asset('public/adminlte/plugins/iCheck/square/blue.css')}}">
 
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<style>

.congrats-box {
       width: 62%!important;
    margin: 2% auto !important;
}



</style>

<body class="hold-transition login-page">

@if(session()->has('message'))
<div class="congrats-box">
        <div class="login-box-body">
       
                  <div>
                   <h4 style='color:#de8d10'>
                      Your email has been verified. You may now login to your account.
                    </h4>
                   
                               <script>
                     setTimeout(function(){
                        window.location.href = "{{asset('/')}}";
                     }, 5000);
                  </script>
                            <center> </center> <p>Redirecting in 5 seconds.</p> </center>
                    </div>
       </div>
</div>    
 

@else

    
<div class="login-box">
  <!-- /.login-logo -->
  
  
  
<div class="login-box-body">
    <h4>Verify your email</h4>
    

   
    
    
    
     @if(session()->has('error'))
    <div class="alert alert-danger">
       <p> {{ session()->get('error') }}</p>
    </div>
    @endif
    
    

	<p></p>

    @if (session('status'))
		<div class="alert alert-success" role="alert">
			{{ session('status') }}
		</div>
	@endif

	<form method="POST" action="{{ route('check_email_validation') }}">
	@csrf
	
	<br>
      <div class="form-group has-feedback">
		 <label for="email" class="col-form-label text-md-right">Enter your registered email</label>
		 
		 
		 <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" >

			@if ($errors->has('email'))
				<span class="invalid-feedback" role="alert" style='color:red'>
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif
		
			
      </div>
      
      
      <div class="form-group has-feedback">
		 <label for="email" class="col-form-label text-md-right">Enter your verification code</label>
		 
		 
		 <input id="verificationcode" type="text" class="form-control{{ $errors->has('verificationcode') ? ' is-invalid' : '' }}" name="verificationcode" value="{{ old('verificationcode') }}" >

			@if ($errors->has('verificationcode'))
				<span class="invalid-feedback" role="alert" style='color:red'>
					<strong>{{ $errors->first('verificationcode') }}</strong>
				</span>
			@endif
		
		
		
      </div>
	  
	 
      <div class="row">

        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <!-- /.col -->
      </div>
	  
	  
</form>


</div>
<!-- /.login-box-body -->

 @endif   

  
  
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script  src="{{ asset('public/adminlte/plugins/jQuery/jquery-2.2.3.min.js')}}" ></script>
<!-- Bootstrap 3.3.6 -->
<script  src="{{ asset('public/adminlte/bootstrap/js/bootstrap.min.js')}}" ></script>



</script>
</body>
</html>
