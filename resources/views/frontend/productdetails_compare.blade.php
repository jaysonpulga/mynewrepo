@extends('frontend.layouts.main')

@section('content')

<!--// div secondpanel -->
	@include('frontend.layouts.secondpanel')  
<!--  ~end secondpanel -->


<style>

.user-block img {
    width: 185px !important; 
    height: 185px !important; 
    float: left;
}
.user-block .description {
    color: #999;
    font-size: 15px !important;
	margin-left:180px;
	margin-top:5px;
}
.create_box
{
	padding-top:10px;
	padding-bottom:10px;
	padding-right:60px;
	padding-left:60px;
}
.tile-bar
{
	font-weight:bold;
	font-size:22px;
}



.box-title2
{
	font-weight:bold;
	font-size:24px;
}


</style>

<style>
.hidebutton
{
	display: none !important;
}

.showbutton
{
	display: inline !important;
}
.marginpadding
{
	clear:both;
	padding-top:25px !important;
}
</style>


<style>
#container {
  position: relative;
  width: 100%;
  height:65px;
}

.step-wizard {
  display: inline-block;
  position: relative;
  width: 85%;
}



.step-wizard ul {
  position: absolute;
  width: 100%;
  list-style-type: none;
    padding-left: 20px;
  /*

  left: -4%;
  */
}
.step-wizard li {
  display: inline-block;
 /*text-align: center;*/
  width: 14.7%;
}
.step-wizard li .step {
  position: absolute;
  display: inline-block;
  line-height: 40px;
  width: 40px;
  height: 40px;
  color:#fff;
  border-radius: 50%;
  border-color: #6ece16;
  background: #6ece16;
  -webkit-transition: background-color 0.6s ease, border-color 0.6s ease;
  -o-transition: background-color 0.6s ease, border-color 0.6s ease;
  transition: background-color 0.6s ease, border-color 0.6s ease;
}
.step-wizard li .titlex {
 font-weight:bold;
  line-height: 80%;
  position: relative;
  width: 100%;
  left:52px;
  line-height:2px;
  /*padding-top: 42px;*/
  color: #969c9c;
  -webkit-transition: color 0.6s ease;
  -o-transition: color 0.6s ease;
  transition: color 0.6s ease;
}
.step-wizard li.active .step {
  border-color: #0aa89e;
}
.step-wizard li.active .titlex {
  color: black;
}
.step-wizard li.done .step {
  color: white;
  background-color: #ccefac;
  border-color: #ccefac;
}
.step-wizard li > a {
  display: inline;
  width: 100%;
  color: black;
  position: relative;
  text-align: center;
}
.step-wizard li > a:hover .step {
  border-color: #0aa89e;
}
.step-wizard li > a:hover .titlex {
  color: black;
}
@media only screen and (max-width: 1200px) {
  .step-wizard li {
    width: 24%;
  }
}
@media only screen and (max-width: 375px) {
  .step-wizard li {
    width: 22%;
  }
}

.contentarea { width:100%; padding:10px; display:none}
.contentarea.active { display:block}

.box {
  
    border-radius: 0px !important;
	border-top: 2px solid #d2d6de !important;
	padding-right: 1px !important;
	padding-left: 1px !important;
	
  
}


.product_name_1
{
	/*font-family: "Amazon Ember",Arial,sans-serif !important;*/
	font-weight: 400!important;
	font-size: 30px!important;
	line-height: 1.255!important;
	display: inline;
	color: #555!important;
}

.product_price_1
{
	font-family: "Amazon Ember",Arial,sans-serif !important;
	font-weight: 400!important;
	font-size: 18px!important;
	line-height: 1.255!important;
	display: inline;
	
}


.product_details_2
{
	font-family: "Amazon Ember",Arial,sans-serif !important;
	font-weight: 400!important;
	font-size: 14px!important;
	line-height: 1.255!important;
	display: inline;
	color: #555!important
}

.photo_fix
{
	max-height: 450px;
	min-height: 450px;
	height : 450px;
	overflow: hidden;
	background-color:none;
	margin-bottom:5px;
}

.STRIKETHROUGH 
{
    text-decoration: line-through;
	color: #a0a0a0; 
}

.btn {
    border-radius: 16px !important;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent;
}

</style>



<style>

#product-view {
    border: #CCC 1px solid;
    overflow: auto;
    display: inline-block;
    padding-top: 20px;
    margin-top: 30px;
    text-align:left;
}

#thumbnail-container 
{
   float: none;
   margin-top:5px;
}


.thumbnails li 
{
      display: inline;
      margin: 0 10px 0 0;
}
	
	
.thumbnail {
     display: inline !important;
     padding: 1px !important;
     margin-bottom: 20px 
     line-height: 1.42857143;
    border-radius: 1px !important;
   
}	
	
	

/* Responsive Styles */
@media screen and (min-width: 1224px) {
    div.image {
        width: 300px;
    }
}

@media screen and (min-width: 1044px) and (max-width: 1224px) {
    div.image {
        width: 250px;
    }
}

@media screen and (min-width: 845px) and (max-width: 1044px) {
    div.image {
        width: 200px;
    }
}
@media screen and (max-width: 560px) {
    #preview-enlarged {
        float: none;
    }

	.thumbnails li {
		display: inline;
		margin: 0 10px 0 0;
	}
}





</style>


<div class="row" >
<div class="col-sm-12">	
<div class="box" >
<div class="box-body">
	
		
	@if(!$images->isEmpty())	
		
		<div class="col-sm-5">	
			<div class="preview-image">
		
				
				<div id="preview-enlarged" style='height: 300px; width: 100%; background-color: #d8cfcf'>
						<img style='height: 100%; width: 100%; object-fit: contain' src="{{ cdn_asset('offer_images')}}/{{$images[0]->image_path}}"/> 
				</div>
				
				
				<div id="thumbnail-container"  >
					@foreach($images as $key => $imagedata)
						<?php $classdata = (($key == 0) ? 'focused' : ''); ?>
						<div class="product-thum-wrapper"><img class="thumbnail {{$classdata}}" src="{{ cdn_asset('offer_images')}}/{{$imagedata['image_path']}}"></div>	 	 
					@endforeach
				</div>
			

					
			</div>
		</div>
		
	@else
	
			<div class="col-sm-5">	
        			<div class="preview-image">
        		
        				
        				<div id="preview-enlarged" style='height: 330px; width: 100%; background-color: #d8cfcf'>
        						<img style='height: 100%; width: 100%; object-fit: contain' src="{{ cdn_asset('offer_images')}}/default_product.jpg"/> 
        				</div>
        				
        				
        				<div id="thumbnail-container">
        					<div class="product-thum-wrapper"><img class="thumbnailxx focused" src="{{ cdn_asset('offer_images')}}/default_product.jpg"></div>	 
        				</div>
        			
        
        				
        			</div>
		</div>
	@endif
	
	
	
	<script>
		$("#thumbnail-container  img").click(function() {
			$("#thumbnail-container   img").css("border", "1px solid #ccc");
			var src = $(this).attr("src");
			$("#preview-enlarged img").attr("src", src);
			$(this).css("border", "#fbb20f 2px solid");
			
		});
	</script>
	
		
			
	<div class="col-sm-5">
					
				<div class="row product_details">
					<div class="col-md-12">
						<span class="product_name_1">{{$offerdetails[0]->product_name}}  </span><br>
						
						<!--
						<span class='product_details_2'><b>Active Date:</b> {{ \Carbon\Carbon::parse($offerdetails[0]->start_date)->format('M,d Y')}} -  {{ \Carbon\Carbon::parse($offerdetails[0]->start_date)->format('M,d Y')}}  </span><br>
						-->
					
						
						@if(!empty($offerdetails[0]->user_product_id))
							
								<?php 
									 $user_price = number_format($offerdetails[0]->user_product_price,2);
									 $user_discount = $offerdetails[0]->user_product_discount;
								?>
							
							
								
								@if(    $user_discount > 0 ) 
										
										@if($offerdetails[0]->user_product_discount_label == "Percentage")
											
											<?php
										
												$discount_percent = $user_discount / 100;
												$discount_price = 	$user_price * number_format($discount_percent,2);
												$final_price2 = $user_price - number_format($discount_price,2); 
										        $final_price =  number_format($final_price2, 2, '.', ' ');
											?>
								
										@elseif($offerdetails[0]->user_product_discount_label == "Dollar")
										
											<?php
										
											
												$discounted_price   = number_format($user_price) - number_format($user_discount,2);
												//$final_price        =  number_format($discounted_price,2); 
										        	$final_price =  number_format($discounted_price, 2, '.', ' ');
											?>
									
										@endif
							
							
								@else
									<?php 
									//$final_price = $user_price; 
									$final_price =  number_format($user_price, 2, '.', ' ');
									?>
									
								@endif
							
							
								<!--<span>Price : <span class='product_price_2'>${{$final_price}}</span></span><br>-->
								
								<span><span class='product_price_1'><b>${{$final_price}}</b>&nbsp;&nbsp;</span></span>
						
						    @if(    $user_discount > 0 ) 
							
							
									<?php  $original_price = number_format($user_price); ?>
									<span class='product_price_1'><span class="STRIKETHROUGH">${{$original_price}}</span></span>&nbsp;&nbsp; 
								
									
									@if($offerdetails[0]->user_product_discount_label == "Percentage")
									
										<span style="background-color:#bb0a0a;padding:4px;border-radius:16px;font-size:12px"><span style="color:#fff">{{$user_discount}}% Off</span></span>					
										
									@elseif($offerdetails[0]->user_product_discount_label == "Dollar")
									
										
										<span style="color:red"> Discount: ${{$user_discount}}</span>	
											
									@endif
									
					
							@endif
							
						
						@endif
						
						
						
						
						
						<!--
						<span class='product_details_2'><a href="{{$offerdetails[0]->prod_review_link}}" target="_blank" > {{$offerdetails[0]->prod_review_link}} </a></span><br>
						-->
						
						
					</div>
				</div>
				<br>
				
				<div class="row product_details">
				
					<div class="col-sm-12">
					    
					 
					
					
							 <b>Offer Summary</b> <span style='float:right'>
							     
							 <!--<a href="{{$offerdetails[0]->prod_review_link}}" target="_blank">Product Review Page <i class="fa fa-fw fa-long-arrow-right"></i> </a> -->
							 
							 <span class='product_details_2'><b>Offer Date:</b> {{ \Carbon\Carbon::parse($offerdetails[0]->start_date)->format('F,d Y')}} -  {{ \Carbon\Carbon::parse($last_date_offer)->format('F,d Y')}}  </span>
							     
							     
							     </span> 
							     
							     
							     
							     
							 <div style='border-bottom:1px solid #ccc1c1;margin-bottom:12px'></div>
							 <div class='product_details_2'>{!! html_entity_decode($offerdetails[0]->Summary) !!}</div>
							
							
							
					</div>
					
				</div>
		
				
					
				<div class="row product_details">
					<div class="col-sm-12">
						
				
						
						@if($offerdetails[0]->Title != "")
							
						<span class='product_details_2'><b>Campaign</b>: <span> {{$offerdetails[0]->Title}}</span</span><br>
											
						@endif
						
						
						@if($offerdetails[0]->product_brand != "")
							
						<span class='product_details_2'><b>Brand</b>: <span> {{$offerdetails[0]->product_brand}} </span</span><br>
											
						@endif
						
						
					
					</div>
					
				</div>
			
				
			</div>
			
			<div class="col-sm-2">
			    
					@if($GetTotalAvailableSchedule == 0 )
					    <button type="button" class="btn btn-block btn-warning">SOLD OUT</button>
					@else
				    	<button type="button" onclick="getCampaignofferschedule('{{$offerdetails[0]->id}}')" class="btn btn-block btn-success">Get Date Schedule</button>
					@endif
				
					<a href="{{asset('dashboard')}}"  class="btn btn-block btn-default">Back</a>
			</div>
			
	


			<div class="col-sm-12">
				<div class="row">
				
						<div class="col-sm-12">
							 <h3>Product Details</h3>
							 
							 <div style='border-bottom:solid 1px #ccc6c6;margin-top:-8px;margin-bottom:12px'></div>
							 
							 
								<div class='product_details_2'>  {!! $offerdetails[0]->product_description !!}   </div>
						</div>
				
				</div>
			</div>
		
		
		
		
			
			
			
			
</div>
</div>
</div>
</div>


<!-- modal -->
<div id="offer_schedule" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content  -->
        <div class="modal-content">
		
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><span id='ordertitle'></span></h4>
			  </div>
		  
		 
			  <div class="modal-body">

				<div class='row' style="max-height:450px;overflow-y: scroll;">
					 
						<table id='campaign_schedule'  class="table table-bordered" width="100%" >
				
						<thead align="center">
						<tr>
							<th></th>
							<th width='30%'>Schedule Date</th>
							<th width='20%'>Slot</th>
							<th>Availble Time</th>
						</tr>
						</thead>
						
						<tbody ></tbody>
						</table>

					  
				</div>
			
			  </div>
			  
			  
			<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id='getdata' type="button"  class="btn btn-primary" >Save</button>
			</div>
			  
        </div>
    </div>
</div>

<!-- modal -->
<div id="fullcalendar_sched" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content  -->
        <div class="modal-content">
		
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title"><span id='ordertitle'>Choose  when you will buy the product from an available date below, You must buy the product on the day chosen to be eligible for points and rebates. <br> * <i>(blue square)</i> - Available dates</span></h5>
			  </div>
		  
		 
			  <div class="modal-body">
			
					<center>
						  <!-- THE CALENDAR -->
						  <div id="start_date"></div>
						   
					</center>
					
					<input id='date_holder' type='hidden' />	
					<input id='offer_id_x' type='hidden' />	
					
					<input id='idx' type='hidden' />	
					<input id='get' type='hidden' />	
					
				
					
			  </div>
			  
			  
			<div class="modal-footer">
				<span id='youselect' style='float:left'></span>
			
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id='getdata' type="button"  class="btn btn-primary" >Save</button>
			</div>
			  
        </div>
    </div>
</div>


<script>
Array.prototype.contains = function ( needle ) 
{ 
	for (i in this) 
	{
       if (this[i] == needle) return true;
	}
	return false;
}
</script>



<script>
var loading ="";
function accept(id)
{

	
	$('#youselect').empty();
	return false;
	
	
	$.ajax({

		url: "{{route('getDateConfirm')}}",
		type: 'POST',
		data: {offer_id:id,"_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
					
				
					loading = $("body").waitMe({
						effect: 'timer',
						text: 'Get Schedule........',
						bg: 'rgba(255,255,255,0.90)',
						color: '#555'
					}); 
				
		},	
		success: function(data)
		{
			
			var html = "";
			if(data.result == "get_other_date")
			{
				accept(id);
				
			}
			else if(data.result == "get_other_shedule")
			{
				accept(id);
				
			}
			else if(data.result == "exist")
			{
				loading.waitMe('hide');

				$("#sheduleinfo").modal("show");
				appnt_startx = new Date(data.data.schedDate+ " " +data.data.schedtime);		
				JSDate.Init(appnt_startx);
				human_date = JSDate.HumanDate(); // Convert Timestamp as 
				html += "Your schedule to continue this offer  will be on <br>";
				html += human_date;
				$("#showinfo").empty();
				$("#showinfo").empty().append(html);
				console.log(data);
				
			}
			else if(data.result == "save")
			{
				
				loading.waitMe('hide');
				
			
					 swal({
					  title: 'Congratulations',
					  text:  "you get this offer",
					  type: 'success',
					}).then(function (result) {
						
						
						$("#sheduleinfo").modal("show");
						appnt_startx = new Date(data.data.schedDate+ " " +data.data.schedtime);		
						JSDate.Init(appnt_startx);
						human_date = JSDate.HumanDateTime(); // Convert Timestamp as 
						html += "Your schedule to continue this offer  will be on <br>";
						html += human_date;
						$("#showinfo").empty();
						$("#showinfo").empty().append(html);
						console.log(data);
						
						var activities = {'task':'accept_offer', 'campaign_id':id };
						SaveUserActivities(activities);
						
						GetOfferData();
							
					}); 
				
			}
			else if(data.result == "no_schedule_available")
			{
				
					swal({
						  title: 'No Schedule Available',
						  text:  "",
						  type: 'warning',
					});
					
					loading.waitMe('hide');
			}
			
		
		},

		error: function(error){
			
			loading.waitMe('hide');
			console.log(error);

		}
		
	});
	

	return false;
	
	
}
</script>


<script>
Array.prototype.contains2 = function (val) 
{ 

	for(var i = 0; i < this.length; i++ )
	{
		if(JSON.stringify(this[i]) === JSON.stringify(val)) return true;
	}
	return false;
	
} 
</script>

 
 
 
<script>

var timex = [];
var time_available = [];
	

function getCampaignofferschedule(offer_id,idx='',get='')
{

	
	$('#start_date').datepicker("destroy");
	$('#date_holder').val('');
	$('#youselect').empty();

	
	var container = $("#campaign_schedule > tbody");
	var table ="";
	var dt =[];
	var select ="";
	

	$.ajax({

		url: "{{route('getCampaignofferschedule')}}",
		type: 'POST',
		data: {offer_id:offer_id,"_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
					
				
					loading = $("body").waitMe({
						effect: 'timer',
						text: 'Get Schedule........',
						bg: 'rgba(255,255,255,0.90)',
						color: '#555'
					}); 
				
		},	
		success: function(result)
		{
			
			loading.waitMe('hide');
				
			var dtx = [];
			var timex = [];
		
			if(result.data.length > 0)
			{
			
				$.each( result.data, function( key, value ) {
					 
					/* appnt_date = new Date(value.date);		
					JSDate.Init(appnt_date);
					return_date = JSDate.HumanDate(); // Convert Timestamp as 
					table += "<tr>";
					table += "<td><input type='radio'  name='select_sched'  data-date="+value.id_date+"  data-offer_id ="+id+"  data-idx="+idx+" data-get="+get+"   /></td>";
					table += "<td>"+return_date+"</td>";
					table += "<td>"+value.value+"</td>";
					var dtx = Selectloop(value.time,value.id_date);
					table += "<td><div>"+dtx+"</div></td>";
					
					
					table +="</tr>";
					dt = [];
					 */
					 
					 //dtx.push(Selectloop(value.time,value.id_date,value.date));
					 
					$.each(value.time, function( key, data )
					{
		
						if(data.status == "available")
						{
							
							if(timex.contains(value.date)) 
							{ 
							    
							} 
							else{
							    
							    timex.push(value.date); 
							    
							    var dd = data.schedule_time.split(" ");
							    
							    var aa = { val_date: dd[0], val_time:dd[1] };
							    
							    
							    if(time_available.contains2(aa)) 
        						 { } 
        						 else
        						 { 
        							time_available.push(aa); 
        						 }
							    
							    
							    
							    
							    
							    
							}
							
						
							
							
							 
							

						}
						
					});
					 
					 
					 
				}); 
			}
			
			
		
			 var count = 0;
			$("#start_date").datepicker({
				
				
				numberOfMonths: 2 ,
				beforeShowDay: function(date) { 

				
				
				dmy = ('0' + (date.getMonth()+1)).slice(-2) + '/' + ('0' + date.getDate()).slice(-2) + '/' +  date.getFullYear();
					if ($.inArray(dmy, timex) != -1) {
						return [true, "highlight", "Available"]; 
						count++;
					} else{
						return [false,"","unAvailable"]; 
						
					}
					
					console.log('count' + count  + 'ito yun');
					
				},
				 onSelect: function()
				 {
					var selected = $(this).val();
					//alert(selected);
					$('#date_holder').val(selected);
					$('#offer_id_x').val(offer_id);
					
					$('#idx').val(idx);
					$('#get').val(get);
					
					$('#count').val(count);
					
					$('#youselect').empty().html('your selected  date '+ selected);
					
					
				
				}
				
				
			});
			
				

			var options = { backdrop : 'static'}
			$('#fullcalendar_sched').modal(options);			

	
					
			console.log(timex)
			/* 
			else
			{
				table+= "<tr><td colspan='4'><center>No more Available Schedule</center></td><tr>";
			} */
			
			//container.empty().html(table);
		
		},

		error: function(error){ 
			loading.waitMe('hide');
			console.log(error);

		}
		
	});
	

	return false;
	
}

</script>
 
 
 
<style>


.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    border: 1px solid #d3d3d3;
    background: transparent !important;
    font-weight: normal;
    color: #555555;
}


.highlight{
  background-color: #3c8dbc !important;
  color: #ffffff !important;
  
}

.highlight > a{
  color: #ffffff !important;
  
}

.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
    border: 1px solid #aaaaaa !important;
    background: #ffffff !important;
    font-weight: normal !important;
    color: #212121 !important;
}
</style>
 
 
 <script>
 
 $(document).on('click', '[id="getdata"]', function () {
 
 /*
	var radioValue = $("input[name='select_sched']:checked").attr('data-date');
	var offer_id = $("input[name='select_sched']:checked").attr('data-offer_id');
	
	var idx = $("input[name='select_sched']:checked").attr('data-idx');
	var get = $("input[name='select_sched']:checked").attr('data-get');
	
	var select_schdule = $("select#"+radioValue+" option:selected").text();
*/




	var select_schdule  = $("#date_holder").val();

//var index = time_available.indexOf(select_schdule);

//var indices = time_available.map((e, i) => e === select_schdule ? i : '').filter(String);

	var offer_id  = $("#offer_id_x").val();
	
	
	var idx  = $("#idx").val();
	var get  = $("#get").val();

	vv = time_available.findIndex(x => x.val_date === select_schdule);
	
	val_date = ((time_available[vv].val_date));
	val_time = ((time_available[vv].val_time));
    	

	if(select_schdule == "")
	{
		swal({
						  title: 'Select schedule first',
						  text:  "",
						  type: 'warning',
		});
		return false;
	}
	
	var html = "";

	
	$.ajax({

		url: "{{route('getDateConfirm2')}}",
		type: 'POST',
		data: {offer_id:offer_id,"_token":$('#token').val(),select_schdule:select_schdule,val_date:val_date,val_time:val_time},
		dataType: 'json',
		beforeSend: function() {
					
				
					loading = $("body").waitMe({
						effect: 'timer',
						text: 'Saving Schedule........',
						bg: 'rgba(255,255,255,0.90)',
						color: '#555'
					}); 
				
		},	
		success: function(data)
		{
			
			$('#fullcalendar_sched').modal('hide');	
			$('#offer_schedule').modal('hide');
			
			if(data.result == "exist")
			{
				loading.waitMe('hide');

				$("#sheduleinfo").modal("show");
				appnt_startx = new Date(data.data.schedDate+ " " +data.data.schedtime);		
				JSDate.Init(appnt_startx);
				human_date = JSDate.HumanDate(); // Convert Timestamp as 
				html += "Your schedule to continue this offer  will be on <br>";
				html += human_date;
				$("#showinfo").empty();
				$("#showinfo").empty().append(html);
				console.log(data);
				
			}
			else if(data.result == "save")
			{
				
				
				
				loading.waitMe('hide');
				
			
					 swal({
					  title: 'Congratulations',
					  text:  "you got this offer",
					  type: 'success',
					}).then(function (result) {
						window.location.href = "{{asset('campaign/getdata/compare/offerdetails')}}/"+offer_id+"#step-2";
					}); 
					
					//get  other schedule 
					if(get == "getothershed"){
						update_schedule(idx,offer_id);	
					}
			}
			else if(data.result == "no_schedule_available")
			{
				
					swal({
						  title: 'No Schedule Available',
						  text:  "",
						  type: 'warning',
					});
					
					loading.waitMe('hide');
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
 
 



<script type="text/javascript">

function checkifcomplete()
{
	
	
		$.ajax({
		url: "{{route('checkifcomplete')}}",
		type: 'GET',
		data: {offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()},
		dataType: 'json',
		success: function(data)
		{
				console.log(data.length);
				if(data.length > 0)
				{
					
					
					
					if(data[0].status === "processing")
					{
						
						$("#processing").removeClass('hidebutton').addClass('showbutton');
						$("#incomplete").removeClass('showbutton').addClass('hidebutton');
						$("#completed").removeClass('showbutton').addClass('hidebutton');
						$("#review").removeClass('showbutton').addClass('hidebutton');
					}
					if(data[0].status === "inc")
					{
						
						$("#incomplete").removeClass('hidebutton').addClass('showbutton');
						$("#processing").removeClass('showbutton').addClass('hidebutton');
						$("#completed").removeClass('showbutton').addClass('hidebutton');
						$("#review").removeClass('showbutton').addClass('hidebutton');
						
					}
					else if(data[0].status === "completed")
					{
						$("#completed").removeClass('hidebutton').addClass('showbutton');
						$("#processing").removeClass('showbutton').addClass('hidebutton');
						$("#incomplete").removeClass('showbutton').addClass('hidebutton');
						$("#review").removeClass('showbutton').addClass('hidebutton');
					}
					else if(data[0].status === "review")
					{
						$("#review").removeClass('hidebutton').addClass('showbutton');
						$("#completed").removeClass('showbutton').addClass('hidebutton');
						$("#processing").removeClass('showbutton').addClass('hidebutton');
						$("#incomplete").removeClass('showbutton').addClass('hidebutton');
					}
					
					
				}
				else
				{
					$("#canceloffer").removeClass('hidebutton').addClass('showbutton');
				}
			
		},
		error: function(error){ 
			console.log(error);
		}

	});
	 
}
</script>


<script>
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



<script type="text/javascript">
$(document).on('click', '.SaveAnswer', function(e)
{
e.preventDefault();

    var answersamazonList = [];
    //Loop over all questions
    $(".amazonstart_ans").each(function() {
		
		var questionId = $(this).attr("id");
		
		
		if($(this).data('fieldtype') == "rating_star" ) 
		{
			
			var answer = $("input[type='radio']:checked", $(this)).val();
			if (answer !== undefined) 
			{
					answersamazonList.push({
					  model: 'amazon_survey',
					  questionId: questionId,
					  answer: answer,
					  'fieldtype':$(this).data('fieldtype')
					});
			}
		}
		else if ( $(this).data('fieldtype') != "Radio" )
		{
			answersamazonList.push({
					   model: 'amazon_survey',
					  questionId: questionId,
					  answer: $(this).val(),
					  'fieldtype':$(this).data('fieldtype')
			});
		} 
	
		

    });
	
	 var answersproductList = [];
    //Loop over all questions
    $(".productsurvey_ans").each(function() {
		
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
	
//var newArray = $.merge(answersamazonList, answersproductList);	
 var myJSON = JSON.stringify(answersamazonList);	
 alert(myJSON);

return false;

saveAnswer(offerid="{{$offerdetails[0]->id}}",answersproductList,answersamazonList);

});
</script>

<script type="text/javascript"> 
function saveAnswer(offerid,answersproductList,answersamazonList)
{
	
	$.ajax({
		url: "{{route('saveAnswer')}}",
		type: 'POST',
		data: {offerid:offerid, answersproductList:answersproductList, answersamazonList:answersamazonList,"_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
			
			/*
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Saving...',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
			*/
		},
		success: function(data)
		{

			if(data.success == "success")
			{
				
				
				swal({
					  title: 'Successfully Submited - <br>Thank you!',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
					 
						window.location.href = "{{asset('dashboard')}}";
					  
					});
	
			}
			
		},
		error: function(error){ 
			promptAjaxMessage(error.result, error.message);
			console.log(error);
		}

	});

}


function Cancel_request(id)
{
	swal({	
	
		title: 'Cancel Request',
		text: 'would you like to cancel this offer? ',
		type: 'question',
		showCancelButton: true,					
		cancelButtonText: "Stay this page",	
		confirmButtonText: 'Yes, I am sure',	
		}).then(function(){
			
			
		
			
			$.ajax({
					url: "{{route('canceloffer')}}",
					type: 'POST',
					data: {offerid:id,"_token":$('#token').val()},
					dataType: 'json',
					success: function(data)
					{

						if(data.success == "success")
						{
							
							
							swal({
								  title: 'Request Canceled',
								  text:  "",
								  type: 'success',
								}).then(function (result) {
								 
									window.location.href = "{{asset('dashboard')}}";
								  
								});
				
						}
						
					},
					error: function(error){ 
						promptAjaxMessage(error.result, error.message);
						console.log(error);
					}

				});
					
				
			
		},function(dismiss) {
		window.location.reload();
	});
}
</script>


@endsection
