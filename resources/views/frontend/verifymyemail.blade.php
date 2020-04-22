@extends('frontend.layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('public/app.css')}}"> 

<!-- ManyChat -->
<script src="//widget.manychat.com/101989987842833.js" async="async"></script>



<style>

.content-wrapper, .right-side {
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

.jumbotron {
     padding-top: 0px;
    padding-bottom: 0px;
    margin-bottom: 30px;
    color: inherit;
    background-color: #eee;
}

.jumbotronText 
{
    color: #73879C;
    font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.471;
}

.jumbotronText p
{
     color: #000;
}

.jumbotron h1 {
    font-size: 50px !important;
}
</style>

<br>


<section class="first_content">          

         <div class='row'>
            <div class="companyinfo_sub text-center font-hind-siliguri">
                <h1 class="mtl">
                   Welcome to {{ env('APP_NAME') }}!
                </h1>
                <p class="font-20">
                    We only need some extra information to give you access to {{ env('APP_NAME') }}.
                </p>
            </div>
        </div>
        
    <ol class="ol-circle">    
      <div class='row'>
        <div class="col-md-12 col-sm-12 col-xs-12">
           
            <div class="bb-dimmed pbxl">

                <div class="row">
                    <div class="col-md-12">
                         <h2>Hello, {{Auth::user()->name}}!</h2>
                       
                        <br>
                        <li class="mbm">
                            <p class="mbxl" style='font-size:15px'>
                                 Before proceeding, please check your email for a verification code and verify your email, Add our email address to your whitelist,<br> If you did not receive the email. <a href='javascript:void(0);' id='requestnew_emailverification'>click here to  request another</a>
                            </p>
                        </li>
                        @if(empty(@$whitelist[0])) 
                        <div class="form-group">

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="email_whitelist" value="1">
                                    I've added <u> {{ env('MAIL_USERNAME') }} </u> to my email address whitelist.
                                </label>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <small>
                            It's very important that you do receive all of our emails. Sometimes your email
                            provider might mistakenly catch good emails and send them to your SPAM folder. That will
                            lead to missing out on invitations. The solution is to add our email address to your
                            email provider whitelist.
                        </small>
                    </div>
                </div>
                 @endif
                <div class="form-group">
                    <a data-toggle="modal" class="cursor-pointer pull-right" data-target="#modal-help-whitelist-email">
                        How do I do this?
                    </a>
                </div>

            </div>
           

        </div>
        </div>
       
      
        
        <div class='row'>
        <div class="col-md-12 col-sm-12 col-xs-12">
            @if(empty(@$messenger[0]))
            <div class="bb-dimmed pbxl mbxl">
                <br>
                <div class="form-group">
                     <li class="mbm">
                        <h4 class="mbxl">
                           Accept {{ env('APP_NAME') }} on Facebook Messenger 
                        </h4>
                    </li>
                </div>
                
                <div class="row">
                    
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    
                        <p id="mc-dfa15dbd-b463-b149-92b7-ef70750b5d03" class="fb-send-to-messenger mc-send-to-messenger fb_iframe_widget" messenger_app_id="532160876956612" page_id="101989987842833" data-ref="optin_7343061_c28fac1d-8fec-9fca-b3e7-4e0e744b53aa_3d914d63-738c-1ab4-26e2-23f0b572873a" color="blue" size="large" cta_text="SEND_TO_MESSENGER" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=532160876956612&amp;color=blue&amp;container_width=155&amp;cta_text=SEND_TO_MESSENGER&amp;locale=en_US&amp;messenger_app_id=532160876956612&amp;page_id=101989987842833&amp;ref=optin_7343061_c28fac1d-8fec-9fca-b3e7-4e0e744b53aa_3d914d63-738c-1ab4-26e2-23f0b572873a&amp;sdk=joey&amp;size=large"><span style="vertical-align: bottom; width: 256px; height: 52px;"><iframe name="f10fdca51e49ae8" width="1000px" height="1000px" title="fb:send_to_messenger Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v3.1/plugins/send_to_messenger.php?app_id=532160876956612&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D44%23cb%3Df2f4f52ca9ab65%26domain%3Dreviewers.club%26origin%3Dhttps%253A%252F%252Freviewers.club%252Ff31fdb446222c68%26relation%3Dparent.parent&amp;color=blue&amp;container_width=155&amp;cta_text=SEND_TO_MESSENGER&amp;locale=en_US&amp;messenger_app_id=532160876956612&amp;page_id=101989987842833&amp;ref=optin_7343061_c28fac1d-8fec-9fca-b3e7-4e0e744b53aa_3d914d63-738c-1ab4-26e2-23f0b572873a&amp;sdk=joey&amp;size=large" style="border: none; visibility: visible; width: 256px; height: 52px;" class=""></iframe></span></p>
                        
                     
                     
                
                    </div>
                    
                    
                    <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                        <a data-toggle="modal" class="cursor-pointer" data-target="#modal-help-messenger">
                            I don't have Facebook Messenger
                        </a>
                    </div>
                </div>
                
                
                <div class="mtl">
                    <small>
                        To be part of the platform its required to accept us on Facebook. Simply click on the
                        Send to Messenger button and the system will detect if the sign up is successful!
                    </small>
                    <br>
                    <br>
                    
                    
                    <div>
                       <label>Paste your verification code to receive personal message through messenger </label> 
                        <input class="form-control" style="width:50%" id="paypal" name="messenger" type="text" placeholder="Verification Code">
                    </div>
                    
                </div>
            </div>
            @endif
            
            
          
            
            
        </div>
        </div>
        
        
        
        <div class='row'>
        <div class="col-md-12 col-sm-12 col-xs-12">
            @if(empty(@$paypal[0]))
            <div class="bb-dimmed pbxl mbxl">
                
             <li class="mbm">    
                <h4 class="mbxl">
                    How do you want to receive your cashback? 
                </h4>
            </li>
        
                <div class="row">
                    <div class="col-md-2">
                        <a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" class="loading" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;">
                            <img class="mbm" src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_74x46.jpg" alt="PayPal Logo">
                        </a>
                    </div>
                    <div class="col-md-10">
                        1. Your PayPal address
                        <div class="mbm mts">
                            <small>
                                We need your paypal email address to send you cashback or payout of the points you have
                                earned.
                            </small>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="paypal" name="paypal" type="text" placeholder="Your PayPal Address">
                        </div>
                        <a target="_blank" href="https://www.paypal.com/webapps/mpp/account-selection" class="loading">
                            I dont have PayPal - Sign up here.
                        </a>
                    </div>
                    <div class="col-md-12">
                        <div class="mtl">
                            <small>
                                FAQ:
                                    <br>
                                    <span>
                                       * How to get funds from Paypal to your bank account? - Its very simple. Check
                                        here:
                                        <a data-toggle="modal" data-target="#modal-help-paypal">
                                            how to transfer money from Paypal to bank account.
                                        </a>
                                   </span>
                                   <br>
                                   <span>
                                      * Why do we need Paypal? Because it is the cheapest way to get money back to you.
                                        The system takes care of all your transaction fees. Money earned is actual money
                                        paid.
                                    </span>
                                
                            </small>
                        </div>
                    </div>
                </div>

            </div>
            @endif
        </div>
        </div>
        

        
        @if(empty(@$paypal[0]) || empty(@$messenger[0]) || empty(@$whitelist[0]))
        <div class='row'>
            <div class="col-md-12 col-sm-6 col-xs-6">
                <div class="pull-right"> 
                    <button class="btn btn-primary btn-lg submit_verification">Submit</button>
                </div>
                
            </div>    
        </div>
        @endif
        
         </ol>    
        
        <script>
            $(document).on('click','.submit_verification',function(){
                var messenger = $('input[name="messenger"]').val();
                var paypal = $('input[name="paypal"]').val();
                var whitelist = $('input[name="email_whitelist"]:checked').val();
                
                    $.ajax({
                        url:"{{asset('verify_account')}}",
                        post:"POST",
                        headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')},
                        data:{messenger:messenger,paypal:paypal,whitelist:whitelist},
                        beforeSend: function() {
                			loading = $("body").waitMe({
                				effect: 'timer',
                				text: 'Verifying .........',
                				bg: 'rgba(255,255,255,0.90)',
                				color: '#555'
                			}); 
                					
                		},
                        success:function(data){
                            loading.waitMe('hide');
                            var json = JSON.parse(data);
                            if(json.success == true){
                                swal({
                                    type:'success',
                                    title:'',
                                    text:json.message
                                }).then(function(){
                                    location.reload();
                                })
                            }else{
                                swal({
                                    type:'error',
                                    title:'',
                                    text:json.message
                                }).then(function(){
                                    location.reload();
                                })
                            }
                        }
                    })
            })
        </script>
        

        
</section>          	   

<br>
<br>
          
          
         
		<div class='row'>
            	<div class="col-lg-12"> 
		             <h3 class="box-title" style="text-align: center;  font-weight: bold;">
		                Receive free products and cash bonuses by helping brands improve their products and business
		               </h3>
		        </div>
		  </div>
		  
		  
		    
        
        
        <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header span6" data-step="1" data-intro="Let me see whats new!" data-position="right">

                    <h3>About Reviewers.Club</h3>
                </div>
                <div class="box-body">
                    <p style='font-size:17px'>

                       Brands want to know what customers think of their product, or how it may compare to other products in the market, and they can acquire this information through Reviewers Club. When sharing your experiences as a Product Tester, don’t be afraid to speak your mind – these brands know that your honest opinions are a worthwhile investment that will help them improve their products, business and marketing. 


                    </p>
                </div>

            </div>
        </div>
        <!--
        <div class="col-sm-6">
            <div class="box">
                <div class="box-body" style="text-align: center;">
                    <div align="center" class="embed-responsive embed-responsive-16by9" style="width:auto;height:300px">
                    <iframe src="https://www.youtube.com/embed/JhoCcO60r4c?autoplay=0&amp;showinfo=0&amp;controls=0&amp;rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
                    </div>
                </div>

            </div>
        </div>
        -->
    </div>
    
    <div class="row">
        <h2 class="box-title" style="text-align: center; ">How does it work - Instructions</h2>

        <div class="col-sm-12">
            <div class="box box-solid">
                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        <div class="panel">
                            <div class="box-header">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" class="loading">
                                      It sounds too good to be true! How does it work?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseNine" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">
                                <p>Why is a brand paying for this and also give me a product for free?</p>
                                <p>All respectable brands want to know what customers think of their product, in comparison with other products in the market.</p>
                                <p>To acquire this information, they have to invest money into it. Asking you for your opinion, and paying you for your help is a significant investment for each company to get the valuable information they need.</p>
                                <p>Your input, together with the input of many others, will generate the data a brand needs to finalize its marketing strategies.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="box-header">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="loading">
                                        How Do I Sign Up for a Product Test?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">
                                    <p>Every week we will invite you to different product tests. Once invited to a product test, you follow the step-by-step instructions to redeem the product and receive a 100% cash back rebate for the full cost of the product.</p>
                                    <p>&nbsp;</p>
                                    <p>Cashback rebates are issued after:</p>
                                    <ul>
                                        <li>You provide us your Order Number</li>
                                        <li>We verify that the order has been shipped from the warehouse. Rebates are not issued until the product has shipped.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="box-header">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" class="loading">
                                        How Do I Receive the Additional Cash Bonus on a Product Test?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">
                                    
                                    <p>Cash bonuses are money you earn on top of the rebate amount you will receive to cover the cost of the product you purchased. You earn this additional money when you participate in a product test.</p>
                                    <p>These are issued after you test the product and complete a survey. Invites are sent to product testers once it is time to complete a product survey. After we have verified that the survey is completed, we will send your cash bonus to you.</p>
                                    

                                </div>
                            </div>
                        </div>

                        
                        
                            <div class="panel">
                                <div class="box-header">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed loading" aria-expanded="false">
                                            How Do I Get Access to More Products?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="box-body">
                                        <p>New products are unlocked every-time you complete a product test. Once a product test is complete, you will receive an invite to sign up for a new product test.</p>
                                        <p>As your membership status increases, you will be allowed to test more products at the same time. So our top tier members can sign up to test multiple products at once.</p>
                                        <p>Also – higher value products and more choices are unlocked as your membership status raises.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="box-header">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed loading" aria-expanded="false">
                                            How Does the Whole Process Work?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="box-body">
                                        <p>Here’s a step-by-step guide on how you can successfully complete a product review</p>
                                        <ol start="1">
                                            <li>Accept a product or campaign on your dashboard. All campaigns are final, so make sure to read the details and requirements before accepting one.</li>
                                        </ol>
                                        <ol start="2">
                                            <li>Once a product or campaign has been claimed, you will be required to purchase the product from its respective marketplace or website.</li>
                                        </ol>
                                        <ol start="3">
                                           <li>After placing your order, copy and paste your Order ID onto the webpage for verification (Please see video below / in the next page for detailed instructions on how to complete this step).</li>
                                        </ol>
                                        <ol start="4">
                                             <li>When your product arrives, proceed to test and use it on a daily basis (or as recommended). It also helps to take notes of your experience: Is it good quality? Was it easy to use? What are the noticeable benefits from using it? Is it something you would continue using or consider repurchasing?</li>
                                        </ol>
                                        <ol start="5">
                                            <li>After a few days of product testing, we will send you instructions and a questionnaire about the product. Remember to give your honest opinions when provide the required information.</li>
                                        </ol>
                                        <ol start="6">
                                            <li>Once we receive your completed feedback, we will then issue your cashback bonus.</li>
                                        </ol>
                                        <ol start="7">
                                            <li>Brands often give our additional bonuses and prizes to top users – so keep an eye out for these once your product test is complete.</li>
                                        </ol>
                                        <ol start="8">
                                            <li>Accept your next product or campaign from other top brands, and enjoy product testing!</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    
    
    <div class="row">
        <h2 class="box-title" style="text-align: center;  height: 75px; font-weight: bold;">FAQ</h2>
        <div class="col-sm-12">
            <div class="box box-solid">
                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        <div class="panel">
                            <div class="box-header">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOneTwo" aria-expanded="false" class="collapsed loading">
                                        Why Do I Have to Buy the Product First?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOneTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">
                                  <p>The platform works by providing you with a virtual credit card for the payment for the full-cost of the product. So you will first be required to purchase the product, and then we will issue you a rebate after your order is confirmed and once it ships from the warehouse.</p>
                                  <p>We do this for many reasons – first, we want to make sure that our members are committed to the program. Members receive free products and earn money for product tests – so this is a good-faith gesture on our member’s part that shows their commitment to the process. Second – we need members to go through the entire buying process so they can provide the brands with the most valuable feedback. The buying process is a part of the full customer experience. Lastly, this is the only way Reviewers.club and brand partners can properly track product tests.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="box-header">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwoTwo" class="collapsed loading" aria-expanded="false">
                                        Can I Ever Lose My Membership?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwoTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">
                                   <p>We love and truly value all Reviewers.club members – but if we ever find a member attempting to exploit the program or brands, we will remove the member immediately.</p>
                                   <p>As long as a member participates and follows the rules, they will never be removed.</p>
                                </div>
                            </div>
                        </div>
                            <div class="panel">
                                <div class="box-header">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThreeTwo" class="collapsed loading" aria-expanded="false">
                                            What if I’m not Interested in the Product You Invite Me to?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThreeTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="box-body">
                                       <p>We understand you may not be interested in every product. But it is important that you actively participate and sign up for product tests to earn and to unlock higher-value products. The more product tests you complete, the higher your membership status, and the more-high value products you will be invited to.</p>
                                       <p>It is ok to pass on a product test – but if you would like to unlock the best products it is important you participate as much as possible.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="box-header">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFourTwo" class="collapsed loading" aria-expanded="false">
                                            If I’m not Interested in a Product – Can I Order It for Someone in My Family to Test?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFourTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="box-body">
                                        <p>Yes, absolutely. We very much support allowing family members to test products.</p>
                                        <p>However, if you do this – it is very important for you to get their feedback on the product so you can provide valuable feedback in your survey. You can even have the family member complete the survey with you.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
            
            
            
<script>

    $(document).on("click", "#requestnew_emailverification", function()
    {
       //alert('This information has been sent to the email in your profile');
       

       
       $.ajax({		
    		url: "{{route('Sendverifyemail')}}",		
    		type: 'POST',		
    		data: {"_token":$('#token').val()},
    		beforeSend: function() {
    					
    			loading = $("body").waitMe({
    				effect: 'timer',
    				text: 'Sending New Verification Code.........',
    				bg: 'rgba(255,255,255,0.90)',
    				color: '#555'
    			}); 
    					
    		},		
    		success: function(data)	{
    			
            	loading.waitMe('hide');
            	
            	swal({
    					  title: "",
    					  text:  data,
    					  type: 'success',
    					}).then(function (result) {
    
    				}); 
    		
    		
    		
    		
    		
    			
    		},		
    		error: function(error){ 		
    		console.log(error);		
    		}	
    	});	
    
    
    });
    </script>
			
		
				
@endsection