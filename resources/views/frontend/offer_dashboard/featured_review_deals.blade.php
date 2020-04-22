<style>
.STRIKETHROUGH {
    text-decoration: line-through;
    color: #bfbcbc;
}

.featured_deals
 {
    padding-left: 12px;
    padding-bottom: 2px;
    padding-top: 4px;
    background: #3c8dbc;
	color:#fff;
    border: solid 1px #cec7c7;
	font-size :24px;
  
}


.featured_body
 {
    padding-left: 12px;
	padding-right: 12px;
    padding-bottom: 2px;
    padding-top: 4px;
  
}
</style>



<style>
.text_c {
  display: inline-block;
  vertical-align: middle;
  line-height: normal;
  margin-top:10px;
}

.button_c
{
	margin-top:10px;
	margin-right:10px;
}

.chat-box-main {
  max-height: 100px;
   max-height: 100px;
 

}

	
.fixphoto
{
	max-height: 100px;

   overflow: hidden;

}

.fix_text
{
	max-height: 10px;
   overflow: hidden;
}

.photo_fix
{
	height: 247px;
    width: 100%;
	overflow: hidden;
	background-color:none;
	margin-bottom:14px;
}


@media (max-width: 1000px) {
	 .photo_fix
	{
		height: auto;
		width: 45%;
		overflow: hidden;
		background-color:none;
		margin-bottom:14px;
	}

}



.text_fix
{

	min-height: 75px;
	max-height: 75px;
	height : 75px;
	overflow: hidden;
	background-color:none;
	margin-bottom:8px;
}


span.text_fix_mod {
	font-size: 11px !important;
	padding-left: 3px !important;
	padding-right: 3px !important;
   line-height: 1% !important;
}



.title_fix
{

	min-height: 60px;
	max-height: 60px;
	background-color:none;
	overflow : hidden;
	margin-bottom:8px;
}
span.title_fix_mod {
	 font-weight: bold;
	font-family: "Amazon Ember",Arial,sans-serif !important; 
	font-size: 18px !important;
	padding-left: 3px !important;
	padding-right: 3px !important;
   line-height: 1.5% !important;

}
.featured-box .title_fix, .featured-box .featured-box-price{
    padding-left:10px;
    padding-right:10px;
}
.featured-box .photo_fix .img-responsive{
    height: 100%;
    width: 100%;
}


</style>


<style>
.product_desc2
{
	font-size:11px !important;
	padding-left:3px !important;
	padding-right:3px !important;
	 line-height: 1.2;
}
.product_name2
{
	font-size:14px !important;
	padding-left:3px !important;
	padding-right:3px !important;
	 line-height: 1.2;
	 font-weight:bold;
}


</style>



@if(@$featured_offer > 0)
<div class="featured_deals">
	<div class="row">
		<div class="col-md-12">
			<span><b><i>Choose a deal to review below</i></b></span>			
		</div>
	</div>
</div>

<div class='featured_body'>
	<div class="row">
		<div id='offerData2'></div>
	</div>
</div>
@endif	


<!--// div view details modal -->
@include('frontend.offer_dashboard.view_details_modal.product_details')  
<!--  ~end view details modal -->

<!--// div how does work modal -->
	@include('frontend.offer_dashboard.animated_placeholder')  
<!--  ~end how does work modal -->

<script>
GetOfferData();

function GetOfferData()
{

	var htmlData = '';	
	var menudata = $("#campaign_ss.dropdown-menu li a.hover_active").attr("id");
	var group_category = $("#group_category.dropdown-menu li a.hover_active").attr("id");
	
	/*
	if(menudata == '')
	{
		var label = 'All Campaign'
	}
	else
	{
		var label = menudata.capitalize();
	}
	*/
	
	//$("#display_selected").empty().html(label);
	
	$.ajax({

		"url": "{{asset('campaign/getdata/featured_offer')}}",
		"type": 'GET',
		//data: {'menudata':menudata,"_token":$('#token').val(),'group_category':group_category},	
		data: {"_token":$('#token').val()},	
		beforeSend: function() 
		{			
				
				var featured = $('#featured-template').html();
				$("#offerData2").empty().html(featured);	
		},	
		success: function(details)
		{
			
			if(details.length > 0 ) 
			{
				
				
				$.each(details, function( index, value ) 
				{
					
					 htmlData += currentOfferTemplate(value.campaign_data,value.image_path,value.schedule_offer,value.product_price_data,value.offer_data,value.offer_available);
					
				
				});
				
			}
			else
			{
				
		
				htmlData += '<div class="row">';
				htmlData += '<div class="col-lg-12">';
				htmlData += '<div style="padding-right:4px;padding-left:4px"">';
				htmlData += '<div class="bg-gray color-palette">';
				htmlData += '<h4 class="text-muted well well-sm no-shadow" style="margin-top:2px;margin-bottom:2px;padding:10px">';
				htmlData += '<center><i class="fa fa-fw fa-ban"></i>no available featured deals at the moment. </center>';
				htmlData +='</h4>';
				htmlData +='</div>';
				htmlData +='</div>';
				htmlData +='</div>';
				htmlData +='</div>';

			
			}
		
			 
			$("#offerData2").empty().hide().append(htmlData).animate({ opacity: "show" }, "slow");
			
	
		},
		error: function (jqXHR, exception) 
		{
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} 
				else if (jqXHR.status == 401) {
					msg = jqXHR.responseText;
				} 
				else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
			   
				alert(msg);
		},
		
	});
}
</script>


<script>

function currentOfferTemplate(value,image,schedule_offer,product_price_data,offer_data,offer_available)
{
	var image_path = '';
	var imageDiv = '';
	var Status_msg ="";
	var discount_html= "";
	var spot = "";
	
	if(image.length != 0)
	{
		image_path = image.image_path;
		var image_route = "{{ cdn_asset('offer_images') }}/"+image_path;
	}
	else
	{
		image_path = "default_product.jpg";
		var image_route = "{{ cdn_asset('offer_images') }}/"+image_path;
	}
	
	
	
	
	if(offer_available.status == "AVAILABLE")
	{
	    spot = offer_available.available_spots;
	}
	else if(offer_available.status == "CLOSED")
	{
	    spot = offer_available.status;
	}
	
	
	if(value.new_product_price != null)
	{
		
		var new_price = value.new_product_price;
		var new_discount = value.new_product_discount;
		var original_price = parseFloat(new_price).toFixed(2);
		
		
		if (new_discount != "") 
		{
			
			if(value.new_product_discount_label == "Percentage")
			{
				var discount_percent = parseFloat(new_discount) / 100;
				var discount_price = new_price * parseFloat(discount_percent).toFixed(2);
				var final_price2 = new_price - parseFloat(discount_price).toFixed(2);
				var final_price =  parseFloat(final_price2).toFixed(2);
			}
			else if(value.new_product_discount_label == "Dollar")
			{
				var discounted_price_dollor = (parseFloat(new_price).toFixed(2) - parseFloat(new_discount).toFixed(2));
				var final_price2 =  parseFloat(discounted_price_dollor).toFixed(2);
				var final_price =  parseFloat(final_price2).toFixed(2);
			}
		}
		else
		{
			var final_price2 = new_price;
			var final_price =  parseFloat(final_price2).toFixed(2);
		}
		
		
	
		if (Number(new_discount) != 0 ) 
		{
			discount_html +=	'<span><span style="color:red;font-size:12px" class="STRIKETHROUGH">$'+original_price+'</span></span>';
		}
	
	}
	
	var template = '';

	template = 
       `<div id="${value.id}">
       
    		<div class="col-md-3">
    			<div class="fancybox thumbnail featured-box" >
				
					<center>
						<div class='photo_fix'>
							<a href="javascript:void(0)"  class="view_details_disabled" data-id="${value.id}" >
								<img class="img-responsive" alt="" src="${image_route}" object-fit: contain>
							</a>	
						</div>
					</center>
					<div class='title_fix' style='margin-bottom:6px;'><span class='title_fix_mod'> {{ str_limit('${value.product_name}', 55) }}</span></div>
					
				
					<hr style="margin-top: 3px;margin-bottom: 3px;">
					<div class="featured-box-price"> <span>Available Slots</span> <span class="pull-right badge bg-grey" style="background-color:orange; font-weight: 200;">${spot}</span> </div>
					
					
					<hr style="margin-top: 3px;margin-bottom: 3px;">
					
					<div class="featured-box-price"><span>Purchase Price:</span> <span class='product_price pull-right'><strong>${discount_html}  $${final_price}</strong></span></div>
					<hr style="margin-top: 3px;margin-bottom: 3px;">
					
					<div class="featured-box-price"><span>Cashback Rebate:</span>  <span class='pull-right'> $${product_price_data.get_paid}</span> </div>
					<hr style="margin-top: 3px;margin-bottom: 3px;">
					
				
					
					<div class="featured-box-price"  ><span><a href="javascript:void(0)" id="how">How does this work?</a></span></div>
					
					 <a href="{{asset('campaign/getdata/productdetails/${value.id}')}}"  style="width:100%;margin-top:8px;margin-bottom:4px;width:100%"  class="btn btn-default btn-flat">View Details</a>
					
					<!-- <a href="javascript:void(0)" style="width:100%;margin-top:8px;margin-bottom:4px;"  class="btn btn-default btn-flat view_details" data-id="${value.id}" >View Details</a> --> 
					
    			</div>
    		</div>
			
       </div>`
	   
	return template;
	
}
</script>