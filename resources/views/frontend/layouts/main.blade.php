<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Dashboard</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">  
	<meta name="_token" content="{{ csrf_token() }}">
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/dist/css/skins/_all-skins.min.css')}}" >
  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('public/adminlte/plugins/datatables/dataTables.bootstrap.css')}}">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.js"></script>
	


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]--> 

<!-- jQuery 2.2.3 -->
<!--<script src="{{ asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>-->
<!-- jQuery UI 1.11.4 -->
<!--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>--->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- load jQuery and jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<!-- load jQuery UI CSS theme -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//js.pusher.com/3.1/pusher.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>  






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


<!--- !!!  wizard step by step  -->
<link rel="stylesheet" href="{{ asset('public/wizardist/css/smart_wizard.css')}}" >
<link rel="stylesheet" href="{{ asset('public/wizardist/css/smart_wizard_theme_arrows.css')}}" >
<link rel="stylesheet" href="{{ asset('public/wizardist/css/smart_wizard_theme_circles.css')}}" >
<script src="{{ asset('public/wizardist/js/jquery.smartWizard.js')}}"></script>

	
<script src="//js.pusher.com/3.1/pusher.min.js"></script>

<link rel="stylesheet" href="{{ asset('public/avatar_crop/croppie.css')}}" >	
<script src="{{ asset('public/avatar_crop/croppie.js')}}"></script>
	

<style>

@font-face{font-family:'Amazon Ember';src:url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_rg-cc7ebaa05a2cd3b02c0929ac0475a44ab30b7efa._V2_.woff2) format("woff2"),url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_rg-8a9db402d8966ae93717c348b9ab0bd08703a7a7._V2_.woff) format("woff")}@font-face{font-family:'Amazon Ember';font-style:italic;src:url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_rgit-9cc1bb64eb270135f1adf3a4881c2ee5e7c37be5._V2_.woff2) format("woff2"),url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_rgit-a4dc98d644ff2aedd41da3da462f09ffce86eafb._V2_.woff) format("woff")}@font-face{font-family:'Amazon Ember';font-weight:700;src:url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_bd-46b91bda68161c14e554a779643ef4957431987b._V2_.woff2) format("woff2"),url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_bd-b605252f87b8b3df5ae206596dac0938fc5888bc._V2_.woff) format("woff")}@font-face{font-family:'Amazon Ember';font-style:italic;font-weight:700;src:url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_bdit-80ff7aba37dd1ff5a6b90233a19e3a780a96dc2f._V2_.woff2) format("woff2"),url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_bdit-57598ce426a612be5a1d15eee08252668fca5e7a._V2_.woff) format("woff")}.a-ember body{font-family:"Amazon Ember",Arial,sans-serif}.a-ember .a-text-quote{font-family:"Amazon Ember",Arial,sans-serif}

body 
{
    background-color: #f8fafc;
}

.content-wrapper, .right-side 
{
    min-height: 100%;
    background-color: #f8fafc !important;
    z-index: 800;
}
</style>


<style>
.title
{
	font-weight:bold;
	font-size:25px;
}

.hidden
{
	display:none;
}
.show
{
	display:block;
}


.navbar-nav>.notifications-menu>.dropdown-menu>li.notif_footer > a
{
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 4px;
    font-size: 12px;
    background-color: #fff;
    padding: 7px 10px;
    border-bottom: 1px solid #eeeeee;
	border-top: 1px solid #eeeeee;
    color: #444 !important;
    text-align: center;
}

ul {
    margin: 0px !important;
}
</style>




<!-- ManyChat -->
<!--<script src="//widget.manychat.com/312301209694335.js" async="async"></script>-->


<!-- ManyChat -->
<script src="//widget.manychat.com/101989987842833.js" async="async"></script>




  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: '995a62bd-cafb-4c5c-b5d1-391a692d3c21', f: true }); done = true; } }; })();</script>



<div class="loader"></div>

<?php 
use \App\Http\Controllers\UserVccController;
?>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">


<div class="wrapper">
		<!--// div header -->
		@include('frontend.layouts.header')  
		<!--  ~end header -->
		  

		<!-- Full Width Column -->
		<div class="content-wrapper" >
			<div class="container">
					<!-- Content MAIN PAGE -->
					@yield('content')
					<!--/.. END  OF MAIN PAGE-->
			</div>
		<!-- /.container -->	
		</div>
		<!-- /.content-wrapper -->
			
		<!--// div footer -->
		@include('frontend.layouts.footer')  
		<!--  ~end footer -->	
</div>
<!-- ./wrapper -->

</body>
</html>
  
  


<script>
$.extend({
    xResponse: function(url, data) {
        // local var
        var theResponse = null;
        // jQuery ajax
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
			dataType: "html",
            async: false,
            success: function(respText) {
                theResponse = respText;
            }
        });
        // Return the response text
        return theResponse;
    }
});
</script>













<script>
// Enable pusher logging - don't include this in production
      // Pusher.logToConsole = true;
     /* 
      var pusher = new Pusher('44f094e6f806a4e2fe69', {
		  cluster: 'ap1',
        encrypted: true
      });
    */
      // Subscribe to the channel we specified in our Laravel Event
    /*var channel = pusher.subscribe('{{Auth::user()->id}}_channel');*/
	  
	/*
	channel.bind('{{Auth::user()->id}}_event', function(data) {
		
		//Notification();
		//GetOfferData();
		//reloadStep2();
	
	});
	*/
</script>	



<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>  
<script>
/*
  window.fbAsyncInit = function() {
		FB.init({
		  appId      : '2230078753719065',
		  xfbml      : true,
		  version    : 'v3.2'
		});
  };
*/  
</script>
<script>
// console.log(sessionStorage.getItem("new"))
// sessionStorage.clear();
    $(document).ready(function(){
        $(document).on('click','a.compare_btn:not(.disabled_this)',function() {
             sessionStorage.setItem("new", "test");
             var check = $('html,body').find('.compare_deals');
            $('html,body').animate({
                scrollTop: $(".compare_deals").offset().top},
                'slow');
        });
    })
</script>

