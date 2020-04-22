<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
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
 
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <style>
.body{
background-image: url("{{ asset('public/azmproject_images/login.jpg') }}");
background-repeat : no-repeat;
}
</style>
  
</head>
<body class="hold-transition login-page body">
     <div class="login-nav-logo"><a href="https://reviewers.club"><img src="{{ asset('public/reviewersclub-logo.png') }}" ></a></div>
<div class="login-box">
  <div class="login-logo">
   <!-- <a href="../../index2.html"><b>Admin</b>LTE</a> -->
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login Now!</p>

    <form method="POST" action="{{ route('login') }}" >
     @csrf
      <div class="form-group has-feedback">
    
		  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

			@if ($errors->has('email'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif
		
			 <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		
      </div>
      <div class="form-group has-feedback">
      
		  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

			@if ($errors->has('password'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
		
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  
      <div class="row">
           <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-8">
          <div class="checkbox icheck" style="text-align: right;">
        
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

				<label class="form-check-label" for="remember">
					{{ __('Remember Me') }}
				</label>
 
          </div>
        </div>
       
      </div>
    </form>

    <div class="social-auth-links text-center">

      <p>- OR -</p>
      <a href="{{url('/redirect')}}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>

        
    </div>
    <!-- /.social-auth-links -->

    <a href="{{ route('password.request') }}">I forgot my password</a><br>
    <!--<a href="{{ route('register') }}" class="text-center">Register a new account</a>-->
     <a href="{{ route('signup') }}" class="text-center">Register a new account</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script  src="{{ asset('public/adminlte/plugins/jQuery/jquery-2.2.3.min.js')}}" ></script>
<!-- Bootstrap 3.3.6 -->
<script  src="{{ asset('public/adminlte/bootstrap/js/bootstrap.min.js')}}" ></script>
<!-- iCheck -->
<script  src="{{ asset('public/adminlte/plugins/iCheck/icheck.min.js')}}"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>



</body>
</html>

<script>
function test()
{
    const inputvalue = {
		
				  "fname"   : "test 3",
				  "lname"   : "test 3", 
				  "strt"    : "strt",
				  "city"    : "city",
				  "state"   : "AL",
				  "zip"	    : "9002",
				  "amount"	: "100"
				};
	
	$.ajax({
		url: "https://fncc.herokuapp.com/api/runmanualgen",  
		type: 'POST',
		data: inputvalue,
		success: function(data)
		{
			
			alert(data);
			
		
			if(data.length > 0)
			{
				
				console.log(data);
			}
			
			
		},
		error: function(error){ 
			console.log(error);
		}

	});
	
}
</script>