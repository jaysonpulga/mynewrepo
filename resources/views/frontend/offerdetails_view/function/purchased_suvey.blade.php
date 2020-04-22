<script type="text/javascript">
function getPurchasedData()
{
	
		$.ajax({
		url: "{{asset('getpurchasedData')}}",
		type: 'post',
		data: {offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()},
		dataType: 'json',
		success: function(data)
		{
			console.log(data.length);
			if(data.length > 0)
			{
				//$('#thirdstep').addClass('done');
				//$('#secondnextbutton').removeClass('hidebutton').addClass('showbutton');
				//$('#productsurvey').text('Update product survey');
				
				
				$.each(data, function(index) {
					
					//console.log(data[index].answer);
					if(data[index].form == "rating_star")
					{
						$('#star'+data[index].answer+'_'+data[index].questionId).prop('checked',true);
						ratingtstar(data[index].questionId)
					}
					else if(data[index].form == "inputfield")
					{
						
						$("#"+data[index].questionId+".form-control.productsurvey_ans").val(data[index].answer);
						Inputcheck(data[index].questionId);
					}
					else if(data[index].form == "textarea")
					{
						$("#"+data[index].questionId+".form-control.productsurvey_ans").val(data[index].answer);
						textareacheck(data[index].questionId);
					}
					
					
					
					
				});
				
			
			}
	
		},
		error: function(error){ 
			console.log(error);
		}

	});
}
</script>