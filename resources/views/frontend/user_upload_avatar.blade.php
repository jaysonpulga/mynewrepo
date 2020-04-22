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
	           $menu = 'avatar'
	           @endphp
			  @include('frontend.layouts.profile_menu')
			
		</div>
	  
	   <div class="col-lg-9">
	   
		<div class="box box-primary custom_box" >
            <div class="box-body">
			
			<form id="userpassword" enctype="multipart/form-data"> 
			{{ csrf_field() }}
			
			<div class="box-header with-border">
              <h3 class="box-title">Your avatar</h3>
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
						    
						    <div class="panel-body" align="center">
              					<input type="file" name="upload_image" id="upload_image" />
              					<br />
              					<div id="uploaded_image">
              					    
              					 
              					  @if(empty(Auth::user()->avatar))         
                                        
                                         <img src="{{ asset('public/azmproject_images/avatar/person-placeholder.jpg')}}"  alt="User Image"> 
                                    @else
                                   
                                        <img src="{{ asset('public/azmproject_images/avatar/')}}/{{Auth::user()->avatar}}"  alt="User Image"> 
                                        
                                    @endif
              					     
              					    
              					    
              					</div>
              				</div>
					
					
						</div>
						
						
					
						
				  
				
				</div>
			
			  
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



<div id="uploadimageModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Upload & Crop Image</h4>
      		</div>
      		<div class="modal-body">
        		<div class="row">
  					<div class="col-md-8 text-center">
						  <div id="image_demo" style="width:350px; margin-top:30px"></div>
  					</div>
  					<div class="col-md-4" style="padding-top:30px;">
						  <button class="btn btn-success crop_image">Crop & Upload Image</button>
					</div>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
    </div>
</div>


<script>  
var loading ="";
$(document).ready(function(){

	$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
        

    
      $.ajax({
        url 	: "{{ asset('user/update/avatar')}}",
        type: "POST",
        data:{"image": response , _token: "{{csrf_token()}}"},
        beforeSend: function() {
					

			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Upload your avatar........',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
				
		},
        success:function(data)
        {
         // $('#uploadimageModal').modal('hide');
         // $('#uploaded_image').html(data);
         loading.waitMe('hide');
         location.reload();
        console.log(data);
        }
      });
    
      
    })
  });

});  
</script>

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
