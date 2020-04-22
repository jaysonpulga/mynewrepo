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
	           $menu = 'interest'
	           @endphp
	           @include('frontend.layouts.profile_menu')
			
		</div>
	  
	   <div class="col-lg-9">
	   
		<div class="box box-primary custom_box" >
            <div class="box-body">
			
			<form id="user_ineterest" enctype="multipart/form-data"> 
			{{ csrf_field() }}
			
			<div class="box-header with-border">
              <h3 class="box-title">Update Your Product Interest</h3>
            </div>
			<br>
			
				
			
				
				<div class="col-lg-12">				
				<fieldset>
				<div class="row">
				
				<div class='col-md-12'>
				<input id="selectall"   type="checkbox" >&nbsp; <label for="selectall">Select All</label> <br>
				</div>
				
				
			
					<?php  $values = explode("|", $data->interest);  ?>
    			   <div class='col-lg-6'>
    			        <input id="chk1" name="group_interest[]" value="chk1" {{ in_array('chk1', $values) ? 'checked': ''}}    type="checkbox">&nbsp; <label for="chk1">Baby*</label> <br>
    					<input id="chk2" name="group_interest[]" value="chk2" {{ in_array('chk2', $values) ? 'checked': ''}}  type="checkbox">&nbsp; <label for="chk2">Beauty*</label> <br>
    					<input id="chk3" name="group_interest[]" value="chk3" {{ in_array('chk3', $values) ? 'checked': ''}} type="checkbox">&nbsp; <label for="chk3">Clothing & Accessories</label> <br>
    					<input id="chk4" name="group_interest[]" value="chk4" {{ in_array('chk4', $values) ? 'checked': ''}} type="checkbox">&nbsp; <label for="chk4">Consumer Electronics</label> <br>
    					<input id="chk5" name="group_interest[]" value="chk5" {{ in_array('chk5', $values) ? 'checked': ''}}   type="checkbox">&nbsp; <label for="chk5">Grocery & Gourmet Foods</label> <br>
    					<input id="chk6" name="group_interest[]" value="chk6" {{ in_array('chk6', $values) ? 'checked': ''}}  type="checkbox">&nbsp; <label for="chk6">Health & Personal Care</label> <br>
    					<input id="chk7" name="group_interest[]" value="chk7" {{ in_array('chk7', $values) ? 'checked': ''}}   type="checkbox">&nbsp; <label for="chk7">Home & Garden</label> <br>
    					<input id="chk8" name="group_interest[]" value="chk8" {{ in_array('chk8', $values) ? 'checked': ''}}  type="checkbox">&nbsp; <label for="chk8">Travel</label> <br>
    					<input id="chk9" name="group_interest[]" value="chk9" {{ in_array('chk9', $values) ? 'checked': ''}}  type="checkbox">&nbsp; <label for="chk9">Music</label> <br>
    			   </div>
    			   <div class='col-lg-6'>
    			        <input id="chk10" name="group_interest[]" value="chk10" {{ in_array('chk10', $values) ? 'checked': ''}}    type="checkbox">&nbsp; <label for="chk10">Office Products</label> <br>
    					<input id="chk11" name="group_interest[]" value="chk11" {{ in_array('chk11', $values) ? 'checked': ''}}  type="checkbox">&nbsp; <label for="chk11">Outdoors</label> <br>
    					<input id="chk12" name="group_interest[]" value="chk12" {{ in_array('chk12', $values) ? 'checked': ''}} type="checkbox">&nbsp; <label for="chk12">Computers</label> <br>
    					<input id="chk13" name="group_interest[]" value="chk13" {{ in_array('chk13', $values) ? 'checked': ''}} type="checkbox">&nbsp; <label for="chk13">Pet Supplies</label> <br>
    					<input id="chk14" name="group_interest[]" value="chk14" {{ in_array('chk14', $values) ? 'checked': ''}}  type="checkbox">&nbsp; <label for="chk14">Shoes, Handbags, & Sunglasses</label> <br>
    					<input id="chk15" name="group_interest[]" value="chk15" {{ in_array('chk15', $values) ? 'checked': ''}} type="checkbox">&nbsp; <label for="chk15">Software</label> <br>
    					<input id="chk16" name="group_interest[]" value="chk16" {{ in_array('chk16', $values) ? 'checked': ''}} type="checkbox">&nbsp; <label for="chk16">Sports</label> <br>
    					<input id="chk17" name="group_interest[]" value="chk17" {{ in_array('chk17', $values) ? 'checked': ''}} type="checkbox">&nbsp; <label for="chk17">Tools & Home Improvement</label> <br>
    					<input id="chk18" name="group_interest[]" value="chk18" {{ in_array('chk18', $values) ? 'checked': ''}} type="checkbox">&nbsp; <label for="chk18">Toys*</label> <br>
    			   </div>
					   
							
							

				</div>
				</fieldset>
								
				
			<hr>
			  <br>
				</div>
            <!-- /.box-body -->
           <div class="box-footer">
                <button type="submit"  class="btn btn-primary pull-right">Save</button>
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
/* $("#selectall").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 }); */
   $("#selectall").change(function() {
        if (this.checked) {
            $("input:checkbox").each(function() {
                this.checked=true;
            });
        } else {
            $("input:checkbox").each(function() {
                this.checked=false;
            });
        }
    });
</script>



<script>


var loading ="";
$("#user_ineterest").on("submit", user_ineterest);

function user_ineterest(event)
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
		url 	: "{{ asset('user/update/userinterest')}}",
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
