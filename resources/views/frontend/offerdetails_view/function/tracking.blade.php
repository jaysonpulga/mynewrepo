<script>
var loading = "";


$("#productsurvey").click(function() 
{

	var check = check_important_field();
	if(check== true)
	{
		
		submit_tracking_number_and_survey();
	}  
	
});


function check_important_field()
{
	var isFormValid = true;

	$("#purchased_form .required").each(function()
	{
		

		
		if ($.trim($(this).val()).length == 0){
			
			//var id = $(this).attr('id');
				
			$(this).addClass("highlight");
			isFormValid = false;
			$(this).focus();
		}
		else
		{
			$(this).removeClass("highlight");
		}
		 
		 
	});

	if (!isFormValid)
	{ 
		//alert("Please fill in all the required fields ( indicated by *) ");
		
		swal({
			  title: '',
			  text:  "Please fill in all the required fields ( indicated by *) ",
			  type: 'warning',
		});
	}

	return isFormValid;

} 

function submit_tracking_number_and_survey()
{
   var redirect_url = "{{ url('')}}";
   var url = new URL(redirect_url);
   var pathname = url.pathname; 
   var redirect_path =  redirect_url+''+pathname+'/campaign/getdata/insight/offerdetails/{{ $offerdetails[0]->id }}/#step-4';
	
	

	var shipment_company = $("#shipment_company").val();
	var trucking_number = $("#saveTrackingnumber").val();
	var tracking_notes = $("#tracking_notes").val();
	var answersproductList = [];
	

	//Get all answers
    /*$(".productsurvey_ans").each(function() 
	{
		var questionId = $(this).attr("id");
		
		
		if($(this).data('fieldtype') == "rating_star" ) 
		{
			var answer = $("input[type='radio']:checked", $(this)).val();
			
			if (answer !== undefined) 
			{
				answersproductList.push({
					  model: 'product_survey',
					  questionId: questionId,
					  answer: answer,
					  'fieldtype':$(this).data('fieldtype')
					});
			}
		}
		else if ( $(this).data('fieldtype') != "Radio" )
		{
				answersproductList.push({
						   model: 'product_survey',
						  questionId: questionId,
						  answer: $(this).val(),
						  'fieldtype':$(this).data('fieldtype')
				});
		} 

    });
	*/
	
	
	
	$.ajax({
		url: "{{asset('submit_tracking_number_and_survey')}}",
		type: 'POST',
		//data: {trucking_number:trucking_number,shipment_company:shipment_company,answersproductList:answersproductList,offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()},
		data: {trucking_number:trucking_number,shipment_company:shipment_company,tracking_notes:tracking_notes,offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
		
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Verifying .......',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
			
		},
		success: function(data)
		{
			
			
			
			
			//alert(data.result.isDelivered + ' ' +  data.result.statusWithDetails);
			console.log(data);
			
			//if(data.success == "success")
			//{
				//loading.waitMe('hide');
				//console.log(data);
				
				// submit_purchasesurvey();  // saving purchase survey data
			   // getfirststep();			// get Status of Shipment company
			  // checkifcomplete();        //check status
				
				
				// get the data submited
				//getPurchasedData(); // purchased_survey.blade.php
						
				// check the traking status 
				//checking_tracking_number(); //checking_tracking_number.blade.php
				
			
			loading.waitMe('hide');
				
			if(data.result.status == "Delivered"  || data.result.status == "delivered" )
			{	
				
	
				swal({
					  title: 'Purchased Verified',
					  text:  "Thanks for purchasing this product ,  you have received cashback rebate: ${{@$fee_product_purchased}} proceed to product review",
					  type: 'success',
					}).then(function (result) {
						location.reload();
					   //	window.location.href = redirect_path;
						
				}); 
				
			}
			else
			{
			    
		
				swal({
					  title: '',
					  text:  data.result.statusWithDetails,
					  type: 'warning',
					}).then(function (result) {
						
					   
						
				});
			    
			}
				
				
			//}
			
		},
		error: function(error){ 
			console.log(error);
			loading.waitMe('hide'); 
		}

	});
	
}
</script>

