<script>
function return_product_checking_tracking_number()
{

		$.ajax({
		url: "{{asset('return_product_checking_tracking_number')}}",
		type: 'post',
		data: {offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()},
		dataType: 'json',
		success: function(data)
		{		
				console.log(data);
				if(data.length > 0)
				{
					
					
					
					$('#saveTrackingnumber_return').val(data[0].tracking_number);
					$('#shipment_company_return').val(data[0].shipment_company);
					
					if(data[0].remarks == "Delivered" || data[0].remarks == "delivered")
					{
						/* 
						var result = "";		
						result += 	'<div class="form-group has-feedback">';
						result +=		'<div class="col-lg-12">';	
						result +=			'<div class="callout callout-warning">';
						result +=				'<h4>Status: '+data[0].remarks+'</h4>';
						result +=				'<span>'+data[0].statusWithDetails+'<span><br>'
						result +=			'</div>';
						result +=		'</div>';
						result +=	'</div>';	
						
						$('#return_results').html('');
						$('#return_results').html(result); 
						*/
						
						$('#remarks_return').empty().html(data[0].remarks);
						$('#status_return').empty().html(data[0].statusWithDetails);
						
						
					
						
						shipmentDatareturn();
						
					}
					
					

				}			
				else			
				{	
					$('#canceloffer').addClass('showbutton');							
				}
			
			
		},
		error: function(error){ 
			console.log(error);
		}

	});
}
</script>

<script>
function return_GetTrackingStatus(tracking_number,shipment_company)
{
	
	if(shipment_company == "FEDEX")
	{		
		return_checkFedex(tracking_number);
	}
	else if(shipment_company == "USPS")
	{		
		return_getUSPS(tracking_number);
	}
	else
	{	
		return_getShipmentStatus(tracking_number,shipment_company);
	}
	
}
</script>


<script>
function return_checkFedex(tracking_number)
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
				
				return_update_status_tracking_number(status,statusWithDetails);
				$('#return_results').html('');
				$('#return_results').html(result);
				
              
            },
            error: function (data) {
				//loading.waitMe('hide');
                alert("ERROR - " + data.responseText);
            }
    });
}


function return_getUSPS(tracking_number)
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
				
		
				$('#return_results').html('');
				
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

				return_update_status_tracking_number(status,statusWithDetails);	
				$('#return_results').html('');
				$('#return_results').html(result); 
				
				
              
            },
            error: function (data) {
				//loading.waitMe('hide');
                alert("ERROR - " + data.responseText);
            }
    });
}



function return_getShipmentStatus(tracking_number,shipment_company)
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
				
		
				$('#return_results').html('');
				
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
				
				
				return_update_status_tracking_number(status,statusWithDetails);

					
				$('#return_results').html('');
				$('#return_results').html(result);
				
              
            },
            error: function (data) {
				//loading.waitMe('hide');
                alert("ERROR - " + data.responseText);
            }
    });
}
</script>


<script>

function return_update_status_tracking_number(status,statusWithDetails)
{


	$.ajax({
			url: "{{asset('return_update_status_tracking_number')}}",
			data: {offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val(),'remarks':status,'statusWithDetails':statusWithDetails},
			dataType : 	"JSON",
            type: "POST",
            success: function (data) {
				
				console.log(status);
				if(status == "Delivered" || status == "delivered")
				{
					$('#saveTrackingnumber_return').prop('readonly', true);
					$('#shipment_company_return').prop('disabled', true);
				
					//checkifuser_alreadypaidforproductreturn(); // proceed for paymet user
					
						location.reload();
					
				}
				else
				{
					$('#saveTrackingnumber_return').prop('disabled', false);
					$('#shipment_company_return').prop('readonly', false);
				
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

/*
function checkifuser_alreadypaidforproductreturn()
{
	
	var result =  $.xResponse("{{asset('checkifuser_alreadypaidforproductreturn')}}",{offer_id:"{{$offerdetails[0]->id}}","pay_method":"product_return","_token":$('#token').val()});
	
	if(result == "notyet_paid")
	{
		check_and_pay_user_for_returnproduct(); // proceed for payment user;
	}
}
*/
</script>


<script>
/*
function check_and_pay_user_for_returnproduct()
{
	var CardID = $.xResponse("{{route('getCardID')}}",{"_token":$('#token').val()});
	productreturn_User_getAccountiformation(CardID);
}
*/
</script>



<script>
/*
function productreturn_User_getAccountiformation(CardID)
{
	$.ajax({		
		url: "https://fncc.herokuapp.com/api/getinfo",		
		type: 'POST',
		beforeSend: function() {
		
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Updating your virtual account please wait .....',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
			
		},			
		data: {cardid:CardID},	
		success: function(data){
				
				
			var info = $.parseJSON(data);
			var cardimp = info.body;
			var userinfo = info.infos.data;
			var locinfo = info.infos.body;
			var spend = userinfo.spendingLimit;
			console.log(info);
			
		
			
			return_proceed_to_payment_and_update_Vcc(spend.amount,CardID);
			
		},		
		error: function(error){ 			
		console.log(error);		
		}	
	});
}
*/
</script>


<script>
/*
function return_proceed_to_payment_and_update_Vcc(existing_amount,CardID)
{

	var rebate_amount = $.xResponse("{{asset('get_amount_retun_product')}}",{offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()});
	
	
	var existing_amount_new = parseInt(existing_amount);
	var rebate_amount_new = parseInt(rebate_amount);
	var total = (existing_amount_new + rebate_amount_new);
	
	const inputvalue = { 
		cardid	: CardID,
		amount	: parseFloat(total).toFixed(2) // update existing VCC in bento			
	};
	
	
	$.ajax({		
		url: "https://fncc.herokuapp.com/api/updatecard",		
		type: 'POST',		
		data: inputvalue,	
		success: function(data){
			
			//console.log(data);
			//var array = JSON.parse(data);
			//console.log(array.spendingLimit);
			//alert(array['cardID'] + '' + array['amount']);
			
			var info = $.parseJSON(data);
			//var cardimp = info.body;
			//var userinfo = info.infos.data;
			//var locinfo = info.infos.body;
			var spend = info.spendingLimit;
			console.log(spend.amount);
			
			
		
			if(data.length > 0)	
			{				
				loading.waitMe('hide');
				var savinghistorypay =  $.xResponse("{{route('saving_virtualcc_historypay')}}",{offer_id:"{{$offerdetails[0]->id}}","pay_method":"product_return","_token":$('#token').val(),'rebate_amount':rebate_amount,"cc_id":CardID,'total_amount':spend.amount});	
					
				if(savinghistorypay == "success")
				{
						swal({
						  title: 'Virtual CC Updated',
						  text:  "",
						  type: 'success',
						}).then(function (result) {
									
								location.reload();
							
						});
					
				}
				
			}		
		},		
		error: function(error){ 			
		console.log(error);		
		}	
	});
}
*/
</script>