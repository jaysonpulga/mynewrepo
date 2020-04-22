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
	           $menu = 'password'
	           @endphp
	           @include('frontend.layouts.profile_menu')
			
		</div>
	  
	   <div class="col-lg-9">
	   
		<div class="box box-primary custom_box" >
            <div class="box-body">
			
			<form id="userpassword" enctype="multipart/form-data"> 
			{{ csrf_field() }}
			
			<div class="box-header with-border">
              <h3 class="box-title">Change Password</h3>
            </div>
			<br>
			
				
				<div class="col-lg-12">
				
				
					  @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
				
						<div class="form-group">
						  <label for="exampleInputEmail1"><span style='color:red'>*&nbsp;</span>Current Password</label>
						  <input type="password"  required  class="form-control" id="current_password"  name="current_password">
						</div>
						
						
						<div class="form-group">
						  <label for="exampleInputEmail1"><span style='color:red'>*&nbsp;</span>New Password</label>
						  <input type="password" required  class="form-control" id="newpassword"  name="newpassword">
						</div>
						
						
					    <div class="form-group">
						  <label for="exampleInputEmail1"><span style='color:red'>*&nbsp;</span>Confirm Password</label>
						  <input type="password" required  class="form-control" id="confirmpassword"  name="confirmpassword">
						</div>
						
						
				  
				
				</div>
			
			  
            </div>
            <!-- /.box-body -->
           <div class="box-footer">
                <button type="submit" id='btnSave' class="btn btn-primary pull-right">Save Details</button>
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
$("#userpassword").on("submit", userpassword);

function userpassword(event)
{
	
	event.preventDefault();
	 
	$('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
	var message = "";
	//var formData = new FormData(this);
	
	var formData = $('#userpassword').serialize();
	
	$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
	});
	
	// save data template
    $.ajax({
		url 	: "{{ asset('user/update/password')}}",
		type	: "POST",
		data	: formData,
		datatype: 'json',
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
			
			 $('#btnSave').text('Save Details'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
			
			
			if(data.success == true && data.error == false)
			{
				swal({
					  title: 'Updated Successfully',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
					 
						location.reload();
					  
					});
			}
			else if(data.success == false && data.error == true)
			{
				 
				
			
				swal({
					  title: "",
					  text: data.message,
					  type: 'warning',
				});
				

			}
			
			
			/* if(data.success['success'] == 'success') //if success close modal and reload student table
            {
             
					swal({
					  title: 'Updated Successfully',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
					 
						location.reload();
					  
					});
				
            } */
				
			
				
		
           


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
