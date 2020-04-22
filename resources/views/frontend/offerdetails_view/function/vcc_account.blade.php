<script>
function check_and_pay_user_forpurchasedproduct()
{
	

	
	var checkifuserhaveVcc = $.xResponse("{{route('checkifuserhaveVcc')}}",{"_token":$('#token').val()});
	
	


	if(checkifuserhaveVcc == "noaccount")
	{	
		// create new Vcc account
		UsercreateNewAccountVcc();
		
	}
	else 
	{
		//get information of existing  Vcc Account
		get_existing_accountandCardID();
	} 

	
	
	
}	
</script>

<script>
var loading = "";

function UsercreateNewAccountVcc()
{

	const inputvalue = { 
		"fname"   : "{{Auth::user()->name}}",				  
		"lname"   : "", 			  
		"strt"    : "Street",				  
		"city"    : "CITY",				 
		"state"   : "AL",				  
		"zip"	  : "9002",				  
		"amount"  : 1			
	};
	
	
	$.ajax({		
		url: "https://fncc.herokuapp.com/api/runmanualgen",		
		type: 'POST',		
		data: inputvalue,
		beforeSend: function() {
		
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Creating your virtual account.....',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
			
		},		
		success: function(data){
			
			console.log(data);
			
		
			var array = JSON.parse(data);
			if(data.length > 0)	
			{				
					
				var createUserVirtualcc = $.xResponse("{{route('createUserVirtualcc')}}",{'cc_id':array["cardID"],'virtual_amount':array["amount"],"_token":$('#token').val()});	
				if(createUserVirtualcc == "success")
				{	
					loading.waitMe('hide');
					User_getAccountiformation(array["cardID"]);
				}
				
			
			}		
		},		
		error: function(error){ 			
		console.log(error);		
		}	
	});
	
	

	
}
</script>


<script>

function get_existing_accountandCardID()
{
	
	var CardID = $.xResponse("{{route('getCardID')}}",{"_token":$('#token').val()});
	User_getAccountiformation(CardID);
}
</script>

<script>
function User_getAccountiformation(CardID)
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
			
		
			
			proceed_to_payment_and_update_Vcc(spend.amount,CardID);
			
		},		
		error: function(error){ 			
		console.log(error);		
		}	
	});
}
</script>

<script>
function proceed_to_payment_and_update_Vcc(existing_amount,CardID)
{



	
	var rebate_amount = $.xResponse("{{route('get_amount_tracking_price')}}",{offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()});
	
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
				var savinghistorypay =  $.xResponse("{{route('saving_virtualcc_historypay')}}",{offer_id:"{{$offerdetails[0]->id}}","pay_method":"purchased_product","_token":$('#token').val(),'rebate_amount':rebate_amount,"cc_id":CardID,'total_amount':spend.amount});	
					
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


</script>


