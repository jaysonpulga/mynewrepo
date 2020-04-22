@extends('frontend.layouts.main')

@section('content')


<style>
.custom_box
{
		border: 1px solid #abaaaa;
	      border-radius: 1px !important;
}

</style>




<section class="content">
    <!-- Main content -->
    <section class="row">
	

	
	   <!-- Small boxes (Stat box) -->
      <div class="row">
	  
		<div class="col-md-3">
		    @php
	           $menu = 'profile'
	       @endphp
	       @include('frontend.layouts.profile_menu')
		</div>
		
		
        
	  
       <div class="col-md-6">
           
           
        <div class='row'>
	        <div class="col-md-12 col-sm-12 col-xs-12" >
	            
        	<div class="box">

                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="box-header with-border">
                    <h3 class="box-title">Your Personal Details </h3>
                    <a href="{{asset('user/edit/profile')}}" class="loading">
                        <button type="button" class="btn btn-primary pull-right">Edit</button>
                    </a>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li>
                            <a class="loading">
                                Name
                                <span class="pull-right">
                                   {{$data->name}}  {{$data->lastname}}
                                </span>
                            </a>
                        </li>
    
                        <li><a class="loading">Gender<span class="pull-right">{{$data->gender}}</span></a></li>
                        <li><a class="loading">Email<span class="pull-right">{{$data->email}}</span></a></li>
                        <li><a class="loading">Address 1 <span class="pull-right">{{$data->address}}</span></a></li>
                        <li><a class="loading">Zip <span class="pull-right">{{@$data->zipcode}}</span></a></li>
                        <li><a class="loading">Phone <span class="pull-right">{{$data->mnumber}}</span></a></li>
                        
                        <li>
                            <a class="loading">Allow My Email For Notifications 
                            <span class="pull-right">
                                @if($data->allow_email_subscribe == "0")
                                    Allow
                                @else
                                    Unsubscribe
                                @endif
                            </span>
                            </a>
                        </li>
                        
                        
                        
                        <li>
                            <a class="loading">PayPal Address 
                                <span class="pull-right">{{@$paypal->paypal_email}}</span>
                            </a>
                        </li>
                        
                         <li>
                            <a class="loading">
                                <span> Facebook Messenger  </span>
                                <span class="pull-right">
                                    
                                    @if(@$fb_messenger->status == "verified")
                                             <span style='font-size:11px'>Your Facebook messenger is subscribed</span>
                                         <span><img src="{{asset('/public/img/facebook_verified.png')}}" style="width:28px;height:28px;"></span>
                                         
                                         
                                    @else
                                    
                                      <button type="button" id='fb_subscribe' class="btn btn-block btn-primary btn-xs">Click to subscribe</button>
                                    
                                    @endif
                                    
                                    
                               
                                </span>
                            </a>
                        </li>
                        
                    </ul>
                    <!--input type="button" onclick="confirmOptIn()" value="Confirm Opt-in"/!-->

                </div>
            </div>
        	
        	
        	</div>
	    </div>
           
           
           
           
        </div>
	   
	   

	   
	   
	
	   
	  
	   
	   
	
	   
	   <div class="col-md-3">
	       
	       <!--
           <div class='row'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box box-primary">
                      <div class="box-body">
                          <center>
                           <img src="{{asset('/public/img/certified.png')}}" style="width:120px;height:120px;">
                           <h4>Paypal Verified</h4>
                           </center>
	                   </div>
	                </div>
	           </div>
	       </div>
	       -->
	       
	        <div class='row'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box box-primary">
                    <div class="box-header with-border">
			          <h3 class="box-title"> Your Badges </h3>
		        	</div>    
                      <div class="box-body">
                          
                            @if(@$fb_messenger->status == "verified")
                                <span><img src="{{asset('/public/img/facebook_badge123.png')}}" style="width:80px;"></span>
                            @endif             
                          
                          
                              @if(@$paypal->paypal_email != "")
                                <span><img src="{{asset('/public/img/certified.png')}}" style="width:80px;"></span>
                            @endif             
                          
                          
                        
                           
                
	                   </div>
	                </div>
	           </div>
	       </div>
	       
	        <div class='row'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box box-primary">
                	<div class="box-header with-border">
			          <h3 class="box-title"> Default Payout Method </h3>
		        	</div>
                      <div class="box-body">
                          
                          
                        <div>
                            <div class="box-widget widget-user-2 ptm no-mb">
                                <div class="widget-user-header pam mll">
                                    <div class="widget-user-image"><img src="{{asset('/public/img/paypal.jpg')}}" class="img-circle"></div> 
                                        <a href="javascript:void(0)" id='paypal_info'>
                                            <h5 class="widget-user-desc"><strong> Paypal </strong> </h5> 
                                            <h6 class="widget-user-desc">  Powered by Paypal </h6>
                                        </a> 
                                        <br>
                                        <small>
                                            <span>
                                            Connect with PayPal and receive your payout directly to your <a href="https://www.paypal.com/gf/smarthelp/article/how-do-i-verify-my-paypal-account-faq619" target="_blank" data-toggle="tooltip" title="" data-original-title="Make sure your PayPal account is verified before using the Connect with PayPal button">verified</a> PayPal account. 
        									</span>
    									</small>
                                  
                                </div>
                            
                            </div>
                        </div>
	  
	                   </div>
	                </div>
	           </div>
	       </div>
	       
	       
	   </div>
	   
	  
	   
	   

	   
	
	    
      <!-- /.row (main row) -->	  
    
	</section>
    <!-- /.content -->
<!-- /.content-wrapper -->
</div>



<div id="show_paypal_info" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><center>PayPal payment information</center></h4>
          </div>
          <div class="modal-body">
        
                 <div class="box-body">
                    <p>
                        You have to create an account at PayPal. The money will be paid to this account and stay there, you have to transfer
                        it to your bank account manually every time again.
                        PayPal is pretty easy to use, create an account with your email address and receive payment to your email address
                    </p>
                    <ul>
                        <li>
                            <b>What can I do with PayPal?</b>
                            <br>
                            <p>PayPal lets you quickly and securely send and receive money for goods, services and more.</p>
                        </li>
            
                        <li>
                            <b>How do I sign up for a PayPal account?</b>
                            <br>
                            <p>There are 2 types of PayPal accounts: Personal and Business. You can open a Personal account.
                                Visit the sign up page at PayPal.com and follow the steps asked.
                            </p>
                        </li>
            
                        <li>
                            <b>More question?</b>
                            <br>
                            <p>Visit <a href="https://www.paypal.com/us/smarthelp/home" target="_blank" >https://www.paypal.com/us/smarthelp/home</a>
                            </p>
                        </li>
            
                    </ul>
                </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
 </div>
<!-- /.content -->






<div id="show_fb_messenger" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><center>Accept Reviewers.club on facebook messenger</center></h4>
          </div>
          <div class="modal-body">
              
              <div class="box-body">



            <div class="bb-dimmed pbxl mbxl">
              
                
                <div class="row">
                    
                    
            
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    
                       <small style="display:block">
                        To get more rebates and earn more points accept us on Facebook, Simply click on the
                        Send to Messenger button and the system will detect if the sign up is successful!
                      </small> 
                      
                      
        
                         <p  class="mcwidget-embed pull-left" id="mc-dfa15dbd-b463-b149-92b7-ef70750b5d03" class="fb-send-to-messenger mc-send-to-messenger fb_iframe_widget" messenger_app_id="532160876956612" page_id="101989987842833" data-ref="optin_7343061_c28fac1d-8fec-9fca-b3e7-4e0e744b53aa_3d914d63-738c-1ab4-26e2-23f0b572873a" color="blue" size="large" cta_text="SEND_TO_MESSENGER" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=532160876956612&amp;color=blue&amp;container_width=155&amp;cta_text=SEND_TO_MESSENGER&amp;locale=en_US&amp;messenger_app_id=532160876956612&amp;page_id=101989987842833&amp;ref=optin_7343061_c28fac1d-8fec-9fca-b3e7-4e0e744b53aa_3d914d63-738c-1ab4-26e2-23f0b572873a&amp;sdk=joey&amp;size=large"><span style="vertical-align: bottom; width: 256px; height: 52px;"><iframe name="f10fdca51e49ae8" width="1000px" height="1000px" title="fb:send_to_messenger Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v3.1/plugins/send_to_messenger.php?app_id=532160876956612&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D44%23cb%3Df2f4f52ca9ab65%26domain%3Dreviewers.club%26origin%3Dhttps%253A%252F%252Freviewers.club%252Ff31fdb446222c68%26relation%3Dparent.parent&amp;color=blue&amp;container_width=155&amp;cta_text=SEND_TO_MESSENGER&amp;locale=en_US&amp;messenger_app_id=532160876956612&amp;page_id=101989987842833&amp;ref=optin_7343061_c28fac1d-8fec-9fca-b3e7-4e0e744b53aa_3d914d63-738c-1ab4-26e2-23f0b572873a&amp;sdk=joey&amp;size=large" style="border: none; visibility: visible; width: 256px; height: 52px;" class=""></iframe></span></p>
                        
                     
                     
                   
                    </div>
                    
                    
                  
                </div>
                
                
                <div class="mtl">
                    
           
                    <br>
                    <div>					
            		        
            		        <label>Paste your verification code to receive personal message through messenger </label> 
            			 
            					<div class="input-group" style="width:90%">
            					  <input type="text"  name="verification_code" id="verification_code" class="form-control" placeholder="Enter  Verification Code">
            					  <div class="input-group-btn">
            					   <button type="button" form="check_invite_code" class="btn btn-primary" id="submit_code">Submit</button> 
            					  </div>
            					</div>
            			
            	
            		</div>
                    
                  
                    
                </div>
            </div>
            


</div>
        
              

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
 </div>
<!-- /.content -->

<script>
$(document).on("click", "#paypal_info", function()
{
        
    $("#show_paypal_info").modal("show");    

});	 
</script>



<script>
$(document).on("click", "#fb_subscribe", function()
{
    $("#show_fb_messenger").modal("show");    
  

});	 
</script>



<script>
var loading ="";	
$("#submit_code" ).click(function() {
	

var verification_code  = $('#verification_code').val();



if(verification_code == "")
{
            	swal({
					  title: '',
					  text:  "Please input verification code",
					  type: 'warning',
					});
					
					return false;
}


	
	


 $.ajax({

		url 	: "{{ asset('user/verify/verification_code')}}",
		type	: "POST",
		data	: {'verification_code':verification_code,"_token":$('#token').val()},
		beforeSend: function() {
					

			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Verifying ........',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
				
		},
        success: function(data)
        {
			
           console.log(data);
			loading.waitMe('hide');
			
			if(data.result == 'success') //if success close modal and reload student table
            {
             
					swal({
					  title: '',
					  text:  "your verification code has been saved",
					  type: 'success',
					}).then(function (result) {
					 
					 
						
							location.reload();
						
					  
					});
				
            }
			else
			{
			    
			    	swal({
					  title: '',
					  text:  "your verification code is not valid",
					  type: 'warning',
					});
			    
			}
				
		
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			loading.waitMe('hide');
            alert('Error submitting verification code');

        }
    }); 





})
</script>



@endsection

