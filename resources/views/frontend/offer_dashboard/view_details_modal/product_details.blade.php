<style>
@media (min-width: 1200px){

	#showInfopreview > .modal-lg {
		width: 1135px !important; 
	}
}

@media (min-width: 992px){
	.p-lg-5 {
		padding: 3.125rem!important;
	}
}

.STRIKETHROUGH {
    text-decoration: line-through;
    color: #bfbcbc;
}

@media (min-width: 576px)
.flex-sm-row {
    flex-direction: row!important;
}

.justify-content-between {
    justify-content: space-between!important;
}

.mb-2-5, .my-2-5 {
    margin-bottom: 1.5625rem!important;
}

.align-items-start {
    align-items: flex-start!important;
}
.justify-content-between {
    justify-content: space-between!important;
}

.mr-1, .mx-1 {
    margin-right: .625rem!important;
}


.text-dark {
    color: #333e48!important;
}

.mb-1-5, .my-1-5 {
    margin-bottom: .9375rem!important;
}
.mb-0, .my-0 {
    margin-bottom: 0!important;
}

.mb-3, .my-3 {
    margin-bottom: 1.875rem!important;
}

.lato-medium {
    font-size: 15px;
}


.campaign-single .percent {
    font-size: 15px;
    text-transform: uppercase;
    border-radius: .1875rem;
    border: none;
    padding: .1875rem .3125rem;
    white-space: nowrap;
}


.modal-campaign .modal-footer, .modal-campaign .modal-header {
    border-width: 0;
}

.p-0 {
    padding: 0!important;
}

.mt-3, .my-3 {
    margin-top:50px !important;
}

.modal-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 1.5rem;
    border-top: 1px solid #c8ced3;
    border-bottom-right-radius: .3rem;
    border-bottom-left-radius: .3rem;
}


.pb-2-5, .py-2-5 {
    padding-bottom: 1.5625rem!important;
}

.pt-2-5, .py-2-5 {
    padding-top: 1.5625rem!important;
}
.w-100 {
    width: 100%!important;
}
.border-top {
    border-top: 1px solid #c8ced3!important;
}

.modal-campaign .modal-footer, .modal-campaign .modal-header {
    border-width: 0;
}

.p-0 {
    padding: 0!important;
}

.modal_campaign.modal-description.collapsed .show-description, .modal-campaign .modal-description .hide-description {
    display: block;
}

.modal_campaign .modal-description .show-description {
    display: none;
}

.modal_campaign .modal-description.collapsed .hide-description {
    display: none;
}

.modal_campaign .modal-description.collapsed .show-description, .modal_campaign .modal-description .hide-description {
    display: block;
}

</style>

<style>
object{
	display: flex;
    flex-direction: column;
    min-height: 390px;
	width:100%
	clear:both;
}
</style>


<style>
.campaign-title
{
font-size : 20px;
font-weight: 400;
}
</style>



<div id="showInfopreview" class="modal fade "  tabindex="-1" role="dialog"   aria-modal="true" >
	<div class="modal_campaign modal-dialog modal-lg">
		<div class="modal-content">
			<div id="campaign-44322" class="campaign-container campaign-single">

			   <div class="modal-header d-flex justify-content-end pt-0-5 pb-0">
					<div class="mt-1-5 mr-6 mb-0 social d-flex align-items-center"></div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				
				
				<div class="modal-body p-lg-5" id="showinfo_mb123">
				
				</div>
				
				<div class="modal-footer p-0" id='show_footer'></div>

			</div>

		</div>
	</div>
</div>

<script>
$(document).on("click", ".view_details", function(){

$("#photo_image").empty();
$("#showinfo_mb123").empty();
	
var id = $(this).data("id");	
$("#showInfopreview").modal("show");

	var htmlxx = '';
	var footer = '';
	$("#showinfo_mb123").empty().html('<div style="height:390px;padding-top:70px"><center><img  src="{{ asset('public/azmproject_images')}}/loading5.gif"/></center></div>');
   
		


	$.post("{{asset('get/product/info')}}", {id:id,"_token":$('#token').val()}, function(data){	
		
		htmlxx = viewData2(data.campaign_info[0],data.campaign_info.confirmButton);
		
		$("#showinfo_mb123").empty().hide().append(htmlxx).animate({ opacity: "show" }, "slow");
		
		$("#photo_image").empty().html('<object id="myobject2" data="{{asset("get/product_detail/modal")}}/'+id+'"   width="100%" overflow="auto" max-height="390px"  standby="loading" />');
		
		
	});		
	
	
 
});    
</script>

<script>
function viewData2(value,confirmButton)
{

    	var discount_html= "";


	
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
			discount_html +=	'<span><span style="color:red;font-size:17px" class="STRIKETHROUGH">$'+original_price+'</span></span>';
		}
	
	}
	

var templatex = 
`<div>

		<div class="row">
			<div class="col-md-6">
				<div id='photo_image'> LOADING IMAGE ..... </div>
			</div>
			
			<div class="col-md-6">
				<div class="prod-description col  mt-xl-0 pl-xl-3">
				
						<p class="campaign-title mb-3 roboto-medium">${value.product_name} </p>
						
						<div class="d-flex justify-content-between align-items-start mb-2-5">
							<div>
								<div class="d-flex align-items-center lato-medium">
									<!--
									<div class="percent bg-red color-palette text-white mr-1 mb-1">
										Rebate:
										<span class="discount text-white">%</span>
									</div>
									-->
									<h4 class="old-price lato-medium">
										<del></del>
									</h4>
								</div>
								<h4 class="new-price text-green roboto-black h1 mb-0">
									<span> ${discount_html}   $${final_price}</span>
								</h4>
							</div>
						
							<div class="lato-medium">
								
								
							
								<p class="mb-0 text-dark d-flex justify-content-between">
									<i class="sprite-icon-piggy-bank mr-0-5 mr-md-1-5"></i> 
									
								</p>
								
								<p class="mb-0 text-dark d-flex justify-content-between">
									
								</p>
								
								
							</div>

						</div>
						
						<div class="d-flex justify-content-between flex-column flex-sm-row mb-2-5"></div>
						
						<div>${confirmButton}</div>
						
						
																														
				</div>
			</div>
		</div>
			
			
		<div class="row">
			<div class="col-sm-12">
				<div id="description" class="mt-3 description collapse">
					
				</div>
			</div>
		</div>


</div>`
return templatex;
	
}
</script>






<script type="text/javascript">
var loading ="";
$(document).on('click', '.getcampaign', function(e){
e.preventDefault();
var offer_id = $(this).data("campaign_id");

$.ajax({

	url: "{{route('getCampaignofferschedule')}}",
	type: 'POST',
	data: {offer_id:offer_id,"_token":$('#token').val()},
	dataType: 'json',
	beforeSend: function() {

				loading = $("body").waitMe({
					effect: 'timer',
					text: 'please wait ........',
					bg: 'rgba(255,255,255,0.90)',
					color: '#555'
				}); 
			
	},	
	success: function(result)
	{
		
		
			
		var dtx = [];

		if(result.data.length > 0)
		{
			$.each( result.data, function( key, value ) {
				$.each(value.time, function( key, data )
				{
					if(data.status == "available")
					{
						
						var dd = data.schedule_time.split(" ");
						var dateTime = { val_date: dd[0], val_time:dd[1] };

						
						loading.waitMe('hide');
						
						
						$.ajax({
							url: "{{route('getDateConfirmToday')}}",
							type: 'POST',
							data: {offer_id:offer_id,"_token":$('#token').val(),select_schdule:dateTime,val_date:dateTime.val_date,val_time:dateTime.val_time},
							dataType: 'json',
							beforeSend: function() {},	
							success: function(data)
							{
						
								if(data.result == "save")
								{
									 swal({
										  title: 'Congratulations',
										  text:  "you got this campaign,please proceed",
										  type: 'success',
										}).then(function () {
											window.location.href = data.url;
										});
								}
								else if(data.result == "no_schedule_available")
								{
									swal({  title: 'No Schedule Available', text:  "", type: 'warning'});
								}
								else
								{
									swal({  title: 'please report this campaign', text:  "", type: 'warning'});
								}
									
									
							},
							error: function(error){ 
								loading.waitMe('hide');
								console.log(error);
							}
							
						});

						
					
					
						return false;
					
					}
					
				});
			}); 
		}
		
	},
	error: function(error){ 
		loading.waitMe('hide');
		console.log(error);

	}
	
});
	

	return false;


});
</script>