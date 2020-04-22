<style>
fieldset, label { margin: 0; padding: 0; }


/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 2em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 

.description {
    color: #999;
    font-size: 13px;
}

.headerquestion
{
	font-size:24px;
	font-weight:bold;
}

.highlight
{
    border: 1px solid red !important;
}
</style>
	
<div class="row">
<div class="col-lg-12">
<div style="clear:both;margin-bottom:20px"></div>


<div id="tracking_status" style="padding-top:5px">	
	
	<!--
	<div class="row">
		<div class="form-group">
				<div id='return_results'></div>
		</div> 	
	</div>	
	-->
	
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
					<div class="_57yz _57z0 _5ts1" style='margin: 16px;'>
						<div class="_57y-">
						<p>
							If you are not 100% satisfied with your purchase, you can return the product and get a full refund or exchange the product for another one, be it similar or not. You can return a product for up to 30 days from the date you purchased it. ... Standard Return Policy.
						
							<br>
							<br>
						
							Return product and get&nbsp;<b><span style='font-size:15px;color:blue'>  ${{$fee_return_product}}	</span>
						</p>
						</div>
					</div>
			</div>
		</div>	
	</div>
	
	

	
	<ul class="timeline">
	
	<li>
		<span class='level'>1</span>
		<span class='texthere'>Shipping courier and tracking number</span>
		
		
		
		
		<div class="timediv">
		
			<div class="row">
			
			
						<div class="row">
							<div class="form-group">
								<div id='results'>
									<div class="_585n _5ts1">
										<i alt="Notice" class="_585p img sp_h3TdUYJbNzz sx_174afe"></i>
										<div class="_585r _50f4"><b><p>Thank you for return  your  product you recieved ${{@$fee_return_product}} to your vcc account</p></b></div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="form-group">
								<div class="_57yz _57z0_shipping  _5ts1">
									<div class="_57y-">
										<p style='font-size:17px'><b> <span id='remarks_return'></span> </b></p>
										<p><span id='status_return'></span></p>
									</div>
								</div>
							</div>	
						</div>	
			
				
						<div class="header_question_"> 
							<div class="row">
								<!--  checkbox  check-->
								<div class="col-md-12" style="float:right;margin-right:10px">
									<span style="float:right;clear:both">
										<span class='putcheck_shipment_return'></span>
									</span>
								</div>
							</div>
						</div>
							
							
							
						<div class="content_question123">
							<div id='product_return_form'>
								<div>
									<label for="exampleInputEmail1"><small style="color:red"><i class="fa fa-fw fa-asterisk"></i></small>Select Shipment Company : </label><br>
									<select class="form-control required" id='shipment_company_return' onchange='shipmentDatareturn()'>
										<option value=''>-----</option>
										<option value='FEDEX'>FEDEX</option>
										<option value='UPS'>UPS</option>
										<option value='USPS'>USPS</option>
										<option value='DHLexpress'>DHL Express</option>
									 </select>
								</div>
								<br>
								<div>
									<label  for="exampleInputEmail1"><small style="color:red"><i class="fa fa-fw fa-asterisk"></i></small>Input Tracking Number : </label><br>
									<input  onfocusout="shipmentDatareturn()" type="text" id='saveTrackingnumber_return' class="form-control required" />
								</div>
							</div>
						</div>
							
			
				
			</div>
		
		</div>
	
	</li>
	<li>
		<span class='level_end'></span>
		<span class='end'></span>
	</li>
	
	</ul>


	
</div>

<hr>
<!-- button row -->
	<div class="row pull-right">
		<div class="form-group">
			<div class="col-lg-12">
				<div class="btn-group mr-2 sw-btn-group" role="group">
					<button class="btn btn-default sw-btn-prev showbutton" type="button"><< Previous</button>
					&nbsp;&nbsp;
					<button id="secondnextbutton"class="btn btn-default sw-btn-next hidebutton" type="button">Next >></button> &nbsp;&nbsp;
				</div>
				<button  id='product_return' type="button" class="btn bg-primary"><i class="fa fa-fw fa-save"></i>  Submit</button>	
			</div>	
		</div>	
	</div>
	<!-- /button row -->




</div><!--end 12-->
</div><!--end row-->

@include('frontend.offerdetails_view.function.return_product_check_tracking_number')




<script type="text/javascript">


function  shipmentDatareturn()
{
   var ax = 0;
   var bx = 0;
   
   
   
	var shipment_company_return = $('#shipment_company_return').val();

	if(shipment_company_return != '')
	{
		 ax = 1;
	}
	else
	{
		 ax = 0;
	}
	
	var saveTrackingnumber_return = $('#saveTrackingnumber_return').val();
	
	if(saveTrackingnumber_return != '')
	{

		bx = 1;
	}
	else
	{
		bx = 0;
	}
	
	var cx = parseInt(ax) + parseInt(bx);
	

	
	if(cx == 2)
	{
		$('.putcheck_shipment_return').empty().html('<p style="font-size:25px;color:#38c138"><i class="fa fa-fw fa-check-square-o"></i></p>');
	}
	else
	{
		$('.putcheck_shipment_return').empty();
	}

}
</script>






<script type="text/javascript">

$(document).ready(function()
{
	return_product_checking_tracking_number();
	ifcursor_is_inStep4();
	
});


function ifcursor_is_inStep4()
{
	
	// fixing the issue on step css
	var url = window.location.href;     // Returns full URL
	var parts = url.split("/");
	var last_part = parts[parts.length-1];
	var end = last_part.split("#");
	var step  = end[1];	
	
	
	
	if(step === "step-4")
	{
		$('#fourtstep').removeClass('done');
	} 
	
	
}

</script>

<script>
var loading = "";


$("#product_return").click(function() 
{
	var check = check_return_form_field();
	
	if(check== true)
	{
		
		submit_return_product();
	} 
	
});


function check_return_form_field()
{
	var isFormValid = true;

	$("#product_return_form .required").each(function()
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
</script>


<script>
function submit_return_product()
{
	
	

	var shipment_company = $("#shipment_company_return").val();
	var trucking_number = $("#saveTrackingnumber_return").val();


	$.ajax({
		url: "{{asset('submit_return_product')}}",
		type: 'POST',
		data: {trucking_number:trucking_number,shipment_company:shipment_company,offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
		
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Saving Data .....',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
			
		},
		success: function(data)
		{
			
			if(data.success == "success")
			{
				//loading.waitMe('hide');
				console.log(data);
				
				// submit_purchasesurvey();  // saving purchase survey data
			   // getfirststep();			// get Status of Shipment company
			  // checkifcomplete();        //check status
				
				
				
				loading.waitMe('hide');
				swal({
					  title: 'Save Data Completed!',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
						
					
						location.reload();
						// check the traking status 
						//return_product_checking_tracking_number(); //return_product_checking_tracking_number.blade.php
				}); 
				
				
				
			}
			
		},
		error: function(error){ 
			console.log(error);
			loading.waitMe('hide'); 
		}

	});
	
}

</script>