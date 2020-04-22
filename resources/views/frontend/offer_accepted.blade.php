@extends('frontend.layouts.main')

@section('content')
<style>
.active_button
{
	background-color: #dcdada;
    color: #333;
    border-color: #a7a4a4;
	font-weight: bold;
	
	
}
.notactive {
    background-color: #fffefe;
    color: #0c0c0c;
    border-color: #ddd;
}

.custom_box
{
		border: 1px solid #abaaaa;
	      border-radius: 1px !important;
}


.hover_active {
    background-color: #ddd;
}

.img2 {
    width: 400px !important; 	
}
.description {
    color: #444;
    font-size: 15px !important;
	margin-left:22px;
	margin-top:5px;
}
.create_box
{
	padding-top:15px;
	padding-bottom:15px;
	padding-right:5px;
	padding-left:5px;
	border-bottom: 1px solid #d8d4d4;
	margin:30px;
}

.create_box:first-child {
	border-top: 1px solid #d8d4d4;
}

.tile-bar
{
	font-weight:bold;
	font-size:24px;
}

.title
{
	font-weight:bold;
	font-size:23px;
}


.product_details
{
	font-size:15px;
	color: #4a4141;
	letter-spacing: 0.05em;
	line-height: 25px;
}


.summary_prod
{
	font-size:15px;
	color: #4a4141;
	line-height: 25px;
}

.product_name
{
	font-size:20px;
	font-weight:bold;
}

.STRIKETHROUGH 
{
    text-decoration: line-through;
	color: #a0a0a0; 
}

</style>

<div class="box box-widget custom_box">
	  <div class="box-header with-border">
		
		
		<div class='row'>
			<div class="col-lg-4">
				<span class="pull-left">
					
					<div class="btn-group offerData">
						<a href="{{asset('/dashboard')}}"  id='current' type="button" class="btn btn-default  notactive"><i class="fa fa-fw fa-list-alt"></i> Current Offer</a>
						<a href="{{asset('/dashboard/acceptedoffer')}}"  id='accepts' type="button" class="btn btn-default active_button"><i class="fa fa-fw fa-calendar-check-o"></i> Accepts Offer</a>
					</div>					

				</span>
			</div>
			<div class="col-lg-8">
			
				
				<span class="pull-right">
				
					<span style='display:inline;margin-right:30px'>
						<span style='margin-top:-10px;padding-right:10px'>Filter By</span>	
						<div class="btn-group dropdown">
							  <a href="javascript:void(0);" class="btn btn-default btn-flat maindropdown" data-toggle="dropdown" aria-expanded="false">All Listing</a>
							   <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<span class="caret"></span>
							  </button>
							
							<ul id='group_category' class="dropdown-menu" role="menu">
							
								<li><a id="" href="javascript:void(0);" class='hover_active'>All Category</a></li>
								<li><a id="Clothing,Shoes & Accessories" href="javascript:void(0);">Clothing,Shoes & Accessories</a></li>
								<li><a id="Toys & Games" href="javascript:void(0);">Toys & Games</a></li>
								<li><a id="Garden & Outdoors" href="javascript:void(0);">Garden & Outdoors</a></li>
								<li><a id="Tools,Home & Improvement" href="javascript:void(0);">Tools,Home & Improvement</a></li>
								<li><a id="Health & Household" href="javascript:void(0);">Health & Household</a></li>
								<li><a id="Baby Care" href="javascript:void(0);">Baby Care</a></li>
								<li><a id="Sports & Outdoors" href="javascript:void(0);">Sports & Outdoors</a></li>
								
							</ul>
						  
						
						 </div> 
					</span>
					
								
					<span style='display:inline'>
						<span style='margin-top:-10px;padding-right:10px'>Sort By</span>	
						<div class="btn-group dropdown">
							  <a href="javascript:void(0);" class="btn btn-default btn-flat maindropdown" data-toggle="dropdown" aria-expanded="false">All Listing</a>
							   <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<span class="caret"></span>
							  </button>
								
									 <ul id='campaign_ss' class="dropdown-menu" role="menu">
										<li><a id="" href="javascript:void(0);" class='hover_active'>All Listing</a></li>
										<li class="divider"></li>
										<li><a id="insight campaign" href="javascript:void(0);">Insight Campaign</a></li>
										<li><a id="fullbuy campaign" href="javascript:void(0);">Fullbuy Campaign</a></li>
										<li class="divider"></li>
										<li><a id="addtocart campaign" href="javascript:void(0);">Add To Cart Campaign</a></li>
										<li><a id="compare campaign" href="javascript:void(0);">Compare Campaign</a></li>
									  </ul>
							
						 </div> 
					</span>
				
				</span>
					
			</div>
		</div>
		
	</div>
	  
	  
	
	  
	  
	  <div class="box-body">
	  
	  
	   <div style='margin-left:35px'>
			<h4> Display : <span id='display_selected'></span> </h4>
		</div>

		<div id='offerData'></div>
		

	  </div>
	  <!-- /.box-body -->
</div>


<div id="sheduleinfo" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Schedule Details</h4>
          </div>
          <div class="modal-body" id="showinfo">
				LOADING Schedule. . . . . . . . . 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
 </div>
<!-- /.content -->


 

<script>
$("#campaign_ss.dropdown-menu li a").click(function()
{
  var selText = $(this).text();
  var id = $(this).attr("id");
  
  $(this).parents('.dropdown').find('.maindropdown').empty().html(selText);
  $('#campaign_ss.dropdown-menu li a').removeClass('hover_active');
  $(this).addClass('hover_active');
  GetOfferData(); // call GetOfferData

});


$("#group_category.dropdown-menu li a").click(function()
{
  var selText = $(this).text();
  var id = $(this).attr("id");
  

  
 $(this).parents('.dropdown').find('.maindropdown').empty().html(selText);
  $('#group_category.dropdown-menu li a').removeClass('hover_active');
  $(this).addClass('hover_active');
  GetOfferData(); // call GetOfferData 

});

</script>

<script>

GetOfferData();

function GetOfferData()
{
	
	var htmlData = '';	
	var menudata = $("#campaign_ss.dropdown-menu li a.hover_active").attr("id");	
	var group_category = $("#group_category.dropdown-menu li a.hover_active").attr("id");
	

	if(menudata == '')
	{
		var label = 'All Campaign'
	}
	else
	{
		//var res = menudata.split(" ");
		//var label = res[0].capitalize() + ' ' + res[1].capitalize();
		var label = menudata.capitalize();
	}
	
	$("#display_selected").empty().html(label);
	
	$.ajax({

		"url": "{{asset('campaign/getdata/acceptedoffer')}}",
		"type": 'GET',
		data: {'menudata':menudata,"_token":$('#token').val(),'group_category':group_category},	
		beforeSend: function() 
		{			
				
						
		},	
		success: function(details)
		{
			
		if(details.length > 0 ) {
			
			$.each(details, function( index, value ) 
			{
				
				htmlData += AcceptedTemplate(value.campaign_data,value.image_path);
				
				
			
			});
			
		}
		else
		{
			
			htmlData +=	'<div class="row">';
			htmlData += '<div class="col-lg-12">';
			htmlData += '<div class="bg-gray color-palette">';
			htmlData += '<h3 class="text-muted well well-sm no-shadow" style="margin-top:20px;margin-bottom:20px;padding:70px">';
			htmlData += '<center><i class="fa fa-fw fa-ban"></i> No Available Details for '+label+' </center>';
			htmlData +='</h3>';
			htmlData +='</div>';
			htmlData +='</div>';
			htmlData +='</div>';
		}
		
			 
			$("#offerData").empty().hide().append(htmlData).animate({ opacity: "show" }, "slow");
			
	
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

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
</script>


<script>
function loadCarousel(value,image)
{
	var carousel = '';
	carousel +=	'<div id="carousel-example-generic_'+value.id+'" class="carousel slide" data-ride="carousel">';
    carousel += '<ol class="carousel-indicators">';

	$.each( image, function( key, imagedata ) {
		var classdata = ((key == 0) ? 'active' : '');
		carousel += '<li data-target="#carousel-example-generic_'+value.id+'" data-slide-to="'+key+'" class="'+classdata+'"  ></li>';
	});

   carousel += '</ol>'
				
				
    carousel +=  '<div class="carousel-inner">'
	
	
	$.each( image, function( key, imagedata ) {
		
		var classdata = ((key == 0) ? 'active' : '');
		var image_path = imagedata.image_path;
		var image_route = "{{ asset('offer_images')}}/"+image_path;
		
		carousel +=  '<div class="item '+classdata+'">';
		carousel +=  '<img src="'+image_route+'" alt="First slide">';
		carousel +=  '<div class="carousel-caption">';
		//carousel +=  key+1+' Slide';
		carousel +=  '</div>';
		carousel +=  '</div>';
		
	});
	
				

    carousel += '</div>';
				
				
    carousel += '<a class="left carousel-control" href="#carousel-example-generic_'+value.id+'" data-slide="prev">';
    carousel += '<span class="fa fa-angle-left"></span>';
    carousel += '</a>';
				
    carousel += '<a class="right carousel-control" href="#carousel-example-generic_'+value.id+'" data-slide="next">';
    carousel += '<span class="fa fa-angle-right"></span>';
    carousel += '</a>';
	
	
    carousel += '</div>';
	
	
	return carousel;
	
}
</script>



<script>

function AcceptedTemplate(value,image)
{
	var image_path = '';
	var imageDiv = '';
	var Status_msg ="";
	var discount_html= "";
	
	JSDate.Init(value.start_date);
	start_date = JSDate.HumanDate(); // Convert Timestamp as 
	
	if(image.length != 0)
	{
		imageDiv = loadCarousel(value,image);
	}
	else
	{
		image_path = "default_product.jpg";
		var image_route = "{{ asset('offer_images')}}/"+image_path;
		imageDiv =	'<img class="img2 img-bordered-sm img-responsive" src="'+image_route+'" alt="user image">';
	}

	/*** if user accept the offer -> table name schedule_confirm_users have data **/
	if(value.user_product_id!= null)
	{
		var user_price = parseFloat(value.user_product_price).toFixed(2);
		var user_discount = value.user_product_discount;
		
		if (user_discount != "") 
		{
			
			
			if(value.user_product_discount_label == "Percentage")
			{
				var discount_percent = parseFloat(user_discount) / 100;
				var discount_price = user_price * parseFloat(discount_percent).toFixed(2);
				var final_price = user_price - parseFloat(discount_price).toFixed(2);
			}
			else if(value.user_product_discount_label == "Dollar")
			{
				var discounted_price_dallor = (parseFloat(user_price).toFixed(2) - parseFloat(user_discount).toFixed(2));
				var final_price =  parseFloat(discounted_price_dallor).toFixed(2);
			}
			
			
		}
		else
		{
			
			var final_price = value.user_product_price;
		}
		
		
		if (Number(user_discount) != 0) 
		{
			var original_price = parseFloat(user_price).toFixed(2);
			discount_html +=	 '<span> Was <span class="STRIKETHROUGH">$'+original_price+'</span></span><br>';
			
			if(value.user_product_discount_label == "Percentage")
			{
				discount_html +=	 '<span style="color:red"> Discount: '+Number(user_discount)+'%off</span><br>';
			}
			else if(value.user_product_discount_label == "Dollar")
			{
				discount_html +=	 '<span style="color:red"> Discount: $'+user_discount+'</span><br>';
			}
		
		}
	}	
	
	
	var rotator_link = "";
	if(value.rotator_link != "")
	{
		 rotator_link = '<i class="fa fa-fw fa-globe"></i>&nbsp;&nbsp; <a href="'+value.rotator_link+'" target="_blank">'+value.rotator_link+'</a><br>';
	}
	
	var	 prod_review_link = "";
	if(value.prod_review_link != "")
	{
			 prod_review_link = '<b>Product review Link:</b>&nbsp;&nbsp; <a href="'+value.prod_review_link+'" target="_blank">'+value.prod_review_link+'</a><br>';
	}
	
	var group_interest = "";
	if(value.group_interest != "")
	{
		 group_interest = '<b>Group & Interest:</b> &nbsp;&nbsp;'+value.group_interest+'</span><br>';
	}
	
	var product_brand = "";
	if(value.product_brand != "")
	{
		 product_brand = '<b>Brand:</b> &nbsp;&nbsp;'+value.product_brand+'</span><br>';
	}
	
	
	var template = 
	`<div class="create_box" id="${value.id}">
		<div class="row">
		
			<div class="col-md-5">
				${imageDiv}
			</div>
			<br>
			
			<div class="col-md-7">
				
				<div class="row title_header">
					<div class="col-lg-8">
						<a href="${value.link}"><p class="pull-left tile-bar">${value.Title}</p></a><br>
					</div>
				</div>
				
				<div class="row product_details">
					<div class="col-md-12">
						<div class="product_price">
							<span class="product_name"><i class="fa fa-fw fa-cube"></i>&nbsp; ${value.product_name}</span><br>
							<span class="product_name"><i class="fa fa-fw fa-tags"></i>&nbsp;&nbsp; $${final_price}</span><br>
							${discount_html}
						</div>
						<div class="offer_datetime">
							<span><i class="fa fa-fw fa-calendar"></i>&nbsp;&nbsp; ${start_date}</span><br>
							<span><i class="fa fa-fw fa-clock-o"></i>&nbsp;&nbsp; ${value.start_time}</span><br>
						</div>
						<div class="rotator_link">
							${rotator_link}
						</div>
						<br>
						<div class="product_information">
							<span class="glyphicon glyphicon-info-sign"></span><br>
							${prod_review_link}
							${group_interest}
							${product_brand}
						</div>
					</div>
				</div>
				<br>
				
				
				<div class="row summary_prod">
					<div class="col-lg-12">
					<i class="fa fa-fw fa-info-circle"></i> <b>Product Description</b><br>
					<div class="description ">${value.product_description}</div>
					</div>
				</div>
				<br>
			
				<div class="row summary_prod">
					<div class="col-lg-12">
						<i class="fa fa-fw fa-pencil-square-o"></i> <b>Summary</b><br>
						<div class="description ">${value.Summary}</div>
					</div>
				</div>
				<br>
				
			
			</div>
	
		</div>
	</div>`
	return template;
}


</script>




<script>

/*function AcceptedTemplate2(value,image)
{
	console.log(value);
	var link = "";
	
	if(value.campaign_type == "addtocart campaign")
	{
		link = '{{ asset("campaign/getdata/addtocart/offerdetails")}}/'+value.id;
	}
	
	else if(value.campaign_type == "insight campaign")
	{
		link = '{{ asset("campaign/getdata/insight/offerdetails")}}/'+value.id;
	}
	
	else if(value.campaign_type == "compare campaign")
	{
		link = '{{ asset("campaign/getdata/compare/offerdetails")}}/'+value.id;
	}
	
	else if(value.campaign_type == "fullbuy campaign")
	{
		link = '{{ asset("campaign/getdata/fullbuy/offerdetails")}}/'+value.id;
	}

	
	var html = '';
	//var image_route = "{{ asset('offer_images')}}/"+value.product_photo;
	
	html += '<div class="create_box" id='+value.id+'>';
	html += '<div class="row" >';
	
	/* 	
	html +=	'<div class="col-md-4">';
	html +=		'<img class="img2 img-bordered-sm img-responsive" src="'+image_route+'" alt="user image">';		
	html +=	'</div>'; 

	
	if(image.length != 0)
	{
		
		html +=	'<div class="col-md-5">';
		html += loadCarousel(value,image);
		html +=	'</div>'; 
		html +=	'<br>';
		
	}
	else
	{
		
		image_path = "default_product.jpg";
		var image_route = "{{ asset('offer_images')}}/"+image_path;
		html +=	'<div class="col-md-5">';
		html +=	'<img class="img2 img-bordered-sm img-responsive" src="'+image_route+'" alt="user image">';
		html +=	'</div>'; 
		html +=	'<br>'; 
	} 
			
		
	html +=	'<div class="col-md-7">';
	
	html +=	'<div class="row">';
	html +=		'<div class="col-lg-8">';
	html +=			'<a href="'+link+'"><p class="pull-left tile-bar">'+value.Title+'</p></a><br>';
	html +=		'</div>';
	html +=	'</div>';
	
	JSDate.Init(value.start_date);
	start_date = JSDate.HumanDate(); // Convert Timestamp as 
	
	
	
	
	var price = parseFloat(value.user_product_price).toFixed(2);
	var user_product_discount = parseFloat(value.user_product_discount).toFixed(2);
	
	if (user_product_discount != "") 
	{
		
		if(value.user_product_discount_label == "Percentage")
		{
			var discount_percent = parseFloat(user_product_discount) / 100;
			var discount_price = price * parseFloat(discount_percent).toFixed(2);
			var final_price = price - parseFloat(discount_price).toFixed(2);
		}
		else if(value.user_product_discount_label == "Dollar")
		{
			var discounted_price_dallor = (parseFloat(price).toFixed(2) - parseFloat(user_product_discount).toFixed(2));
			var final_price =  parseFloat(discounted_price_dallor).toFixed(2);
		}
			
		
	
		
	}
	else
	{
		var final_price = price;
	}
	
	html += '<div class="row product_details">';
	html += '<div class="col-md-7">';
	html +=	 '<span class="product_name"><i class="fa fa-fw fa-cube"></i>&nbsp; '+value.product_name+'</span><br>';
	html +=	 '<span class="product_name"><i class="fa fa-fw fa-tags"></i>&nbsp;&nbsp; $'+final_price+'</span><br>';
	
	
	if(Number(user_product_discount) != 0)
	{
		var original_price = parseFloat(value.product_price).toFixed(2);
		html +=	 '<span> Was <span class="STRIKETHROUGH">$'+original_price+'</span></span><br>';
		
		if(value.user_product_discount_label == "Percentage")
		{
			html +=	 '<span style="color:red"> Discount: '+Number(user_product_discount)+'%off</span><br>';
		}
		else if(value.user_product_discount_label == "Dollar")
		{
			html +=	 '<span style="color:red"> Discount: $'+user_product_discount+'</span><br>';
		}
		
	}
	
	
	

	html +=	 '<span><i class="fa fa-fw fa-calendar"></i>&nbsp;&nbsp; '+start_date+'</span><br>';
	html +=	 '<span><i class="fa fa-fw fa-clock-o"></i>&nbsp;&nbsp; '+value.start_time+'</span><br>';
	if(value.rotator_link != ""){
	html +=	 '<i class="fa fa-fw fa-globe"></i>&nbsp;&nbsp; <a href="'+value.rotator_link+'" target="_blank">'+value.rotator_link+'</a><br>';
	}
	
	
	html +=	 '<br><span class="glyphicon glyphicon-info-sign"></span><br>';
	if(value.prod_review_link != "")
	{
		html +=	 '<b>Product review Link:</b>&nbsp;&nbsp; <a href="'+value.prod_review_link+'" target="_blank">'+value.prod_review_link+'</a><br>';
	}
	
	if(value.group_interest != "")
	{
		html +=	 '<b>Group & Interest:</b> &nbsp;&nbsp;'+value.group_interest+'</span><br>';
	}
	
	if(value.product_brand != "")
	{
		html +=	 '<b>Brand:</b> &nbsp;&nbsp;'+value.product_brand+'</span><br>';
	}
	
	
	
	

	html +=	'</div>';
	html += '</div>';
	html += '<br>';
	
	
	html += '<div class="row summary_prod">';
	html += '<div class="col-lg-12">';
	html += '<i class="fa fa-fw fa-info-circle"></i> <b>Product Description</b><br>';
	html += '<div class="description "> '+value.product_description+' </div>';
	html += '</div>';
	html += '</div>';
	html += '<br>';
	
	
	html += '<div class="row summary_prod">';
	html += '<div class="col-lg-12">';
	html += '<i class="fa fa-fw fa-pencil-square-o"></i> <b>Summary</b><br>';
	html += '<div class="description "> '+value.Summary+' </div>';
	html += '</div>';
	html += '</div>';

	
	html +=	'</div>';
	html +=	'</div>';
	html +=	'</div>'
	
	return html;
	
} 
*/
</script>


<script>

function js_yyyy_mm_dd_hh_mm_ss()
{
  now = new Date();
  year = "" + now.getFullYear();
  month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
  day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
  hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
  minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
  second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
  return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
}





function SaveUserActivities(activities)
{
	
	$.ajax({
		
	   url: "{{asset('SaveUserActivities')}}",
	   type: 'POST',
	   data: {"_token":$('#token').val(),activities:activities},
		success: function(response)
		{
				
			
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
		
		}
		
	});

	
}


check_archive_acceptoffer_duedate()
function check_archive_acceptoffer_duedate()
{
	
	$.ajax({
		
	   url: "{{asset('check/offer_accept/duedate')}}",
	   type: 'GET',
	   data: {"_token":$('#token').val()},
		success: function(response)
		{
				
			console.log(response);
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
		
		}
		
		
		
	});
	
}

// -----------------------------
// JS DATE PARSING LIBRARY
// github.com/marvicrm/JSDate
// -----------------------------
var JSDate = {
			
			Init: function(date)
			{
			
				date = new Date(date);
				
				month_str = this.GetMonth(date.getMonth());
				month_int = this.PutZero(date.getMonth());
				day = this.PutZero(date.getDate());
				hour = this.GetHours(date.getHours());
				minutes = this.PutZero(date.getMinutes());
				seconds = this.PutZero(date.getSeconds());
				ampm = this.GetAmPm(date.getHours());
				year = date.getFullYear();

				this.human_date_and_time = month_str+' '+day+', '+year+' '+hour+':'+minutes+' '+ampm;
				this.human_date = month_str+' '+day+', '+year;
				this.timestamp = year+'-'+month_int+'-'+day+' '+hour+':'+minutes+':'+seconds;
				
				
				
				
			},
			GetMonth: function(num)
			{
				month_name = ["January",
							  "February",
							  "March",
							  "April",
							  "May",
							  "June",									  
							  "July", 
							  "August",
							  "September",
							  "October",
							  "November",
							  "December"];
				
				return month_name[num]; 
			},
			GetHours: function(hour)
			{
				if(hour>12)
				{	
					if(hour<=9)
					{
						hour = hour - 2;
						hour = hour.toString();
						hour = hour[1];
						hour = "0" + hour;
					}
	
				} 
				return hour;
			},
			PutZero: function(value)
			{
				if(value<=9)
				{
					value = "0"+value;
				}
				return value;
			},
			GetAmPm: function(hour)
			{
				return (hour>12?'PM':'AM');
			},
			TimeStamp()
			{
				return this.timestamp;
			},
			HumanDate()
			{
				return this.human_date;
			},
			HumanDateTime()
			{
				return this.human_date_and_time;
			}
			
			
}


</script>





@endsection