<style>
.current_deals
 {
    padding-left: 0px;
    padding-bottom: 2px;
    padding-top: 4px;
    background: #e0138e;
	margin-bottom:5px;
	color:#fff;
    border: solid 1px #cec7c7;
	font-size :16px;
  
}

.current_body
 {
    padding-left: 0px;
    padding-right: 0px;
    padding-bottom: 2px;
    padding-top: 4px;
}



.current_photo_fix
{
    height: 35px;
    overflow: hidden;
}


.img3 {
    display: block;
    height: 100%;
    width:auto;
    margin-top:0px;
}
.text_c{
    padding-bottom:1px !important;
	font-size:13px;
}


.raduis_button
{
        border-radius: 115px;
}
</style>
<style>
.rows {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  width: 100%;
  
}

.column {
  display: flex;
  flex-direction: column;
  flex-basis: 100%;
  flex: 1;
}

.column_one {
  background-color: transparent;
  padding-left:12px;
}

.column_two {
    background-color: transparent;
	margin-left:40px;
}


.button_c{
    margin-right: -1px !important;
	float:right !important;
}

@media (max-width: 1000px) {
	
	.column_two {
		background-color: transparent;
		margin-left:80px;
		}
		
	.text_c{
		padding-bottom:1px !important;
		font-size:12px;
	}
	
	.current_photo_fix
	{
		height: 50px;
		overflow: hidden;
	}
	
	.button_c{
		margin-right: -1px !important;
		float:none !important;
	}
	

}


.column_A_one {
  background-color: transparent;
  padding-left:0px;
}

.column_B_two {
    background-color: transparent;
	padding-left:25px;
}

.clear-space
{
	clear:both;
	border-bottom:1px solid #d9dde2;
	margin-bottom:3px;
	margin-top:3px
}

</style>


<style>
@keyframes placeHolderShimmer_current{
    0%{
        background-position: -468px 0
    }
    100%{
        background-position: 468px 0
    }
}

.animation {
     animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer_current;
    animation-timing-function: linear;
    position: relative;
    overflow: hidden;
}

.animated-background {

    background: #f6f7f8;
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    background-size: 500px 104px;
    height: 100%;
	width : 100%;

}
.cuttent_box
{
	padding-top:20px;
	padding-bottom:20px;
	margin-right:14px;
	margin-left:14px;
	
}
</style>


<script id="current-template" type="text/template">

<div id="1">
	<div class='col-lg-12'>
		<span class='rows'>
		
				<div class='animated-background animation cuttent_box' ></div>
			
		</div>
	</div>
</div>		

</script>



@if(@$current_offer > 0)
	
<div class='current_deals'>
  <div class='rows'>
  
		<div class='column col-lg-8'>
			<div class='row'>
				  <div class='column_one'>
					<span><b><i>Your Current Active Deals</i></b></span>
				  </div>
			</div>
		</div>
		
		<div class='column col-lg-4'>
			<div class='row'>
			  <div class='column_two'>
				<span><b><i>Next Actions</i></b></span>
			  </div>
			</div>
		</div>
	
  </div>
</div>


<div class='current_body'>
	<div class="row">
		<div id='AcceptedofferData2'></div>
	</div>	
</div>

<br>
@endif	



<script>
currentAcceptedOffer();
function currentAcceptedOffer()
{
	
	
	var htmlData2 = '';	
	
	//var menudata = $("#campaign_ss.dropdown-menu li a.hover_active").attr("id");	
	//var group_category = $("#group_category.dropdown-menu li a.hover_active").attr("id");
	
	$.ajax({

		"url": "{{asset('campaign/getdata/currentacceptedoffer')}}",
		"type": 'GET',
		//data: {'menudata':menudata,"_token":$('#token').val(),'group_category':group_category},	
		data: {"_token":$('#token').val()},	
		beforeSend: function() 
		{			
				
				var current = $('#current-template').html();
				$("#AcceptedofferData2").empty().html(current);						
		},	
		success: function(details)
		{
			
		if(details.length > 0 ) {
			
			$.each(details, function( index, value ) 
			{
				
				htmlData2 += AcceptedTemplate(value.campaign_data,value.image_path,value.action,value.action_status,value.action_button);
				
			});
			
			$("#AcceptedofferData2").empty().hide().append(htmlData2).animate({ opacity: "show" }, "slow");
			
		}
		else
		{
			
    				htmlData2 += '<div class="col-sm-12">';
                				htmlData2 += '<div class="bg-gray color-palette">';
                    				htmlData2 += '<h4 class="text-muted well well-sm no-shadow" style="margin-top:2px;margin-bottom:2px;padding:10px">';
                    				htmlData2 += '<center><i class="fa fa-fw fa-ban"></i>no available current deals at the moment. </center>';
                    				htmlData2 +='</h4>';
            			    	htmlData2 +='</div>';
    				htmlData2 +='</div>';
		
			
			$("#AcceptedofferData2").empty().hide().append(htmlData2).animate({ opacity: "show" }, "slow");
			
		}
		
			 
			
			
	
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
 let trimString = function (string, length) {
      return string.length > length ? 
             string.substring(0, length) + '...' :
             string;
    };


function AcceptedTemplate(value,image,action,action_status,action_button)
{
	if(image.length != 0)
	{
		image_path = image[0].image_path;
		//var image_route = "{{ asset('public/offer_images')}}/"+image_path;
		//var image_route = "https://researchsale.com/seller/public/offer_images/"+image_path;
		var image_route = "{{ cdn_asset('offer_images') }}/"+image_path;
	}
	else
	{
		image_path = "default_product.jpg";
		var image_route = "{{ cdn_asset('offer_images') }}/"+image_path;
	}
	
	
	var nn = trimString(value.product_name, 58);
	
	var template2 = 
	`<div id="${value.id}">
		<div class='col-lg-12'>
			<span class='rows'>
			
					<div class='column col-lg-8'>
						<div class='row'>
							  <div class='column_A_one'>
								
									<div class="col-md-2">
										<div class='current_photo_fix'><img class="img3  img-responsive" src="${image_route}" alt="user image"></div>
									</div>
									<div class='col-md-10'>
										<h5 class='text_c'>${nn} <a style='font-size:13px' data-id="${value.id}" href="${value.link}#step-1">view details</a></h5> 
									</div>
									
							  </div>
						</div>
					</div>
					
					<div class='column col-lg-4'>
					
					
						<div class='row'>
						  <div class='column_B_two'>
						  
									<div class="col-md-7 ">
											<h6 class='text_c '>${action_status}</h6>
									</div>
									
									<div class="col-md-5">
										<span>${action_button}</span>
									</div>
									
						  </div>
						</div>
					</div>
					
				
			</span>
			<div class='col-lg-12'>
				<div class="clear-space"></div>
			</div>
		</div>
	
	</div>`
	return template2;
} 

</script>