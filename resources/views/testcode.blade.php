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
    padding-top: 74px;
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
    text-align: center;
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
                        <h2 class="modal-title h3-headline" id="questionsModal">Become A Part Of The Reviewers.Club Community</h2>
                    </div>

                    <div class="modal-desc">
        <!--<p>While membership is on an invitation-only basis, we can also make the process easier just for you – IF you’re the kind of Product Tester we’re looking for. Simply answer the questions below to see if Reviewers.Club will work for you.
</p>-->
<p>While membership is limited, we are currently accepting applications for new reviewers who will help our partner brands in their marketing goals. See if you qualify by taking the test below.</p>
                    </div>

                    <div class="questionnaire">
                        <div class="questionnaire__list">
                            <div class="questionnaire__item" data-number-question="1">
                                <div class="questionnaire__item-head h3-headline">
                                    <!--As a Product Tester, I am-->
                                    As a product reviewer, I...
                                </div>

                                <div class="questionnaire__item-headline">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="questionnaire__questions">
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question1-1" name="question1" value="Just looking for Free Stuff">
                                        <span class="form-check-label">
                                            <!--Just looking to get free stuff.-->
                                            Just want free stuff
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question1-2" name="question1" value="Willing to help brands in their journey to improve their products and marketing strategy">
                                        <span class="form-check-label">
                                           <!--  Willing to help brands in their journey to improve their products and marketing strategy -->
                                           Want to influence brands and help them improve their products
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question1-3" name="question1" value="Not sure, I will look around first">
                                        <span class="form-check-label">
                                           <!-- Not sure, I will look around first -->
                                           Just want to see what all the buzz is about
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="questionnaire__item" data-number-question="2">
                                <div class="questionnaire__item-head h3-headline">
                                   <!--  When products are offered for me to test, I would -->
                                   When I am asked to review products, I would...
                                   
                                </div>

                                <div class="questionnaire__item-headline">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="questionnaire__questions">
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question2-1" name="question2" value="Only pick the products I would usually buy myself">
                                        <span class="form-check-label">
                                            <!-- Only pick the products I would usually buy myself -->
                                            ONLY buy products that I like
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question2-2" name="question2" value="Accept all invitations because I understand that my insights are valuable even if my natural interest for the product is low.">
                                        <span class="form-check-label">
                                           <!--  Accept all invitations because I understand that my insights are valuable even if my natural interest for the product is low. -->
                                           
                                           Accept diverse invitations to discover new products because I understand that my insights are valuable
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question2-2" name="question2" value="Only pick the expensive and popular items so I can resell them somewhere else">
                                        <span class="form-check-label">
                                            <!-- Only pick the expensive and popular items so I can resell them somewhere else -->
                                            ONLY choose expensive and popular items that I can maybe resell
                                        </span>
                                    </label>
                                </div>
                            </div>
                            
                            
                            <!--
                            <div class="questionnaire__item" data-number-question="3">
                                <div class="questionnaire__item-head h3-headline">
                                   On top of a 100% cash back on every purchased product for review, we’ll also be paying you $3 to $6 for filling in a questionnaire about the product.
                                </div>

                                <div class="questionnaire__item-headline">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="questionnaire__questions">
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question3-1" name="question3" value="Is that all? For the entire 7 minutes that it will take to provide my insights?">
                                        <span class="form-check-label">
                                            Is that all I’m getting? My insights are worth more than that
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question3-2" name="question3" value="I'll skip the questionnaire part, just give me free stuff">
                                        <span class="form-check-label">
                                            I'll skip the questionnaire part, just give me free stuff
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question3-3" name="question3" value="Wow, that's awesome! I can make a nice extra income when I get around 20 items to test every month!">
                                        <span class="form-check-label">
                                            Wow, that's awesome! I can make a nice extra income when I get around 20 items to test every month!
                                        </span>
                                    </label>
                                </div>
                            </div>
                            -->
                            

                            <div class="questionnaire__item" data-number-question="3">
                                <div class="questionnaire__item-head h3-headline">
                                   <!--  When I tested a product that I'm not very positive about -->
                                   When I review a product that I dont like
                                </div>

                                <div class="questionnaire__item-headline">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="questionnaire__questions">
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question4-1" name="question4" value="I share my negative feelings with everybody I know.">
                                        <span class="form-check-label">
                                           <!--  I share my negative feelings with everybody I know.  -->
                                            I will share my negative experience with everyone
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question4-2" name="question4" value="I just fill in the questionnaire and express my honest feelings to the brands directly, and will give them advice on how to modify and optimize their product.">
                                        <span class="form-check-label">
                                           <!-- I just fill in the questionnaire and express my honest feelings to the brands directly, and will give them advice on how to modify and optimize their product.-->
                                           I will provide honest and constructive feedback using the questionnaire to the brand on how they can improve their product
                                           
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question4-3" name="question4" value="I will do everything I can to blackmail the brand, and leave a negative review on their store.">
                                        <span class="form-check-label">
                                            <!-- I will do everything I can to blackmail the brand, and leave a negative review on their store. -->
                                             Leave negative reviews about them online
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="questionnaire__item" data-number-question="4">
                                <div class="questionnaire__item-head h3-headline">
                               <!--  Although I do not test products professionally, I understand my opinions as an experienced shopper are valuable. So when it comes to product reviews, I give honest feedback and speak my mind…-->
                               As a shopper, I understand that my opinions are valuable. When reviewing products, I give my honest feedback and speak my mind...
                                </div>

                                <div class="questionnaire__item-headline">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="questionnaire__questions">
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question5-1" name="question5" value="Often">
                                        <span class="form-check-label">
                                            Often
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question5-2" name="question5" value="Sometimes">
                                        <span class="form-check-label">
                                            Never
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question5-3" name="question5" value="Seldom">
                                        <span class="form-check-label">
                                            Seldom
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="questionnaire__item" data-number-question="5">
                                <div class="questionnaire__item-head h3-headline">
                                    Membership to this program is by invitation only. When you’ve become a contributing member, we might allow you to invite up to 5 of your friends.

                                </div>

                                <div class="questionnaire__item-headline">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="questionnaire__questions">
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question6-1" name="question6" value="No way, I'm not willing to invite anyone.">
                                        <span class="form-check-label">
                                            <!-- No way, I'm not willing to invite anyone. -->
                                            I will never be willing to share this with anyone
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question6-1" name="question6" value="Wow, that's awesome. I'm willing to participate, knowing that I will be paid for this as well!">
                                        <span class="form-check-label">
                                            <!-- Wow, that's awesome. I'm willing to participate, knowing that I will be paid for this as well!-->
                                            Wow, that is awesome! I would love to participate and may be willing to share this with other eligible friends.
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question6-2" name="question6" value="Let me try it out myself first, I'm still skeptical.">
                                        <span class="form-check-label">
                                          <!--  Let me try it out myself first, I'm still skeptical. -->
                                          I am just in it for the free stuff. 
                                        </span>
                                    </label>
                                </div>
                            </div>
                            
                            
                            <!---
                            <div class="questionnaire__item" data-number-question="7">
                                <div class="questionnaire__item-head h3-headline">
                                    In order to enroll in Reviewers.Club, I think it is acceptable when:
                                </div>

                                <div class="questionnaire__item-headline">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="questionnaire__questions">
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question7-1" name="question7" value="I have to pay 9.99 per month for my membership fee.">
                                        <span class="form-check-label">
                                            I have to pay 9.99 per month for my membership fee.
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question7-2" name="question7" value="The program is free. I trade my valuable time and insights in exchange for free products and bonus payments.">
                                        <span class="form-check-label">
                                            The program is free. I trade my valuable time and insights in exchange for free products and bonus payments.
                                        </span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question7-3" name="question7" value="PPOC pays me a monthly salary.">
                                        <span class="form-check-label">
                                            Reviewers.Club pays me a monthly salary.
                                        </span>
                                    </label>
                                </div>
                            </div>
                            --->

                            <div class="questionnaire__item" data-number-question="6">
                                <div class="questionnaire__item-head h3-headline">
                                    <!--I understand that, as a mystery shopper, I might have to pay for the products upfront with my own funds, after which I will receive a 100% cashback.-->
                                    As a product reviewer/ mystery shopper, you might have to pay for the products upfront with your own funds, after which you will receive cashback.

                                </div>

                                <div class="questionnaire__item-headline">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="questionnaire__questions">
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question8-1" name="question8" value="No problem, I have around 50 bucks of spending limit on my credit card. I understand that there is still no risk involved, thanks to refund policies nearly every shop has.">
                                        <span class="form-check-label">
                                           <!-- No problem, I have around 50 bucks of spending limit on my credit card. I understand that there is still no risk involved, thanks to refund policies nearly every shop has. -->
                                           No problem. I have around $50 spending limit on my credit card. I understand that there is no risk involved thanks to refund policies nearly every shop has.
                                        </span>
                                    </label>

                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question8-2" name="question8" value="I'm sorry, I don't have the cash available and I cannot afford to pay for any of the products myself.">
                                        <span class="form-check-label">
                                            <!-- I'm sorry, I don't have the cash available and I cannot afford to pay for any of the products myself. -->
                                            I'm sorry, I don't have the cash available and I cannot afford to pay for any products myself
                                        </span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="radio" id="question8-3" name="question8" value="No, I don’t understand and I would never do this!">
                                        <span class="form-check-label">
                                           <!--  No, I don’t understand and I would never do this! --> 
                                           No, I don't understand and I would never do this.
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
(function(){
"use strict";
var buttonsCallModal=document.querySelectorAll(".call-questionnaire");
var buttonCloseModal=document.querySelector(".modal-questionnaire .close");
var modalWrap=document.querySelector(".modal-questionnaire-wrap");
var modalWithContent=document.querySelector(".modal-questionnaire");
var questionnaireList=document.querySelector(".questionnaire__list");
var questionList=document.querySelectorAll(".questionnaire__item");
var numberQuestions=document.querySelectorAll(".questionnaire__item").length;
var generalCorrectAnswers=["Willing to help brands in their journey to improve their products and marketing strategy","Accept all invitations because I understand that my insights are valuable even if my natural interest for the product is low.","No problem, I have around 50 bucks of spending limit on my credit card. I understand that there is still no risk involved, thanks to refund policies nearly every shop has."];
var userAnswers=[];
var closeModal = function closeModal(){modalWithContent.classList.remove("active");
setTimeout(function(){
    modalWrap.classList.remove("active")},300)};
buttonsCallModal.forEach(function(el){el.onclick=function(){modalWrap.classList.add("active");
setTimeout(function(){modalWithContent.classList.add("active")},50)}});
buttonCloseModal.addEventListener("click",function(e){closeModal()});
modalWrap.addEventListener("click",function(e){if(e.target.classList.contains("modal-questionnaire-wrap")){closeModal}});

var checkAnswers = function checkAnswers() {
var countCorrectAnswers=[];


generalCorrectAnswers.forEach(function(generalAnswer){
       
       userAnswers.findIndex(function(userAnswer){
           
       var isCoincidence = generalAnswer.indexOf(userAnswer)!==-1;
       if(isCoincidence)
       {
         countCorrectAnswers.push(!0);
         return userAnswer
       }
       else
       {
           return!1
           
       }
       
   })
       
});
 
var isQuestionnairePassed = countCorrectAnswers.length === generalCorrectAnswers.length?!0:!1;

return isQuestionnairePassed
    
};

var goToNextQuestion = function goToNextQuestion(currentQuestion)
{
    currentQuestion.style.display="none";
    currentQuestion.nextElementSibling.style.display="block"

};

var changeProgressBar=function changeProgressBar(currentQuestion){
    
        setTimeout(function() {
            
            questionList.forEach(function(item) {
            var numberQuestion = currentQuestion.nextElementSibling.getAttribute("data-number-question");
            var progressBar = item.querySelector(".progress-bar");
            progressBar.setAttribute("aria-valuenow",(100/numberQuestions)*numberQuestion);
            progressBar.setAttribute("style","width: ".concat((100/numberQuestions)*numberQuestion+"%"))
            
            })
            
        },100)
    
};
    
    questionnaireList.addEventListener("click",function(e) {
    var target=e.target;
    var checkedAnswer="";
    
            if(target.className==="form-check"||target.parentElement.className==="form-check"){
            
            
                    if(target.tagName==="INPUT"){
                        checkedAnswer=target.value;
                        userAnswers.push(checkedAnswer);
                        var currentQuestionElement=target.closest(".questionnaire__item");
                        
                        if(currentQuestionElement.nextElementSibling){
                            
                            goToNextQuestion(currentQuestionElement);
                            changeProgressBar(currentQuestionElement)
                            
                        }
                        else
                        {
                                var isPassedQuestionnaire=checkAnswers();
                                closeModal();
                                document.querySelectorAll("input.form-check-input:checked").forEach(function(item){item.checked=!1});
                                    if(isPassedQuestionnaire){
                                            window.VWO=window.VWO||[];window.VWO.push(['activate',{virtualPageUrl:'/start-funnel-completed'}]);
                
                                //window.location.href="https://portal.Reviewers.Club.com/signup/code="+window.code }
                                window.location.href="{{asset('/signup')}}"+"/code="+window.code }
                                
                                else{ 
                                //window.location.href="https://portal.Reviewers.Club.com/failedregistration?code="+window.code 
                                window.location.href="{{asset('/failedregistration')}}"+"?code="+window.code 
                                }
                
                        }
                        
                        
                    }
            
            }
        
        
    })
    
    
}());

</script>



