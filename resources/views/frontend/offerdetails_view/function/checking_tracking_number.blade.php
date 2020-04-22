<script>
function checking_tracking_number()
{

		$.ajax({
		url: "{{asset('checking_tracking_number')}}",
		type: 'post',
		data: {offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()},
		dataType: 'json',
		success: function(data)
		{		
				console.log(data);
				if(data.length > 0)
				{
					
					
					
					$('#saveTrackingnumber').val(data[0].tracking_number);
					$('#shipment_company').val(data[0].shipment_company);
					//$('#canceloffer').removeClass('hidebutton').addClass('hidebutton');	
					
				
				
					
					if(data[0].remarks == "Delivered" || data[0].remarks == "delivered")
					{
						var result = "";		
						result += 	'<div class="form-group has-feedback">';
						result +=		'<div class="col-lg-12">';	
						result +=			'<div class="callout callout-warning">';
						result +=				'<h4>Status: '+data[0].remarks+'</h4>';
						result +=				'<span>'+data[0].statusWithDetails+'<span><br>'
						result +=			'</div>';
						result +=		'</div>';
						result +=	'</div>';	
						
						update_status_tracking_number(data[0].remarks,data[0].statusWithDetails);
						//$('#results').html('');
						//$('#results').html(result);
						
					}
					else
					{
						// Get Status tracking number
						GetTrackingStatus(data[0].tracking_number,data[0].shipment_company);	
						
					}
					
											

				}			
				else
				{
					$('#canceloffer').css('display','inline');
				}
			
			
		},
		error: function(error){ 
			console.log(error);
		}

	});
}
</script>

<script>
function GetTrackingStatus(tracking_number,shipment_company)
{
	
	if(shipment_company == "FEDEX")
	{		
		checkFedex(tracking_number);

	}
	else if(shipment_company == "USPS")
	{		
		getUSPS(tracking_number);
	}
	else
	{	
		getShipmentStatus(tracking_number,shipment_company);
	}
	
}
</script>


<script>
function checkFedex(tracking_number)
{
	
	url='https://www.fedex.com/trackingCal/track?action=trackpackages&data={"TrackPackagesRequest":{"appType":"WTRK","appDeviceType":"DESKTOP","supportHTML":true,"supportCurrentLocation":true,"uniqueKey":"","processingParameters":{},"trackingInfoList":[{"trackNumberInfo":{"trackingNumber":'+tracking_number+',"trackingQualifier":"","trackingCarrier":""}}]}}';
	
	$.ajax({
			url:url,
			dataType : 	"JSON",
            type: "POST",
			beforeSend: function() {
			
			},
            success: function (data) {
				
				
				$('#results').html('');
				
				
				var moreinfo = data.TrackPackagesResponse.packageList;
				
				console.log(moreinfo);
				
				console.log(data.TrackPackagesResponse.successful);
				
			
				var status = moreinfo[0].keyStatus;
				var statusWithDetails = moreinfo[0].statusWithDetails;
				var isDelivered = moreinfo[0].isDelivered;
			
				if(statusWithDetails === "In transit")
				{
					statusWithDetails = "This tracking number cannot be found, please check the number or contact the sender.";
				} 
				
				if(data.TrackPackagesResponse.successful == false )
				{
					var status = "Not found";
					var statusWithDetails = "This tracking number cannot be found, please check the number or contact the sender.";
				}
				
			
				var result = "";		
				result += 	'<div class="form-group has-feedback">';
				result +=		'<div class="col-lg-12">';	
				result +=			'<div class="callout callout-warning">';
				result +=				'<h4>Status: '+status+'</h4>';
				result +=				'<span>'+statusWithDetails+'<span><br>'
				result +=			'</div>';
				result +=		'</div>';
				result +=	'</div>';	
				
				update_status_tracking_number(status,statusWithDetails);
				
				//$('#results').html('');
				//$('#results').html(result);
				
              
            },
            error: function (data) {
				//loading.waitMe('hide');
                alert("ERROR - " + data.responseText);
            }
    });
}


function getUSPS(tracking_number)
{
	var result ='';
	
		$.ajax({
			url:"{{asset('')}}shipment_status/scrap_trackingnumber.php",
			data : {tracking_number:tracking_number},
			dataType : 	"JSON",
            type: "POST",
			beforeSend: function() {
			
			},
            success: function (data) {
				
				
				console.log(data);
				
				
				
				var status = data[0].text_explanation;
				var statusWithDetails = data[0].delivery_status;
				var isDelivered = '';
				
				
				if(data.status == "unknown")
				{
					var status = 'Not Found!';
					var statusWithDetails = 'This tracking number cannot be found, please check the number or contact the sender.';
					var isDelivered = data.isDelivered;
				}
				
		
				$('#results').html('');
				
				var result = "";
				result += 	'<div class="form-group has-feedback">';
				result +=		'<div class="col-lg-12">';	
				result +=			'<div class="callout callout-warning">';
				result +=				'<h4>Status: '+status+'</h4>';
				result +=				'<span>'+statusWithDetails+'<span><br>'
				result +=				'<span>'+isDelivered+'<span><br>';
				result +=			'</div>';
				result +=		'</div>';
				result +=	'</div>';	

				update_status_tracking_number(status,statusWithDetails);
				
				//$('#results').html('');
				//$('#results').html(result); 
				
				
              
            },
            error: function (data) {
				//loading.waitMe('hide');
                alert("ERROR - " + data.responseText);
            }
    });
}



function getShipmentStatus(tracking_number,shipment_company)
{
	var result ='';
	
		$.ajax({
			url:"{{asset('')}}shipment_status/getStatus.php",
			data : {tracking_number:tracking_number,shipment_company:shipment_company},
			dataType : 	"JSON",
            type: "POST",
			beforeSend: function() {
			
			},
            success: function (data) {
				
				
				console.log(data);
				var status = data.status;
				var statusWithDetails = data.description;
				var isDelivered = data.isDelivered;
				
				
				if(data.status == "unknown")
				{
					var status = 'Not Found!';
					var statusWithDetails = 'This tracking number cannot be found, please check the number or contact the sender.';
					var isDelivered = data.isDelivered;
				}
				
		
				$('#results').html('');
				
				var result = "";
				result += 	'<div class="form-group has-feedback">';
				result +=		'<div class="col-lg-12">';	
				result +=			'<div class="callout callout-warning">';
				result +=				'<h4>Status: '+status+'</h4>';
				result +=				'<span>'+statusWithDetails+'<span><br>'
				result +=				'<span>'+isDelivered+'<span><br>';
				result +=			'</div>';
				result +=		'</div>';
				result +=	'</div>';	
				
				
				update_status_tracking_number(status,statusWithDetails);

					
				//$('#results').html('');
				//$('#results').html(result);
				
              
            },
            error: function (data) {
				//loading.waitMe('hide');
                alert("ERROR - " + data.responseText);
            }
    });
}
</script>


<script>
function update_status_tracking_number(status,statusWithDetails)
{

	$('#div_schedule').html('');
	$.ajax({
			url: "{{asset('update_status_tracking_number')}}",
			data: {offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val(),'remarks':status,'statusWithDetails':statusWithDetails},
			dataType : 	"JSON",
            type: "POST",
            success: function (data) {
				
				console.log(status);
				if(status == "Delivered" || status == "delivered")
				{
					$('#saveTrackingnumber').prop('readonly', true);
					$('#shipment_company').prop('disabled', true);
					$('#canceloffer').removeClass('showbutton').addClass('hidebutton');	
				
					check_and_showActiveschedule();
					checkifuser_alreadypaidforpurchasedproduct(); // proceed for paymet user
					
				}
				else
				{
					$('#saveTrackingnumber').prop('disabled', false);
					$('#shipment_company').prop('readonly', false);
					$('#secondnextbutton').removeClass('showbutton').addClass('hidebutton');
					$('#canceloffer').removeClass('showbutton').addClass('hidebutton');						
				}
				
			
            },
            error: function (data) {
				//loading.waitMe('hide');
                alert("ERROR - " + data.responseText);
            }
    });
	
} 
</script>



<script>
function checkifuser_alreadypaidforpurchasedproduct()
{
	
	var result =  $.xResponse("{{route('checkifuser_alreadypaidforpurchasedproduct')}}",{offer_id:"{{$offerdetails[0]->id}}","pay_method":"purchased_product","_token":$('#token').val()});
	
	

	if(result == "notyet_paid")
	{
		check_and_pay_user_forpurchasedproduct(); // proceed for payment user;
		
	}
}

</script>



<script>
function check_and_showActiveschedule()
{
	
	return false;
	
	//check first if we have record on purchase survey
 	var xDataresult = $.xResponse("{{asset('checkifallreadyansweredsurvey')}}", {offerid:"{{$offerdetails[0]->id}}","_token":$('#token').val()} );
	

		
	var msg = '';  
	$.ajax({
			url: "{{asset('GetStatusDateAvailable')}}",
			data: {offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()},
			dataType : 	"JSON",
            type: "post",
            success: function (data) 
			{
				console.log(data[0].active_survey_date);
				
				var dateavailble = new Date(data[0].active_survey_date);		
				JSDate.Init(dateavailble);
				human_date = JSDate.HumanDate(); // Convert Timestamp as 
				
				var datenew = data[0].active_survey_date;
				var otherdate = new Date(datenew);
				var today = new Date();
				var Available = (today >= otherdate);
				
				
				
				
				if(Available == true)
				{
					$('#thirdstep').addClass('done');
					ifcursor_is_inStep3(); // if the page is in the step 3 remove class done to fix issue on css
					
					
					$('#secondnextbutton').removeClass('hidebutton').addClass('showbutton');
					msg = "Product Review is active please proceed to next step ";
					
					
					
				}
				else
				{
					msg = "Product Review will be availble on "+human_date; 
				}				
				
				var result = "";	
				result += 	'<div class="col-lg-12">';
				result += 	'<div class="alert alert-info alert-dismissible">';
				result += 	'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
				result += 	'<h4><i class="fa fa-fw fa-info-circle"></i>'+msg+'</h4>';
				result += 	'</div>';
				result += 	'</div>';
				
				$('#div_schedule').html('');
				$('#div_schedule').html(result);
				
				
            },
            error: function (data) {
				//loading.waitMe('hide');
                alert("ERROR - " + data.responseText);
            }
    });
	
}
</script>