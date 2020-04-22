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
	
			  <div class="box custom_box">
				<div class="box-header with-border">
				  <h3 class="box-title">User Settings</h3>

				  <div class="box-tools">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				  </div>
				</div>
				<div class="box-body no-padding">
				  <ul class="nav nav-pills nav-stacked">

					<li class='active'>
						<a href="{{asset('user/profile')}}">Your profile </a>
					</li>
					
					<li>
						<a href="{{asset('user/avatar')}}"> Upload your avatar </a>
					</li>
					
					<li> 
						<a href="{{asset('user/changepassword')}}"> Change your password</a>
					</li>
					
					<li> 
						<a href="{{asset('user/update/interest')}}"> Your product interest</a>
					</li>
					<li> 
						<a href="{{asset('user/mywallet')}}"> My Wallet</a>
					</li>
					
					<!--<li > -->
					<!--	<a href="{{asset('user/mypoints')}}"> My Points</a>-->
					<!--</li>-->
					
				  </ul>
				</div>
				<!-- /.box-body -->
			  </div>
			
		</div>
	  
	   <div class="col-lg-9">
	   
		<div class="box box-primary custom_box" >
            <div class="box-body">
			
			<form id="userprofile" enctype="multipart/form-data"> 
			{{ csrf_field() }}
			
			<div class="box-header with-border">
              <h3 class="box-title">Edit Personal Profile</h3>
            </div>
			<br>
			
				
				<div class="col-lg-12">
				    
				    
				      <div class='row'>
                      <div class="form-group">
    
                        		<div class='col-lg-6'>  
                                    	<div class="form-group">
                						  <label for="exampleInputEmail1"><span style='color:red'>*&nbsp;</span>First Name</label>
                						  <input type="text" value="{{$data->name}}" required  class="form-control" id="name"  name="name">
                						</div>
                                </div>
                              
                            
                                 <div class='col-lg-6'>  
                                    	<div class="form-group">
                						  <label for="exampleInputEmail1"><span style='color:red'>*&nbsp;</span>Last Name</label>
                						  <input type="text" value="{{$data->lastname}}" required  class="form-control" id="lastname"  name="lastname">
                						</div>
                                </div>
                                
                            
                      </div>        
                      </div>
				
				
				        <!--
						<div class="form-group">
						  <label for="exampleInputEmail1"><span style='color:red'>*&nbsp;</span>Full Name</label>
						  <input type="text" value="{{$data->name}}" required  class="form-control" id="fullname"  name="fullname">
						</div>
						-->
						
						<div class="form-group">
						  <label for="exampleInputEmail1"><span style='color:red'>*&nbsp;</span>Email</label>
						  <input type="email" value="{{$data->email}}" required  class="form-control" id="email"  name="email">
						</div>
						
						
						<div class="form-group">
						  <label for="exampleInputEmail1">Mobile Number</label>
						  <input type="text" value="{{$data->mnumber}}"  class="form-control" id="mnumber"  name="mnumber">
						</div>
						
						
						<div class="form-group">
						  <label for="exampleInputEmail1">Gender</label>
						    <select class="form-control" name='gender' id='gender'>
								<option value='male'>Male</option>
								<option value='female'>Female</option>
							</select>
						</div>
						
						<script>
							  $("#gender").val("{{$data->gender}}");
						</script>
						
						
						<?php
							@$pieces = explode("/", @$data->dob);
						?>
						
						<div class="form-group">
						
						    <div class='row'>
	   
							
							   <div class='col-lg-6'>
									<label for="exampleInputEmail1">Month of birth</label><br>
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
							   
							   <script>
							    	$("#month").val("{{@$pieces[0]}}");
								</script>
							   
							  
								
								<div class='col-lg-6'>
								<label for="exampleInputEmail1">Year of born</label><br>
									<input  placeholder="Year"  id="year" name='year' type="text" value="{{@$pieces[1]}}" class="required form-control"   required autofocus>
								</div>
							   
							   
							   </div>
						</div>
						
						
						<div class="form-group">
						  <label for="exampleInputEmail1">Zip Code</label>
						  <input type="text" value="{{@$data->zipcode}}"  class="form-control" id="zipcode"  name="zipcode">
						</div>
						
						
						<div class="form-group">
						   <label for="exampleInputEmail1">Address</label>
							<textarea class='required' style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="address" name="address">{{$data->address}}</textarea>
						</div>
						
						
						<div class="form-group">
						  <label for="exampleInputEmail1">Paypal Address</label>
						  <input type="text" value="{{@$paypal->paypal_email}}"  class="form-control" id="paypal_address"  name="paypal_address">
						</div>
						
						
						<div class="form-group">
						   <label for="exampleInputEmail1"><b style='color:red'>Allow My Email For Notifications</b></label>
						   	<select name='allow_email_subscribe' class='form-control' id='allow_email_subscribe' >
									<option value='0'>Allow</option>
									<option value='1'>Unsubscribe</option>
							</select>
							@if($data->allow_email_subscribe == 1)
    						    <span>*You will not receive any message from  us</span>
    						@endif
						</div>
						
						 <script>
					    	$("#allow_email_subscribe").val("{{$data->allow_email_subscribe}}");
						</script>
						
				  
				
				</div>
			
			  
            </div>
            <!-- /.box-body -->
           <div class="box-footer">
                
                 
                 
                  <div class="pull-right">
                      
                 <button type="submit" id='btnSave' class="btn btn-primary">Save Details</button>
                 
                  <a href="{{asset('user/profile')}}" class="loading">
                        <button type="button" class="btn">Cancel</button>
                  </a>
                
                
               
                </div>
                
         </div>
		 
		</form>	
		</div>
	  
	  </div>
      <!-- /.row (main row) -->	  
    
	</section>
    <!-- /.content -->
<!-- /.content-wrapper -->
</div>



<script>


var loading ="";
$("#userprofile").on("submit", updateprofile);

function updateprofile(event)
{
	
	event.preventDefault();
	 
	$('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
	
	var formData = new FormData(this);
	
	$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
	});
	
	// save data template
    $.ajax({
		url 	: "{{ asset('user/update/profile')}}",
		type	: "POST",
		data	: formData,
		processData: false,
		contentType: false,
		beforeSend: function() {
					

			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Updating Profile........',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
				
		},
        success: function(data)
        {
			console.log(data);
			loading.waitMe('hide');
		
			if(data.success == 'success') //if success close modal and reload student table
            {
             
					swal({
					  title: 'Updated Successfully',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
					 
						location.reload();
					  
					});
				
            }
				
		
            $('#btnSave').text('Save Details'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			loading.waitMe('hide');
            alert('Error adding / update data');
            $('#btnSave').text('Save Details'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    }); 

}

</script>

@endsection
