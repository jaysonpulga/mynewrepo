

<div class="row" >
	<div class="box" >
		<div class="box-body">
			<div class="col-lg-12">
				
			

			


				<div class="form-group">
					<div class="col-lg-12">
						<h3>Thank you for purchasing our product and completing this offer</h3>
						<p></p>
						<p></p>
						<br>
						<br>
						
						<button id="completedthisoffer" type="submit" class="btn" style="background-color:#6ece16;color:#fff">Mark As Completed Offer</button>	
						
						<br>
						<br>
						<br>
					</div>	
				</div>
				

			</div>
			
		
		</div> <!-- box-body -->
	</div> <!-- box  -->
</div><!-- row -->

<script>
var loading = "";


$("#completedthisoffer").click(function() 
{
	
		$.ajax({
		url: "{{asset('markasoffercompleted')}}",
		type: 'POST',
		data: {offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
		
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'this campaign will move to the completed offer table.....',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
			
		},
		success: function(data)
		{
			
			if(data.result == "success")
			{
				//loading.waitMe('hide');
				console.log(data);
				
				// submit_purchasesurvey();  // saving purchase survey data
			   // getfirststep();			// get Status of Shipment company
			  // checkifcomplete();        //check status
				
				
				
				loading.waitMe('hide');
				swal({
					  title: 'Success, Campaign Completed!',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
					
						window.location.href = "{{asset('dashboard')}}";
				}); 
				
				
				
			}
			
		},
		error: function(error){ 
			console.log(error);
			loading.waitMe('hide'); 
		}

	});
	
});

</script>