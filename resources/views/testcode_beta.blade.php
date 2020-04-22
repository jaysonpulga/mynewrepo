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

  <link rel="stylesheet" href="{{ asset('public/app.css')}}">
  


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
  
  
<style>



body {
    background-color: #ecf6f8;
}

.row {
    margin-left: 0;
    margin-right: 0;
}

p, li {
    font-size: 17px;
    font-family: 'proxima-nova', sans-serif;
    font-weight: 300;
}

b {
    font-family: 'proxima-nova-bold', sans-serif;
}

h3 {
    font-size: 31px;
    line-height: 28px;
    font-weight: bold;
    margin-top: 15px;
    font-family: "proxima-nova-bold", sans-serif;
}

/* HEADER */

#header {
    background-color: #3199ed;
    color: #ffffff;
}

.header-content {
    padding: 30px 0 35px;
}

.header-logo h1 {
    font-family: 'avantgarde-demi', sans-serif;
    font-weight: 700;
    margin-bottom: -5px;
    font-size: 3.0rem;
}

.header-logo span {
    font-family: 'proxima-nova-thin', sans-serif;
    font-size: 32px;
    color: #ffffff !important;
}

.header-logo p {
    font-family: 'proxima-nova', sans-serif !important;
    font-size: 13px;
    margin-bottom: 0;
    color: #ffffffa3 !important;
}

#header h3 {
    margin: 0;
    color: #ffffff;
}

#header span, #header .top-bar .top-bar-title .title-heighlight {
    color: #f29d12;
}

#header .btn-success {
    background-color: #83ba28;
    border: none;
    border-radius: 0;
    box-shadow: 1px 1px 4px 0px #00000030;
    font-family: "proxima-nova-bold", sans-serif;
    font-weight: bold;
    font-size: 20px;
    padding: 10px 30px;
}

#header .btn-success:hover {
    background-color: #2f6eb5;
}

#header .top-bar {
    background-color: #2f6eb5;
    padding: 15px 0;
}

#header .top-bar span {
    font-size: 20px;
    font-family: "proxima-nova-semi", sans-serif;
    font-weight: 500;
    color: #ffffffa8;
}

#header.small-header .top-bar span {
    font-size: 15px;
    line-height: 1.15;
}

#header.small-header .top-bar .top-bar-description span {
    font-size: 12px;
}

.small-header .header-content {
    padding-top: 10px;
    padding-bottom: 10px;
}


/* MAIN CONTENT */

.container.main-content {
    background-color: #ffffff;
}

.row-video iframe {
    width: 100%;
    height: 100%;
}

.row-video .video-wrap {
    height: 500px;
    padding: 35px 0;
}

.row.call-to-action {
    margin-left: -15px;
    margin-right: -15px;
    background: url('../img/Content/eersteCTA.jpg');
    color: #ffffff;
    line-height: 22px;
    padding: 25px 0 25px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    background-color: transparent !important;
}

.row.call-to-action p {
    font-size: 19px;
}


.row.call-to-action h3 {
    margin-bottom: 5px;
}

.row.call-to-action .btn-warning {
    box-shadow: 1px 1px 4px 0px #00000030;
    color: #ffffff;
    border: none;
    background-color: #f5a616;
    font-size: 32px;
    font-weight: bold;
    line-height: 33px;
    padding: 8px 45px 2px 45px;
}

.row.call-to-action .btn-warning:hover {
    background-color: #f59f16;
}

.row.call-to-action span, .row.call-to-action-green span {
    font-weight: bold;
    font-family: "proxima-nova-bold", sans-serif;
    font-size: 34px;
}

.row.call-to-action sup, .row.call-to-action-green sup {
    font-size: 19px;
    font-weight: 400;
    font-family: 'proxima-nova', sans-serif;
}

.row.row-icons {
    padding: 60px 0;
}

.row.row-icons img {
    max-height: 200px;
}

.row-icons h3 {
    color: #2f6eb5;
    margin-bottom: 30px;
}

.call-to-action-green .btn-block {
    background-color: #82bb28;
    border: none;
    line-height: 33px;
    padding: 17px 10px 5px 10px;
}

.call-to-action-green .btn-block:hover {
    background-color: #82c528;
}

.row-invitation {
    padding: 50px 0;
}

.row-invitation h3 {
    color: #2f6eb5;
    margin-bottom: 25px;
}

.row-invitation ul {
    background-color: #a6d9e7;
    padding: 10px 40px 10px 30px;
    list-style-type: none;
}

.row-invitation ul li {
    position: relative;
}

.row-invitation ul li:before {
    content: '';
    position: absolute;
    background-color: #ffffff;
    width: 7px;
    height: 7px;
    display: inline-block;
    left: -12px;
    top: 7px;
    margin: auto;
}

.row-invitation .video-wrap {
    height: 300px;
    margin-bottom: 10px;
}

.row-invitation iframe {
    width: 100%;
    height: 100%;
}

.custom-list-box {
    display: flex;
    margin-bottom: 12px;
}

.custom-list-box img {
    margin-right: 13px;
    margin-top: 0px;
}

.custom-list-box b {
    font-size: 19px;
    color: #f29d12;
}

.call-to-action-background {
    padding-bottom: 0 !important;
    height: 240px;
    position: relative;
    margin-top: 40px;
}

.absolute-image-first {
    max-height: 300px;
    position: absolute;
    left: 0;
    bottom: -17px;
}

.absolute-image-second {
    position: absolute;
    right: 30px;
    bottom: 15px;
    max-height: 255px;
}

.call-to-action .call-to-action-content {
    position: absolute;
    text-align: center;
    z-index: 1;
    width: 100%;
    text-shadow: 0 0 15px rgba(0,0,0,.5);
    right: 0px;
    left: 0px;
    padding: 15px 0;
}

.button-absolute {
    position: absolute;
    margin: auto;
    left: 0;
    right: 0;
    width: 260px;
    bottom: 41px;
}

.row-testimonials {
    padding-top: 50px;
    padding-bottom: 40px;
}

.row-testimonials p {
    color: #2f6eb5;
    font-size: 43px;
    line-height: 52px;
    font-weight: 900;
    font-family: 'proxima-nova-extra', sans-serif;
}

.row-testimonials img {
    max-width: 49%;
}

.row-testimonials .d-flex {
    flex-wrap: wrap;
}

.row-videos {
    padding-bottom: 90px;
}

.row-videos .col-md-4 {
    height: 180px;
}

.row-videos iframe {
    width: 100%;
    height: 100%;
}

footer {
    background-color: #ecf6f8;
    padding: 35px 0;
    color: #00000096;
}

/* MODAL */

.modal-questionnaire-wrap {
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    overflow-y: auto;
    overflow-x: hidden;
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 100;
    padding: 20px;
}

.modal-questionnaire-wrap.active {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}

.modal-questionnaire {
    position: relative;
    width: 100%;
    max-width: 960px;
    margin: auto;
    z-index: 101;
    -webkit-transform: translateY(-999px);
    -ms-transform: translateY(-999px);
    transform: translateY(-999px);
    -webkit-transition: -webkit-transform 0.3s ease-out;
    transition: -webkit-transform 0.3s ease-out;
    -o-transition: transform 0.3s ease-out;
    transition: transform 0.3s ease-out;
    transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
}

.modal-questionnaire-wrap .modal-questionnaire.active {
    -webkit-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
    -webkit-transition: -webkit-transform 0.2s ease-in;
    transition: -webkit-transform 0.2s ease-in;
    -o-transition: transform 0.2s ease-in;
    transition: transform 0.2s ease-in;
    transition: transform 0.2s ease-in, -webkit-transform 0.2s ease-in;
}

.modal-questionnaire__bg {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin: auto;
}

.modal-questionnaire .close {
    position: absolute;
    right: -20px;
    top: -20px;
    width: 39px;
    height: 37px;
    opacity: 1;
    background: url("../img/icons/closemodal.png") center center no-repeat;
    z-index: 101;
    outline: none;
}

.modal-questionnaire .close:hover {
    opacity: 1 !important;
}

.modal-questionnaire .document {
    border-radius: 10px;
    overflow: hidden;
}

.modal-questionnaire .modal-content {
    padding: 40px 55px;
    padding-top: 10px !important;
    padding-bottom: 75px;
    border: 0;
}

.modal-questionnaire .modal-header {
    border: none;
    padding-bottom: 15px;
}

.modal-questionnaire .modal-title {
    width: 100%;
    text-align: center;
}

.modal-questionnaire .modal-footer {
    border-top: 1px solid #2f2f2f;
}

.modal-questionnaire .modal-desc {
    padding-bottom: 24px;
    border-bottom: 1px solid #000;
}

.modal-questionnaire p {
    font-size: 16px;
    text-align: normal;
    font-weight: normal;
}

.questionnaire {
    font-size: 20px;
}

.questionnaire__item:not(:first-child) {
    display: none;
}

.questionnaire__item-head {
    text-align: left;
    font-size: 26px;
    padding-top: 42px;
    padding-bottom: 17px;
}

.questionnaire__questions {
    padding-left: 10px;
    padding-top: 15px;
}

.questionnaire__item-headline {
    border-radius: 10px;
    /*overflow: hidden;*/
}

.questionnaire__item-headline .progress {
    height: 10px;
    background-color: #DDD;
}

.questionnaire__item-headline .progress-bar {
    background-color: #0e8dc7;
    border-radius: 10px;
}

.questionnaire__questions .form-check {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 9px 10px;
    cursor: pointer;
}

.questionnaire__questions .form-check:hover {
    color: #FFF;
    background-color: #0e8dc7;
    -webkit-transform: scale(1.03);
    -ms-transform: scale(1.03);
    transform: scale(1.03);
    -webkit-box-shadow: 0 2px 6px rgba(0, 0, 0, 0.14), inset 0 0 0 2px rgba(255, 255, 255, 0.16);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.14), inset 0 0 0 2px rgba(255, 255, 255, 0.16);
    border-radius: 4px;
}

.questionnaire__questions .form-check:hover *:hover {
    cursor: pointer;
}

.questionnaire__questions .form-check input {
    position: static;
    margin: 0;
    margin-right: 15px;
}

@media only screen and (max-width: 768px) {

    #header .col-xs-12 {
        text-align: center;
    }

    #header .col-xs-12:not(:last-child) {
        margin-bottom: 15px;
    }

    .row-video .video-wrap {
        height: auto;
        width: auto;
        margin: auto;
        padding: 10px 0;
    }

    .row.call-to-action .btn-warning {
        width: 262px;
        margin: auto;
    }

    .row.call-to-action {
        text-align: center;
    }

    .row.row-icons {
        padding: 10px 0;
    }

    .row-invitation {
        padding: 10px 0;
    }

    .absolute-image-first {
        max-height: 160px;
    }

    .absolute-image-second {
        max-height: 125px;
    }

    .call-to-action-background {
        margin-top: 0;
    }

    .row-testimonials {
        padding-top: 20px;
    }

    .row-videos .col-md-4 {
        margin-bottom: 15px;
    }

    .row-videos {
        padding-bottom: 40px;
    }

}

@media only screen and (max-width: 460px) {

    .row {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    h3 {
        font-size: 25px;
        line-height: 24px !important;
    }

    p, li {
        font-size: 16px;
        line-height: 19px;
    }

    .top-bar .col-lg-12 {
        line-height: 19px;
    }

    .top-bar span {
        font-size: 17px;
    }

    .row.call-to-action p {
        font-size: 14px;
        line-height: 15px;
    }

    .row-testimonials p {
        font-size: 33px;
        line-height: 33px;
        text-align: center;
    }

    .main-content {
        padding-left: 0;
        padding-right: 0;
    }

    .row.call-to-action .btn-warning {
        line-height: 21px;
        padding: 10px 0px 14px;
        width: 180px;
    }

    .row.call-to-action span, .row.call-to-action-green span {
        font-size: 24px;
    }

    .row.call-to-action sup, .row.call-to-action-green sup {
        font-size: 14px;
    }

    .row-icons h3 {
        margin-bottom: 10px;
    }

    .call-to-action-green .btn-block {
        max-width: 190px;
        margin: auto;
        padding: 10px 0px 6px;
        line-height: 23px;
    }

    .row-video .video-wrap {
        width: 100%;
        padding: 0 15px;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .row-invitation h3 {
        margin-bottom: 15px;
    }

    .row.call-to-action {
        height: auto;
        padding: 10px 0 30px !important;
    }

    .call-to-action-background {
        height: 290px !important;
    }

    .row-invitation .video-wrap {
        height: 190px;
    }

    .call-to-action-background .btn-warning {
        margin-top: 15px;
    }

    .absolute-image-first {
        bottom: -37px;
        left: 0px;
    }

    .absolute-image-second {
        right: 5px;
        bottom: -22px;
    }

    .row.call-to-action-green {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .row-testimonials img {
        max-width: 100%;
        margin-bottom: 10px;
    }

    /* MODAL */
    .modal-questionnaire-wrap {
        padding: 15px;
        max-width: 100vw;
    }

    .modal-questionnaire .modal-content {
        padding: 0px 10px 20px;
    }

    .modal-questionnaire .modal-desc {
        padding-bottom: 10px;
    }

    .questionnaire__item-head {
        font-size: 20px;
        padding-top: 12px;
        line-height: 24px;
    }

    .questionnaire__questions {
        padding-left: 0px;
    }

    .form-check {
        margin-bottom: 0;
    }

    .form-check-label {
        font-size: 16px;
        line-height: 21px;
    }

}
</style>

  
    <style>
.body_register{
background-image: url("{{ asset('public/azmproject_images/signup.jpg') }}");
background-size:100%;
}

.checkbox {
    position: relative;
    display: block;
    margin-top: 20px;
    margin-bottom: 20px;
}
</style>
  
 </head>
<body class="hold-transition register-page body_register">




<div class="modal-questionnaire-wrap active">
    <div class="modal-questionnaire__bg">
        <div class="modal-questionnaire active" id="questionsModal" tabindex="-1" role="dialog" aria-labelledby="questionsModal" aria-hidden="true">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
            <div class="document" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title h3-headline" id="questionsModal"></h2>
                    </div>

                    <div class="modal-desc">
                        <p style="text-align:center !important;">
                            Thank you for your interest in <strong>Reviewers.club</strong> is an exclusive invitation only community 
                            for passionate product reviewers and shoppers to help brands improve their product and their marketing. 
                        </p>
                    </div>
                
              
                <form id='accept_data'  name='accept_data' >
                 @csrf  
                    
                    <div class="row" >
                        <div class="col-sm-12">
                            
                            
                        
                            <div class="checkbox" id="acceptform">
                                
                                <h4>Please read and accept the following to register:</h4>
                          
                                
                                <div class="checkbox">
                                     <input type="checkbox"  required id="question1" name="question1" class="no-ml" value="1"> 
                                     <label for="question1" class="control-label mll pls">I Accept diverse invitations to discover new products because I understand that my insights are valuable</label> <!---->
                                </div> 
                                <div class="checkbox">
                                    <input type="checkbox" required id="question2" name="question2" value="1" class="no-ml" required> 
                                    <label for="question2" class="control-label mll pls">I will provide honest and constructive feedback using the questionnaire to the brand on how they can improve their product</label> <!---->
                                </div> 
                                <div class="checkbox">
                                    <input type="checkbox"  required id="question3" value="1" name="question3" class="no-ml" required> 
                                    <label for="question3" class="control-label mll pls">I would love to participate and may be willing to share this with other eligible friends.</label> <!---->
                                </div> 
                                <div class="checkbox">
                                    <input type="checkbox" required id="question4" value="1" name="question4" class="no-ml" required> 
                                    <label for="question4" class="control-label mll pls">I have around $50 spending limit on my credit card. I understand that there is no risk involved thanks to refund policies nearly every shop has.</label> <!---->
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" required  id="question5" value="1" name="question5" class="no-ml" required> 
                                    <label for="question5" class="control-label mll pls"> As a shopper, I understand that my opinions are valuable. When reviewing products, I will give my honest feedback.</label> <!---->
                                </div>
                            </div>
                        
                        
                    </div>
                  </div>
                  
                  <br>
                 
                  
                  <div class="row" >
                        <div class="col-sm-12">
            
                                   <div style='text-align:center'>
                                       <button type="submit" class="btn btn-success" id='accept' >Accept</button>
                                       <button type="button" class="btn btn-danger" id='deny'  >Deny</button>
                                  </div> 
                                
                            
                        </div>
                   </div>  
                   
                   </form>
                  
                  
                  
                
                
                
            </div>
        </div>
    </div>
</div><!-- end modal -->




</body>
</html>









<script language="JavaScript">
    window.code = 'REF_35DHC4XQ';
</script>

<script>

$("#accept_data").on("submit", accept_data);     

function accept_data(event)
{
     event.preventDefault();
     window.location.href="{{asset('signup/application/2/02y05V18O')}}";
}


$("#deny" ).click(function() {
    
    //window.location.href="{{asset('/failedregistration')}}"+"?code="+window.code 
    
      swal({
				  title: 'Thank You',
				  text:  "",
				  type: 'success',
				}).then(function (result) {
				  
			       window.location.href = "https://reviewers.club";
			        
			})

});
    
</script>
